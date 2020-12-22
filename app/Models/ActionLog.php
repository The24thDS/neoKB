<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ActionLog extends Model
{
  protected $fillable = [
    'model_id', 'model_type', 'user_id', 'type', 'before_attributes', 'after_attributes',
  ];

  protected $with = [
    'user', 'model',
  ];

  protected $casts = [
    'before_attributes' => 'array',
    'after_attributes' => 'array',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function model()
  {
    return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
  }

  public function scopeFiltered(Builder $query)
  {
    if ($userId = request('user_id')) {
      $query->whereUserId($userId);
    }

    if ($modelType = request('model_type')) {
      $query->whereModelType($modelType);
    }

    if (request('start_date') && request('end_date')) {
      $query->whereDate('created_at', '>=', request('start_date'))
        ->whereDate('created_at', '<=', request('end_date'));
    }

    return $query;
  }
}
