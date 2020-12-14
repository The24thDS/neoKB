<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  use HasFactory;

  protected $fillable = [
    'title', 'content', 'domain_id', 'user_id',
    'upvotes', 'approved', 'approved_by'
  ];

  public function domains()
  {
    return $this->belongsToMany(Domain::class, 'articles_domains');
  }

  public function author()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
