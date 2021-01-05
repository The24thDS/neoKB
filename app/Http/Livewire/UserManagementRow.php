<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserManagementRow extends Component
{
  public User $user;
  public $roleOptions;
  public $showUserUpdatedNotification = false;
  public $userDeleted = false;

  protected $rules = [
    'user.name' => 'required',
    'user.email' => 'required',
    'user.is_admin' => 'required',
  ];

  public function mount()
  {
    $this->roleOptions = collect(config('general.roles'));
  }

  public function render()
  {
    return view('livewire.user-management-row');
  }

  public function save()
  {
    $this->validate([
      'user.name' => ['required', 'string', 'max:255'],
      'user.email' => ['required', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
      'user.is_admin' => ['required', Rule::in($this->roleOptions->values()->toArray())],
    ]);
    $this->user->save();
    $this->emit('user-updated', $this->user->id);
    $this->showUserUpdatedNotification = true;
  }

  public function resetFields()
  {
    $this->user->fill([
      'name' => $this->user->getOriginal('name'),
      'email' => $this->user->getOriginal('email'),
      'is_admin' => $this->user->getOriginal('is_admin'),
    ]);
  }

  public function delete()
  {
    $this->user->delete();
    $this->userDeleted = true;
  }
}
