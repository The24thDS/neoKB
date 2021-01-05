<tr
  x-data="{ userUpdatedNotification: @entangle('showUserUpdatedNotification'), userDeleted: @entangle('userDeleted')}">
  <td class="text-center p-1 px-2 align-top">
    <x-jet-input id="name" type="name" class="mt-1 block w-full" wire:model="user.name" x-bind:disabled="userDeleted" />
    <x-jet-input-error for="user.name" class="mt-2" />
  </td>
  <td class="text-center p-1 px-2 align-top">
    <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model="user.email"
      x-bind:disabled="userDeleted" />
    <x-jet-input-error for="user.email" class="mt-2" />
  </td>
  <td class="text-center p-1 px-2 align-top">
    <x-select id="role" name="role" class="mt-1 block w-full" :options="$this->roleOptions" wire:model="user.is_admin"
      x-bind:disabled="userDeleted" />
  </td>
  <td class="text-center p-1 px-2 align-top py-4">
    <button x-show="!userUpdatedNotification && !userDeleted" wire:click="save" wire:loading.remove>Save</button>
    <x-spinner wire:loading.delay class="w-6 h-6" wire:target='save' />
    <p x-show="userUpdatedNotification" class="text-green-400">
      User updated
    </p>
    <button x-show="!userUpdatedNotification && !userDeleted" wire:click='resetFields'
      wire:loading.remove>Reset</button>
    <button x-show="!userUpdatedNotification && !userDeleted" wire:click='delete' wire:loading.remove>Delete</button>
    <p x-show="userDeleted" class="text-red-400">
      User deleted
    </p>
    <script>
      document.addEventListener('livewire:load', function() {
        @this.on('user-updated', () => {
          setTimeout(() => {
            @this.showUserUpdatedNotification = false;
          }, 1000);
        })
      });

    </script>
  </td>
</tr>
