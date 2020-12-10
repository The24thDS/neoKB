<x-app-layout>
  <x-slot name="title">
    - {{ __('general.title.action_logs') }}
  </x-slot>

  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('general.title.action_logs') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
        <table class="mx-auto my-2">
          <thead>
            <tr>
              <th class="bg-blue-100 p-1 px-2 border-r border-gray-600">{{ __('general.field.user') }}</th>
              <th class="bg-blue-100 p-1 px-2 border-r border-gray-600">{{ __('general.field.action') }}</th>
              <th class="bg-blue-100 p-1 px-2 border-r border-gray-600">{{ __('general.text.from') }}</th>
              <th class="bg-blue-100 p-1 px-2 border-r border-gray-600">{{ __('general.text.to') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($actionLogs as $actionLog)
              <tr>
                <td class="px-4">{{ $actionLog->user->name ?? 'Application' }}</td>
                <td class="px-4">{{ $actionLog->type }} {{ __("general.model.$actionLog->model_type") }}
                  {{ $actionLog->model ? $actionLog->model->getLogActionModelName() : 'error' }}
                </td>
                <td class="px-4">
                  <ul>
                    @foreach (((array) json_decode($actionLog->before_attributes)) as $key => $value)
                      <li>{{ __("general.field.$key") }}: {{ $value }}</li>
                    @endforeach
                  </ul>
                </td>
                <td class="px-4">
                  <ul>
                    @foreach (((array) json_decode($actionLog->after_attributes)) as $key => $value)
                      <li>{{ __("general.field.$key") }}: {{ $value }}</li>
                    @endforeach
                  </ul>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $actionLogs->links() }}
      </div>
    </div>
  </div>
</x-app-layout>
