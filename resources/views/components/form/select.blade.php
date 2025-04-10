
@props([
    'name',
    'items',
    'user'
])
<div class="form-group">
    <label for="{{ $name }}">{{ $slot }}</label>
    <select name="{{ $name }}" id="{{ $name }}" @class([
        'form-control',
        'is-invalid' => $errors->has($name),
    ]) {{ $attributes }}>
        <option value="">Select {{ $slot }}</option>
        @foreach ($items as $item)
            <option value="{{ $item->id }}" @selected(old($name, optional($user)->$name == $item->id) == $item->id)>
                {{ $item->user->name }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>