<x-app-layout>
  <x-slot name="title">
    - {{ __('general.title.domains_management') }}
  </x-slot>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('general.title.domains_management') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
        <section class="flex flex-col">
          <h2 class="ml-2 mt-2 font-bold text-xl text-gray-800">Create a new domain</h2>
          <form class="mx-auto my-2 flex items-start" method="POST" action="{{ route('admin.domains') }}">
            @csrf
            <span>
              <x-jet-input id="name" type="name" name="name" class="mt-1" placeholder="Domain name"
                value="{{ old('name') ?? '' }}" />
              <x-jet-input-error for="name" class="mt-2" />
            </span>
            <x-jet-button type="submit" class="bg-green-400 hover:bg-green-600 font-extrabold text-sm m-1">Create
            </x-jet-button>
          </form>
        </section>
        <h2 class="ml-2 mt-6 font-bold text-xl text-gray-800">Manage existing domains</h2>
        <table class="mx-auto my-2">
          <thead>
            <tr>
              <th class="bg-blue-100 p-1 px-2 border-r border-gray-600">{{ __('general.field.name') }}</th>
              <th class="bg-blue-100 p-1 px-2">{{ __('general.text.actions') }}</th>
            </tr>
          </thead>
          <tbody>
            @if (count($domains))
              @foreach ($domains as $domain)
                <livewire:domain-management-row :domain="$domain" :key="$domain->id">
              @endforeach
            @else
              <td colspan="2" class="text-center">No data</td>
            @endif
          </tbody>
        </table>
        {{ $domains->links() }}
      </div>
    </div>
  </div>
</x-app-layout>
