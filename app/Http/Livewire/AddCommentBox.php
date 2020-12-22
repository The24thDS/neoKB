<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class AddCommentBox extends Component
{
  public $articleId;
  public $content;
  public $postButtonDisabled = false;

  protected $rules = [
    'content' => 'required|min:30',
  ];

  public function render()
  {
    return view('livewire.add-comment-box');
  }

  public function save()
  {
    $this->postButtonDisabled = true;

    $this->validate($this->rules);

    Comment::create([
      'article_id' => $this->articleId,
      'author_id' => auth()->user()->id,
      'content' => $this->content,
    ]);

    $this->content = "";
    $this->postButtonDisabled = false;
    session()->flash('comment_added', 'Comment successfully added.');
  }
}
