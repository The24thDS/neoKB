<?php

namespace App\Http\Livewire;

use App\Models\Domain;
use Livewire\Component;

class DomainManagementRow extends Component
{
  public Domain $domain;
  public $showDomainUpdatedNotification = false;
  public $domainDeleted = false;

  protected $rules = [
    'domain.name' => 'required',
  ];

  public function render()
  {
    return view('livewire.domain-management-row');
  }

  public function save()
  {
    $this->validate([
      'domain.name' => ['required', 'string', 'max:255', 'unique:domains,name,' . $this->domain->id],
    ]);
    $this->domain->save();
    $this->emit('domain-updated', $this->domain->id);
    $this->showDomainUpdatedNotification = true;
  }

  public function resetDomain()
  {
    $this->domain->fill([
      'name' => $this->domain->getOriginal('name'),
    ]);
  }

  public function delete()
  {
    $this->domain->delete();
    $this->domainDeleted = true;
  }
}
