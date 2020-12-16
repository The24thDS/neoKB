<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
  use HasFactory;
  use Loggable;
  use SoftDeletes;

  protected $fillable = [
    'name'
  ];

  public static function boot()
  {
    parent::boot();

    static::saved(function ($model) {
      $model->articles->filter(function ($item) {
        return $item->shouldBeSearchable();
      })->searchable();
    });
  }

  public function articles()
  {
    return $this->belongsToMany(Article::class, 'articles_domains');
  }

  public function getLogActionModelName(): string
  {
    return $this->name;
  }
}
