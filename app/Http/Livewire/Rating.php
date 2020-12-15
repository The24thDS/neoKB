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
    $this->article->upvote();
    $this->updateRating();
    $this->updateStatus();
  }

  public function downvote()
  {
    $this->article->downvote();
    $this->updateRating();
    $this->updateStatus();
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
