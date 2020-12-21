<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;

class ArticleEdits extends Model
{
  protected $fillable = [
    'article_id', 'title', 'content'
  ];

  public function getCleanContent()
  {
    return Purify::clean($this->content);
  }
}
