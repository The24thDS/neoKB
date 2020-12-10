<tr
  x-data="{ domainUpdatedNotification: @entangle('showDomainUpdatedNotification'), domainDeleted: @entangle('domainDeleted')}">
  <td class="text-center p-1 px-2 align-top">
    <x-jet-input id="name" type="name" class="mt-1 block w-full" wire:model="domain.name"
      x-bind:disabled="domainDeleted" />
    <x-jet-input-error for="domain.name" class="mt-2" />
  </td>
  <td class="text-center p-1 px-2 align-top py-4">
    <button x-show="!domainUpdatedNotification && !domainDeleted" wire:click="save" wire:loading.remove>Save</button>
    <x-spinner wire:loading.delay class="w-6 h-6" wire:target='save' />
    <p x-show="domainUpdatedNotification" class="text-green-400">
      Domain updated
    </p>
    <button x-show="!domainUpdatedNotification && !domainDeleted" wire:click='resetDomain'
      wire:loading.remove>Reset</button>
    <button x-show="!domainUpdatedNotification && !domainDeleted" wire:click='delete'
      wire:loading.remove>Delete</button>
    <p x-show="domainDeleted" class="text-red-400">
      Domain deleted
    </p>
    <script>
      document.addEventListener('livewire:load', function() {
        @this.on('domain-updated', () => {
          setTimeout(() => {
            @this.showDomainUpdatedNotification = false;
          }, 1000);
        })
      });

    </script>
  </td>
</tr>
