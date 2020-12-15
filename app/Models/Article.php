<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  use HasFactory;

  protected $fillable = [
    'title', 'content', 'domain_id',
    'user_id', 'approved', 'approved_by'
  ];

  public function domains()
  {
    return $this->belongsToMany(Domain::class, 'articles_domains');
  }

  public function upvotes()
  {
    return count($this->upvotedBy);
  }

  public function downvotes()
  {
    return count($this->downvotedBy);
  }

  public function rating()
  {
    return $this->upvotes() - $this->downvotes();
  }

  public function upvote()
  {
    $user = auth()->user();
    if (!$this->upvotedByUser($user)) {
      $this->upvotedBy()->attach($user->id);
      $this->downvotedBy()->detach($user->id);
    } else {
      $this->upvotedBy()->detach($user->id);
    }
  }

  public function downvote()
  {
    $user = auth()->user();
    if (!$this->downvotedByUser($user)) {
      $this->downvotedBy()->attach($user->id);
      $this->upvotedBy()->detach($user->id);
    } else {
      $this->downvotedBy()->detach($user->id);
    }
  }

  public function upvotedByUser(User $user)
  {
    return $this->upvotedBy->contains($user->id);
  }

  public function downvotedByUser(User $user)
  {
    return $this->downvotedBy->contains($user->id);
  }

  public function upvotedBy()
  {
    return $this->belongsToMany(User::class, 'articles_upvotes');
  }

  public function downvotedBy()
  {
    return $this->belongsToMany(User::class, 'articles_downvotes');
  }

  public function author()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
