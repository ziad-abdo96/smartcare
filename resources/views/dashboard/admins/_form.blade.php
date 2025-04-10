<label>Name</label>
<x-form.input name="name" value="{{ optional($admin)->name }}" placeholder="Enter Full Name" />

<label>Email Address</label>
<x-form.input name="email" value="{{ optional($admin)->email }}" placeholder="Enter email address" />

<label>password</label>
<x-form.input name="password" value="{{ optional($admin)->password }}" placeholder="Enter password" />


<label>Gender</label>
<x-form.radio name="gender" selected="{{ optional($admin)->gender }}" />

<label>Profile Image</label>
<x-form.input type="file" name="image" value="{{ optional($admin)->image }}" placeholder="Enter Image" />

<label>Date Of Birth</label>
<x-form.input type="date" name="date_of_birth" value="{{ optional($admin)->date_of_birth }}"
    placeholder="Enter birthday" />

<label>Phone Number</label>
<x-form.input name="phone" value="{{ optional($admin)->phone }}" placeholder="Enter phone number" />

<label for="role">Choose Role:</label>
<select name="role_id" id="role" class="form-control">
    @foreach ($roles as $role)
        <option value="{{ $role->id }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>
            {{ $role->name }}
        </option>
    @endforeach
</select>

<button type="submit" class="btn btn-primary">Save</button>
