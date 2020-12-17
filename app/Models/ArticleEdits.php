<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleEdits extends Model
{
  protected $fillable = [
    'article_id', 'title', 'content'
  ];

  public function getCleanContent()
  {
    return str_replace('</p>', "\r\n", str_replace('<p>', '', $this->content));
  }
}
