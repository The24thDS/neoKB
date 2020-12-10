<?php

namespace App\Traits;

use App\Helpers\ActionLogger;
use Illuminate\Database\Eloquent\Model;

trait Loggable
{
  abstract public function getLogActionModelName();

  protected static function bootLoggable()
  {
    $modelType = static::class;

    static::created(function ($model) use ($modelType) {
      ActionLogger::record($model, $modelType, 'created');
    });

    static::updated(function (Model $model) use ($modelType) {
      ActionLogger::record($model, $modelType, 'updated');
    });

    static::deleted(function ($model) use ($modelType) {
      ActionLogger::record($model, $modelType, 'deleted');
    });
  }
}
