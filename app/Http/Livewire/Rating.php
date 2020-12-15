<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;

class Rating extends Component
{
  public Article $article;
  public int $rating;
  public bool $upvoted;
  public bool $downvoted;

  public function mount()
  {
    $this->updateRating();
    $this->updateStatus();
  }

  public function render()
  {
    return view('livewire.rating');
  }

  public function upvote()
  {
    if ($this->downvoted) {
      $this->rating = $this->rating + 1;
    }

    $this->article->upvote();
    $this->updateStatus();

    if ($this->upvoted) {
      $this->rating = $this->rating + 1;
    } else {
      $this->rating = $this->rating - 1;
    }
  }

  public function downvote()
  {
    if ($this->upvoted) {
      $this->rating = $this->rating - 1;
    }

    $this->article->downvote();
    $this->updateStatus();

    if ($this->downvoted) {
      $this->rating = $this->rating - 1;
    } else {
      $this->rating = $this->rating + 1;
    }
  }

  private function updateStatus()
  {
    $this->upvoted = $this->article->fresh()->upvotedByUser(auth()->user());
    $this->downvoted = $this->article->fresh()->downvotedByUser(auth()->user());
  }

  private function updateRating()
  {
    $this->rating = $this->article->fresh()->rating();
  }
}
