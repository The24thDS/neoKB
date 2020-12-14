<x-app-layout>
  <x-slot name="title">
    - {{ __('Feed') }}
  </x-slot>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Feed') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <x-jet-button><a href="{{ route('article.create') }}">New article</a></x-jet-button>

      <div class="w-full mb-6 flex-wrap grid grid-cols-3 gap-6">
        @forelse ($articles as $article)
          <div
            class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mt-4 flex flex-wrap transition duration-500 ease-in-out transform hover:scale-110 z-10"
            style="width: 100%; min-height: 25vmin">
            <a href="{{ route('article.show', ['article' => $article->id]) }}"
              class="my-2 text-lg font-semibold mb-4 w-full cursor-pointer hover:underline">{{ $article->title }}</a>
            <p class="text-gray-500 mb-2 text-sm w-full">posted on {{ $article->created_at->format('j F Y') }} by
              {{ $article->author->name }}
            </p>
            <article>
              {!! strlen($article->content) > 100 ? substr($article->content, 0, 100) . ' ...' : $article->content !!}
            </article>
            <div class="self-end mt-2 w-full">
              @foreach ($article->domains as $domain)
                <a
                  class="p-1 px-2 bg-blue-300 rounded opacity-75 hover:opacity-100 cursor-pointer text-xs">{{ $domain->name }}</a>
              @endforeach
            </div>
          </div>
        @empty
          <p>No articles available</p>
        @endforelse
      </div>
      {{ $articles->links() }}
    </div>
  </div>
</x-app-layout>
