<x-app-layout>
  <x-slot name="title">
    - {{ $article->title }}
  </x-slot>

  <x-slot name="header">
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $article->title }}
    </h1>
    <livewire:rating :article="$article" />
  </x-slot>

  <div class="py-12 article_page">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @can('update', $article)
        <a href="{{ route('article.edit', ['article' => $article->id]) }}">
          <x-jet-button class="mb-4">
            Edit article
          </x-jet-button>
        </a>
      @endcan

      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 grid grid-cols-5">
        <article class="col-span-4 leading-7 px-4">
          {!! $article->getCleanContent() !!}
        </article>
        <sidebar class="border-l pl-6 relative h-full">
          <a href="{{ route('user.show', ['user' => $article->author->id]) }}" class="author">
            <img src="{{ $article->author->profile_photo_url }}"
              class="rounded w-2/3 block mx-auto shadow hover:shadow-none transition duration-200 ease-in-out" />
            <p class="author_name text-center text-lg font-semibold">{{ $article->author->name }}</p>
          </a>
          <div class="date text-gray-500 mt-1 text-sm">
            <p>created on {{ $article->created_at->format('j F Y') }}</p>
            <p>updated on {{ optional($article->updated_at)->format('j F Y') }}</p>
            @if ($article->edits->count() > 0)
              <p class="text-xs cursor-pointer border-b border-dotted inline-block relative article_edits">
                {{ $article->edits->count() }} past
                {{ $article->edits->count() === 1 ? 'version' : 'versions' }}
              </p>
              <ul class="absolute z-10 bg-white p-2 shadow-md article_edits_dropdown">
                @foreach ($article->edits as $articleEdit)
                  <li class="underline hover:no-underline">
                    <a
                      href="{{ route('article.version', ['article' => $article, 'version' => $loop->iteration]) }}">{{ $articleEdit->created_at }}</a>
                  </li>
                @endforeach
              </ul>
            @endif
          </div>
          <div class="domains mt-4">
            <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-1">
              Domains
            </h3>
            @foreach ($article->domains as $domain)
              <a href="{{ route('feed') . "?domain=$domain->name" }}"
                class="p-1 px-2 leading-7 bg-blue-300 rounded opacity-75 hover:opacity-100 cursor-pointer text-xs">{{ $domain->name }}</a>
            @endforeach
          </div>
        </sidebar>
        <livewire:add-comment-box :articleId="$article->id" />
      </div>
      <livewire:comments-list :article="$article" />
    </div>
  </div>
  <link href="{{ asset('css/prism.css') }}" rel="stylesheet" />
  <script src="{{ asset('js/prism.js') }}"></script>

</x-app-layout>
