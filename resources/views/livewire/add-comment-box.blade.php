<div class="flex mt-8 col-span-4 flex-wrap" x-data="{disabled: @entangle('postButtonDisabled')}">
  <h2 class="w-full mb-2 text-lg font-semibold">Leave a comment:</h2>
  <textarea class="form-input rounded-md shadow-sm mr-2 w-4/5 block" wire:model.lazy="content"></textarea>
  <button type="submit" class="px-8 bg-blue-500 rounded text-white font-semibold shadow-xl hover:shadow-none text-xl"
    wire:click='save' :disabled="disabled">Post</button>
  <x-jet-input-error for="content" class="mt-2 w-full" />
  @if (session()->has('comment_added'))
    <div class="mt-2 w-full text-green-500 text-lg font-semibold">
      {{ session('comment_added') }}
    </div>
  @endif
</div>
