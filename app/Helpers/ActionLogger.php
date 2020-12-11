<?php

namespace App\Helpers;

use App\Models\ActionLog;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class ActionLogger
{
  private $excludedFields = [
    'password', 'updated_at', 'remember_token', 'is_other_material',
  ];

  private $dateFields = [
    'expiration_date',
  ];

  /**
   * @var Model
   */
  private $model;
  /**
   * @var string
   */
  private $modelType;
  /**
   * @var string
   */
  private $actionType;

  /**
   * ActionLogger constructor.
   * @param Model $model
   * @param string $modelType
   * @param string $actionType
   */
  public function __construct(Model $model, string $modelType, string $actionType)
  {
    $this->model = $model;
    $this->modelType = $modelType;
    $this->actionType = $actionType;
  }

  /**
   * @param Model $model
   * @param string $modelType
   * @param string $actionType
   */
  public static function record(Model $model, string $modelType, string $actionType)
  {
    (new static($model, $modelType, $actionType))->createActionLog();
  }

  /**
   * Create new Action Log and persist it to the db.
   */
  protected function createActionLog()
  {
    list($beforeAttributes, $afterAttributes) = $this->getAttributes();

    if ($this->actionType === 'updated' && empty($beforeAttributes)) {
      return;
    }

    ActionLog::create([
      'user_id' => auth()->id(),
      'type' => $this->actionType,
      'model_id' => $this->model->id,
      'model_type' => $this->modelType,
      'before_attributes' => json_encode($beforeAttributes),
      'after_attributes' => json_encode($afterAttributes),
    ]);
  }

  /**
   * Get before and after attributes.
   *
   * @return array[]
   */
  protected function getAttributes(): array
  {
    $afterAttributes = $this->model->getChanges();
    $beforeAttributes = [];

    foreach ($afterAttributes as $key => $value) {
      $tempVal = $this->model->getOriginal($key);

      if (in_array($key, $this->dateFields)) {
        $tempVal = Carbon::parse($tempVal)->format('Y-m-d');
        $value = Carbon::parse($value)->format('Y-m-d');
      }

      if (in_array($key, $this->excludedFields) || $tempVal == $value) {
        unset($afterAttributes[$key]);
        continue;
      }

      if ($key === 'is_admin') {
        $beforeAttributes[$key] = $tempVal == 1 ? __('general.field.yes') : __('general.field.no');
        $afterAttributes[$key] = $value == 1 ? __('general.field.yes') : __('general.field.no');
        continue;
      }

      if (Str::of($key)->endsWith('_id')) {
        $model = Str::of($key)->replace('_id', '')->camel()->ucfirst()->__toString();

        if (file_exists(base_path("app/$model.php"))) {
          $instance = "App\\$model";

          $modelKey = Str::of($model)->snake()->__toString();
          $beforeAttributes[$modelKey] = ($tempVal == null) ? __('general.field.no') : $instance::whereId($tempVal)->withTrashed()->first()->getLogActionModelName();
          unset($afterAttributes[$key]);
          $afterAttributes[$modelKey] = ($value == null) ? __('general.field.no') : $instance::whereId($value)->withTrashed()->first()->getLogActionModelName();

          continue;
        }
      }

      if (in_array($key, $this->dateFields)) {
        $afterAttributes[$key] = Carbon::parse($value)->formatLocalized('%d %B %Y');
        $beforeAttributes[$key] = Carbon::parse($tempVal)->formatLocalized('%d %B %Y');

        continue;
      }

      $beforeAttributes[$key] = ($tempVal == null) ? __('general.field.no') : $tempVal;
    }

    return [$beforeAttributes, $afterAttributes];
  }
}
