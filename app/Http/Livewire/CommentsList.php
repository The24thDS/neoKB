<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentsList extends Component
{
  public $article;

  protected $listeners = ['commentAdded', 'refresh' => '$refresh'];

  public function render()
  {
    return view('livewire.comments-list', ['comments' => $this->article->comments->sortByDesc('created_at')]);
  }

  public function delete($commentId)
  {
    Comment::find($commentId)->delete();
    session()->flash("deleted_comment_$commentId", "Comment deleted successfully.");
  }

  public function commentAdded($articleId)
  {
    if ($this->article->id === $articleId) {
      $this->emitSelf('refresh');
    }
  }
}
