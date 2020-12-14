@props(['disabled' => false, 'options' => []])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-input rounded-md shadow-sm']) !!}>
  @foreach ($options as $item => $key)
    <option value="{{ $key }}"
      {{ in_array($key, old(str_replace(['[', ']'], '', $attributes['name'])) ?? []) ? 'selected' : '' }}>
      {{ $item }}
    </option>
  @endforeach
</select>
