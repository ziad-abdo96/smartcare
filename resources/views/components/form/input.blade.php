@props([
    'name',
    'value' => '',
    'type' => 'text',
    'divClass' => '',
    ])

<div class="{{ $divClass }}">

    <label for="{{ $name }}">{{ $slot }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
        @class(['form-control', 'is-invalid' => $errors->has($name)]) {{ $attributes }} >

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>
