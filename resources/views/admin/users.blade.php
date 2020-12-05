<x-app-layout>
  <x-slot name="title">
    - {{ __('general.title.users_management') }}
  </x-slot>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('general.title.users_management') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
        <table class="mx-auto my-2">
          <thead>
            <tr>
              <th class="bg-blue-100 p-1 px-2 border-r border-gray-600">{{ __('general.field.name') }}</th>
              <th class="bg-blue-100 p-1 px-2 border-r border-gray-600">{{ __('general.field.email') }}</th>
              <th class="bg-blue-100 p-1 px-2 border-r border-gray-600">{{ __('general.field.role') }}</th>
              <th class="bg-blue-100 p-1 px-2">{{ __('general.text.actions') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <livewire:user-management-row :user="$user" :key="$user->id">
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>
