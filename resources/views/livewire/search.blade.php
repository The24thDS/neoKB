<div class="w-1/2 relative" x-data="{showDropdown: @entangle('showDropdown')}">
  <x-jet-input type="text" wire:model.debounce.500ms="searchTerm" class="w-full"
    x-on:focus="$wire.set('inputFocus', true)" x-on:blur.debounce.100ms="$wire.set('inputFocus', false)"
    placeholder="Search" />
  <ul x-show="showDropdown" x-on:click="$wire.set('resultsFocus', true)"
    x-on:click.away="$wire.set('resultsFocus', false)" x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-2" class="absolute w-full bg-white shadow-xl z-20 p-4">
    @forelse ($articles as $article)
      <li class="py-2 border-b flex justify-between">
        <div class="flex flex-col pl-4">
          <a href="{{ route('article.show', ['article' => $article->id]) }}"
            class="text-lg font-semibold hover:underline">
            {{ $article->title }}
          </a>
          <span class="text-sm text-gray-600">by <a class="font-semibold hover:underline">{{ $article->author->name }}</a>
          </span>
          <span>
            @foreach ($article->domains as $domain)
              <a class="px-1 bg-blue-300 rounded opacity-75 hover:opacity-100 text-xs">{{ $domain->name }}</a>
            @endforeach
          </span>
        </div>
        <div
          class="self-center pr-4 text-lg font-bold {{ $article->rating() > 0 ? 'text-green-500' : ($article->rating() < 0 ? 'text-red-500' : 'text-gray-500') }}">
          {{ $article->rating() }}
        </div>

      </li>
    @empty
      @if (!empty($searchTerm))
        <li>{{ __('general.text.no_items_found_matching', ['items' => 'articles']) }}</li>
      @endif
    @endforelse
    <li class="my-2 mt-4">
      {{ optional($articles)->links('vendor.livewire.simple-tailwind') }}
    </li>
    <li class="flex justify-end mt-4">
      <a href="https://www.algolia.com">
        <img
          src="https://res.cloudinary.com/hilnmyskv/image/upload/q_auto/v1607432709/Algolia_com_Website_assets/images/shared/algolia_logo/search-by-algolia-light-background.svg" />
      </a>
    </li>
  </ul>
</div>
