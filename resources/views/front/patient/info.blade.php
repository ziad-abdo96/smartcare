<x-front-layouts>
    <div class="container mt-4 mb-5 p-5">
        <div class="card shadow rounded-4">
            <div class="card-header bg-primary text-white text-center rounded-top-4">
                <h2>Patient Profile</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset($patient->user->image) }}" class="rounded-circle img-fluid" alt="Patient Photo">
                    </div>
                    <div class="col-md-8">
    
                        <!-- Personal Information -->
                        <h4 class="mb-3 text-primary">Personal Information</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Name:</th>
                                <td>{{ $patient->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $patient->user->email }}</td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td>{{ $patient->user->gender }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth:</th>
                                <td>{{ $patient->user->date_of_birth }}</td>
                            </tr>
                        </table>
    
                        <!-- Contact Information -->
                        <h4 class="mb-3 text-primary">Contact Information</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Phone:</th>
                                <td>{{ $patient->user->phone }}</td>
                            </tr>
                            <tr>
                                <th>City:</th>
                                <td>{{ $patient->city }}</td>
                            </tr>
                            <tr>
                                <th>Street:</th>
                                <td>{{ $patient->street }}</td>
                            </tr>
                        </table>
    
                        <!-- Medical Information -->
                        <h4 class="mb-3 text-primary">Medical Information</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Doctor Name:</th>
                                <td>{{ $patient->doctor->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Entry Date:</th>
                                <td>{{ $patient->entry_date }}</td>
                            </tr>
                            <tr>
                                <th>Blood Type:</th>
                                <td>{{ $patient->blood_type }}</td>
                            </tr>
                            <tr>
                                <th>Description of Condition:</th>
                                <td>{{ $patient->description_of_condition }}</td>
                            </tr>
                            <tr>
                                <th>Room Number:</th>
                                <td>{{ $patient->room_number }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layouts>