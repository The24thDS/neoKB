<x-app-layout>
  <x-slot name="title">
    - {{ __('general.title.new_article') }}
  </x-slot>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('general.title.new_article') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
        <form method="POST" action="{{ route('article.store') }}" class="mx-auto my-2">
          @csrf
          <h3 class="mt-2">Title</h3>
          <x-jet-input id='title' name='title' placeholder='Article title' class='w-2/3 block'
            value="{{ old('title') ?? '' }}" required />
          <x-jet-input-error for="title" class="mt-2 block" />
          <h3 class="mt-2">Content</h3>
          <textarea class='form-input rounded-md shadow-sm mt-2 w-2/3 h-96 block' placeholder="Article content here"
            id="content" name="content" required>{{ old('content') ?? '' }}</textarea>
          <x-jet-input-error for="content" class="mt-2 block" />
          <h3 class="mt-2">Domains</h3>
          <x-select :options="$domains" multiple class='mt-2 block' name="domains[]" />
          <x-jet-input-error for="domain" class="mt-2 block" />
          <x-jet-button type="submit" class="mt-2">Publish</x-jet-button>
        </form>
      </div>
    </div>
  </div>

</x-app-layout>
