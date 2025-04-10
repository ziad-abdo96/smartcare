<label>Name</label>
<x-form.input name="name" value="{{ optional($nurse->user)->name }}" placeholder="Enter Full Name" />

<label>Email Address</label>
<x-form.input name="email" value="{{ optional($nurse->user)->email }}" placeholder="Enter email address" />

<label>password</label>
<x-form.input name="password" value="{{ optional($nurse->user)->password }}" placeholder="Enter password" />

<label>Gender</label>
<x-form.radio name="gender" selected="{{ optional($nurse->user)->gender }}" />

<label>Profile Image</label>
<x-form.input type="file" name="image" value="{{ optional($nurse->user)->image }}" placeholder="Enter Image" />

<label>Date Of Birth</label>
<x-form.input type="date" name="date_of_birth" value="{{ optional($nurse->user)->date_of_birth }}"
    placeholder="Enter birthday" />

<label>Phone Number</label>
<x-form.input name="phone" value="{{ optional($nurse->user)->phone }}" placeholder="Enter phone number" />

<label>Experience of years</label>
<x-form.input name="experience_of_years" value="{{ optional($nurse->user)->experience_of_years }}"
    placeholder="Enter experience of years" />

<button type="submit" class="btn btn-primary">Save</button>
