<label>Name</label>
<x-form.input name="name" value="{{ optional($doctor->user)->name }}" placeholder="Enter Full Name" />

<label>Email Address</label>
<x-form.input name="email" value="{{ optional($doctor->user)->email }}" placeholder="Enter email address" />

<label>password</label>
<x-form.input name="password" value="{{ optional($doctor->user)->password }}" placeholder="Enter password" />

<label>Department</label>
<x-form.select-department name="department_id" user="doctor" :items="$departments"/>

<label>Gender</label>
<x-form.radio name="gender"  selected="{{ optional($doctor->user)->gender }}"/>

<label>Profile Image</label>
<x-form.input type="file" name="image" value="{{ optional($doctor->user)->image }}" placeholder="Enter Image" />

<label>Date Of Birth</label>
<x-form.input type="date" name="date_of_birth" value="{{ optional($doctor->user)->date_of_birth }}"
    placeholder="Enter birthday" />

<label>Phone Number</label>
<x-form.input name="phone" value="{{ optional($doctor->user)->phone }}" placeholder="Enter phone number" />

<label>Specialty</label>
<x-form.input name="specialty" value="{{ optional($doctor->user)->specialty }}" placeholder="Enter specialty" />

<label></label>
<x-form.input name="about" value="{{ optional($doctor->user)->about }}" placeholder="Enter description" />


<button type="submit" class="btn btn-primary">Save</button>
