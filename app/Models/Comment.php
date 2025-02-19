<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
  protected $fillable = [
    'author_id', 'article_id', 'content'
  ];

  public function article(): BelongsTo
  {
    return $this->belongsTo(Article::class);
  }

  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
