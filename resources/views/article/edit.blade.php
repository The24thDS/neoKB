<x-app-layout>
  <x-slot name="title">
    - {{ __('general.title.update_article') }}
  </x-slot>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('general.title.update_article') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
        <form method="POST" action="{{ route('article.update', ['article' => $article->id]) }}" class="mx-auto my-2">
          @csrf
          @method('PATCH')
          <h3 class="mt-2">Title</h3>
          <x-jet-input id='title' name='title' placeholder='Article title' class='w-2/3 block'
            value="{{ old('title') ?? ($article->title ?? '') }}" required />
          <x-jet-input-error for="title" class="mt-2 block" />
          <h3 class="mt-2">Content</h3>
          <textarea class='form-input rounded-md shadow-sm mt-2 w-2/3 h-96 block' placeholder="Article content here"
            id="content" name="content" required>{{ old('content') ?? ($article->getCleanContent() ?? '') }}</textarea>
          <x-jet-input-error for="content" class="mt-2 block" />
          <h3 class="mt-2">Domains</h3>
          <x-select :options="$domains" :selected="$article->domainsOptionsData()" multiple class='mt-2 block'
            name="domains[]" />
          <x-jet-input-error for="domains" class="mt-2 block" />
          <x-jet-button type="submit" class="mt-2">Save</x-jet-button>
          <a href="{{ route('article.show', ['article' => $article->id]) }}">
            <x-jet-secondary-button type="button" class="mt-2 ml-2">Cancel</x-jet-secondary-button>
          </a>
        </form>
      </div>
    </div>
  </div>

</x-app-layout>
