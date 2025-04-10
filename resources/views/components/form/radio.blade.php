@props([
    'name',
    'selected',
])
<div class="form-group">
    <label for="{{ $name }}">{{ $slot }}</label>
    <select name="{{ $name }}" id="{{ $name }}" @class(['form-control', 'is-invalid' => $errors->has($name)]) {{ $attributes }}>
        <option value="">Select {{ $name }}</option>
        <option value="male" @selected(old('gender', $selected) == 'male')>Male</option>
        <option value="female" @selected(old('gender', $selected) == 'female')>Female</option>
    </select>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div> 
