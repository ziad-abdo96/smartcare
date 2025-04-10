@props(['name', 'value'])

<div class="form-group">
    <label for="{{ $name }}">{{ $slot }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" @class(['form-control', 'is-invalid' => $errors->has($name)]) rows="4"
        {{ $attributes }}>{{ old('description_of_condition', optional($value)->$name) }}</textarea>
    @error('description_of_condition')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
