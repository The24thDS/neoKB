<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
  use HasFactory, Searchable;

  protected $fillable = [
    'title', 'content', 'domain_id',
    'user_id', 'approved', 'approved_by'
  ];

  public function setContent($content)
  {
    $this->content =
      join('', array_map(fn ($line) => "<p>$line</p>", preg_split('/\n|\r\n?/', $content)));
  }

  public function getCleanContent()
  {
    return str_replace('</p>', "\r\n", str_replace('<p>', '', $this->content));
  }

  public function domains()
  {
    return $this->belongsToMany(Domain::class, 'articles_domains');
  }

  public function domainsOptionsData()
  {
    return $this->domains->mapWithKeys(fn ($domain) => [$domain->name => $domain->id]);
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
}
