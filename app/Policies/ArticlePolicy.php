<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Article  $article
   * @return mixed
   */
  public function update(User $user, Article $article)
  {
    return $article->author->is($user);
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Article  $article
   * @return mixed
   */
  public function delete(User $user, Article $article)
  {
    return $article->author->is($user) || auth()->user()->is_admin;
  }
}
