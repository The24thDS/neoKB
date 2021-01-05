<x-app-layout>
  <x-slot name="title">
    - {{ __('Feed') }}
  </x-slot>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Feed') }}
    </h2>
    <livewire:search />
    <div>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <a href="{{ route('article.create') }}">
        <x-jet-button>New article</x-jet-button>
      </a>
      <a href="{{ route('feed') }}">
        <x-jet-secondary-button class="mr-6">Clear all filters</x-jet-secondary-button>
      </a>
      @if (Request::has('domain'))
        <a href="{{ request()->fullUrlWithQuery(['domain' => null]) }}">
          <x-jet-secondary-button class="relative pr-6">domain: {{ Request::get('domain') }} <span
              class="absolute right-1">&cross;</span>
          </x-jet-secondary-button>

        </a>
      @endif
      @if (Request::has('user'))
        <a href="{{ request()->fullUrlWithQuery(['user' => null]) }}">
          <x-jet-secondary-button class="relative pr-6">user: {{ $articles->first()->author->name }}<span
              class="absolute right-1">&cross;</span>
          </x-jet-secondary-button>

        </a>
      @endif

      <div class="w-full mb-6 grid grid-cols-3 gap-6">
        @forelse ($articles as $article)
          <div
            class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mt-4 flex flex-wrap transition duration-500 ease-in-out transform hover:scale-110 z-10"
            style="width: 100%; min-height: 25vmin">
            <div class="flex space-between w-full items-start">
              <a href="{{ route('article.show', ['article' => $article->id]) }}"
                class="my-2 text-lg font-semibold mb-4 w-full cursor-pointer hover:underline">
                {{ $article->title }}
              </a>
              <livewire:rating :article="$article" />
            </div>
            <p class="text-gray-500 mb-2 text-sm w-full">posted on {{ $article->created_at->format('j F Y') }} by
              {{ $article->author->name }}
            </p>
            <article>
              {!! $article->excerpt !!}
            </article>
            <div class="self-end mt-2 w-full">
              @foreach ($article->domains as $domain)
                <a href="{{ request()->fullUrlWithQuery(['domain' => $domain->name]) }}"
                  class="p-1 px-2 leading-7 bg-blue-300 rounded opacity-75 hover:opacity-100 cursor-pointer text-xs">{{ $domain->name }}</a>
              @endforeach
            </div>
          </div>
        @empty
          <p>No articles available</p>
        @endforelse
      </div>
      {{ $articles->links('vendor.pagination.tailwind') }}
    </div>
  </div>
  <link href="{{ asset('css/prism.css') }}" rel="stylesheet" />
  <script src="{{ asset('js/prism.js') }}"></script>
</x-app-layout>
