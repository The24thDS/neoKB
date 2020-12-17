<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\ArticleEdits;

class ArticleObserver
{
  /**
   * Handle the Article "created" event.
   *
   * @param  \App\Models\Article  $article
   * @return void
   */
  public function created(Article $article)
  {
    //
  }

  /**
   * Handle the Article "updated" event.
   *
   * @param  \App\Models\Article  $article
   * @return void
   */
  public function updated(Article $article)
  {
    if ($article->wasChanged('title') || $article->wasChanged('content')) {
      ArticleEdits::create([
        'article_id' => $article->id,
        'title' => $article->getOriginal('title'),
        'content' => $article->getOriginal('content'),
      ]);
    }
  }

  /**
   * Handle the Article "deleted" event.
   *
   * @param  \App\Models\Article  $article
   * @return void
   */
  public function deleted(Article $article)
  {
    //
  }

  /**
   * Handle the Article "restored" event.
   *
   * @param  \App\Models\Article  $article
   * @return void
   */
  public function restored(Article $article)
  {
    //
  }

  /**
   * Handle the Article "force deleted" event.
   *
   * @param  \App\Models\Article  $article
   * @return void
   */
  public function forceDeleted(Article $article)
  {
    //
  }
}
