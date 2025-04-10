
<!-- Health Section -->
<div class="form-group">
    <label for="blood_type">Blood Type</label>
    <select name="blood_type" id="blood_type" @class(['form-control', 'is-invalid' => $errors->has('blood_type')]) required>
        <option value="">Select Blood Type</option>
        <option value="A+" @selected(old('blood_type', optional($patient)->blood_type) == 'A+')>A+</option>
        <option value="A-" @selected(old('blood_type', optional($patient)->blood_type) == 'A-')>A-</option>
        <option value="B+" @selected(old('blood_type', optional($patient)->blood_type) == 'B+')>B+</option>
        <option value="B-" @selected(old('blood_type', optional($patient)->blood_type) == 'B-')>B-</option>
        <option value="AB+" @selected(old('blood_type', optional($patient)->blood_type) == 'AB+')>AB+</option>
        <option value="AB-" @selected(old('blood_type', optional($patient)->blood_type) == 'AB-')>AB-</option>
        <option value="O+" @selected(old('blood_type', optional($patient)->blood_type) == 'O+')>O+</option>
        <option value="O-" @selected(old('blood_type', optional($patient)->blood_type) == 'O-')>O-</option>
    </select>
    @error('blood_type')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>