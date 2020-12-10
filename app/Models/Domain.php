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

  public function getLogActionModelName(): string
  {
    return $this->name;
  }
}
