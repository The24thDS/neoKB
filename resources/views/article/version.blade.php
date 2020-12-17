<x-app-layout>
  <x-slot name="title">
    - {{ $article->title }} !! Old Version !!
  </x-slot>

  <x-slot name="header">
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $article->title }}
    </h1>
    <span class="text-gray-500 font-bold">Old Version</span>
  </x-slot>

  <div class="py-12 article_page">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 grid grid-cols-5">
        <article class="col-span-4 leading-7 px-4">
          {!! $articleEdit->content !!}
        </article>
        <sidebar class="border-l pl-6 relative h-full">
          <a class="author cursor-pointer">
            <img src="{{ $article->author->profile_photo_url }}"
              class="rounded w-2/3 block mx-auto shadow hover:shadow-none transition duration-200 ease-in-out" />
            <p class="author_name text-center text-lg font-semibold">{{ $article->author->name }}</p>
          </a>
          <div class="date text-gray-500 mt-1 text-sm">
            <p>created on {{ $articleEdit->created_at }}</p>
            <p><a href="{{ route('article.show', ['article' => $article->id]) }}"
                class="underline hover:no-underline">Go to the live version</a></p>
            @if ($article->edits->count() > 0)
              <p class="text-xs cursor-pointer border-b border-dotted inline-block relative article_edits">
                {{ $article->edits->count() - 1 }} other
                {{ $article->edits->count() - 1 === 1 ? 'edit' : 'edits' }}
              </p>
              <ul class="absolute z-10 bg-white p-2 shadow-md article_edits_dropdown">
                @foreach ($article->edits as $otherArticleEdit)
                  @if (!$articleEdit->is($otherArticleEdit))
                    <li class="underline hover:no-underline">
                      <a
                        href="{{ route('article.version', ['article' => $article, 'version' => $loop->iteration]) }}">{{ $otherArticleEdit->created_at }}</a>
                    </li>
                  @endif
                @endforeach
              </ul>
            @endif
          </div>
          <div class="domains mt-4">
            <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-1">
              Domains
            </h3>
            @foreach ($article->domains as $domain)
              <a
                class="p-1 px-2 bg-blue-300 rounded opacity-75 hover:opacity-100 cursor-pointer text-xs">{{ $domain->name }}</a>
            @endforeach
          </div>
        </sidebar>
      </div>
    </div>
  </div>

</x-app-layout>
