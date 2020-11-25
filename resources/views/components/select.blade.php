@props(['disabled' => false, 'options' => []])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-input rounded-md shadow-sm']) !!}>
  @foreach ($options as $item => $key)
    <option value="{{ $key }}">{{ $item }}</option>
  @endforeach
</select>
