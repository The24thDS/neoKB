<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
  use WithPagination;

  public $searchTerm;

  public function render()
  {
    $articles = $this->searchTerm ? Article::search($this->searchTerm)->paginate(5) : [];
    return view('livewire.search', compact('articles'));
  }
}
