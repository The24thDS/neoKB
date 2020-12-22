<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Str;

class Article extends Model
{
  use HasFactory, Searchable, Loggable;

  protected $fillable = [
    'title', 'content', 'domain_id',
    'user_id', 'approved', 'approved_by'
  ];

  public function getCleanContent()
  {
    return Purify::clean($this->content);
  }

  public function getExcerptAttribute()
  {
    return Purify::clean(Str::limit($this->content));
  }

  public function domains()
  {
    return $this->belongsToMany(Domain::class, 'articles_domains');
  }

  public function domainsOptionsData()
  {
    return $this->domains->mapWithKeys(fn ($domain) => [$domain->name => $domain->id]);
  }

  public function edits()
  {
    return $this->hasMany(ArticleEdits::class, 'article_id');
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

  public function comments()
  {
    return $this->hasMany(Comment::class);
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
    $this->searchable();
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
    $this->searchable();
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

  public function toSearchableArray()
  {
    $article = $this->fresh();
    $array = $article->toArray();
    $array = $article->transform($array);

    $array['author_name'] = $article->author->name;
    $array['rating'] = $article->rating();
    $array['domains'] = $article->domains->map(function ($data) {
      return $data['name'];
    })->toArray();

    return $array;
  }

  public function getLogActionModelName()
  {
    return $this->title;
  }
}
