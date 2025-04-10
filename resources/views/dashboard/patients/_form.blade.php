<label>Name</label>
<x-form.input name="name" value="{{ optional($patient->user)->name }}" placeholder="Enter Full Name" />

<label>Email Address</label>
<x-form.input name="email" value="{{ optional($patient->user)->email }}" placeholder="Enter email address" />

<label>password</label>
<x-form.input type="password" name="password" value="{{ optional($patient->user)->password }}" placeholder="Enter password" />

<label>Gender</label>
<x-form.radio name="gender" selected="{{ optional($patient->user)->gender }}" />

<label>Profile Image</label>
<x-form.input type="file" name="image" value="{{ optional($patient->user)->image }}" placeholder="Enter Image" />

<label>Date Of Birth</label>
<x-form.input type="date" name="date_of_birth" value="{{ optional($patient->user)->date_of_birth }}"
    placeholder="Enter birthday" />

<label>Phone Number</label>
<x-form.input name="phone" value="{{ optional($patient->user)->phone }}" placeholder="Enter phone number" />

<label>Doctor</label>
<x-form.select name="doctor_id" user="patient" :items="$doctors" />

<label>City</label>
<x-form.input name="city" value="{{ optional($patient)->city }}" placeholder="Enter city" />

<label>Street</label>
<x-form.input name="street" value="{{ optional($patient)->street }}" placeholder="Enter street" />

<x-form.blood-type patient={{ $patient }}/>

<label>National ID</label>
<x-form.input name="national_id" value="{{ optional($patient)->national_id }}" placeholder="Enter national ID" />

<label>Description of Condition</label>
<x-form.textarea name="description_of_condition" value="{{ optional($patient)->description_of_condition }}"
    placeholder="Enter description of condition" />

<label>Room Number</label>
<x-form.input name="room_number" value="{{ optional($patient)->room_number }}" />


<label>Entry Date</label>
<x-form.input type="date" name="entry_date" value="{{ optional($patient)->entry_date }}" placeholder="Enter entry date" />

<button type="submit" class="btn btn-primary">Save</button>
