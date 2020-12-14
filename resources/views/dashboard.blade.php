<x-app-layout>
  <x-slot name="title">
    - {{ __('Dashboard') }}
  </x-slot>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <x-jet-button><a href="{{ route('article.create') }}">New article</a></x-jet-button>
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mt-4">
      </div>
    </div>
  </div>
</x-app-layout>
