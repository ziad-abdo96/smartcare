<label>Name</label>
<x-form.input name="name" value="{{ optional($department)->name }}" placeholder="Enter Full Name" />


<label>Description</label>
<x-form.input name="description" value="{{ optional($department)->description }}" placeholder="Description" />


<button type="submit" class="btn btn-primary">Save</button>
