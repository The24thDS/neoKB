<x-app-layout>
  <x-slot name="title">
    - {{ $user->name }}
  </x-slot>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $user->name }}'s profile
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 grid grid-cols-5">
        <sidebar class="pr-2 border-r">
          <img src="{{ $user->profile_photo_url }}"
            class="rounded w-2/3 block mx-auto shadow hover:shadow-none transition duration-200 ease-in-out" />
          <p class="text-center text-lg font-semibold">{{ $user->name }}</p>
          <p class="text-center text-sm">joined {{ $user->created_at->format('d M Y h:m A') }}</p>
        </sidebar>
        <section class="col-span-4 px-2 pl-4 overflow-visible flex flex-col items-center">
          <h2 class="text-xl font-semibold">Latest articles</h2>
          @forelse ($user->articles->sortByDesc('created_at')->take(4) as $article)
            <div
              class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mt-4 flex flex-wrap transition duration-500 ease-in-out transform hover:scale-105 z-10"
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
                  <a href="{{ route('feed') . "?domain=$domain->name" }}"
                    class="p-1 px-2 leading-7 bg-blue-300 rounded opacity-75 hover:opacity-100 cursor-pointer text-xs">{{ $domain->name }}</a>
                @endforeach
              </div>
            </div>
          @empty
            <p>No articles posted by this user.</p>
          @endforelse
          @if ($user->articles->count() > 4)
            <a href="{{ route('feed') . "?user=$user->id" }}">
              <x-jet-button class="mt-8 mx-auto">See more</x-jet-button>
            </a>
          @endif
        </section>
      </div>
    </div>
  </div>
</x-app-layout>
