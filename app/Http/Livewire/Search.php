<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
  use WithPagination;

  public $searchTerm;
  public bool $inputFocus = false;
  public bool $resultsFocus = false;
  public bool $showDropdown = false;

  public function updatingSearchTerm()
  {
    $this->resetPage();
  }

  public function updatedInputFocus()
  {
    $this->updateShowDropdown();
  }

  public function updatedResultsFocus()
  {
    $this->updateShowDropdown();
  }

  public function updatedSearchTerm()
  {
    $this->updateShowDropdown();
  }

  public function updateShowDropdown()
  {
    $this->showDropdown = $this->resultsFocus || ($this->inputFocus && !empty($this->searchTerm));

    if (!$this->showDropdown) {
      $this->resetPage();
    }
  }

  public function render()
  {
    $articles = $this->searchTerm ? Article::search($this->searchTerm)->paginate(5) : [];
    return view('livewire.search', compact('articles'));
  }
}
