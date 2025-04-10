@extends('layouts.master')

@section('page-header')
    <div class="page-header text-center py-5 bg-info text-white">
        <h1 class="page-title display-4 font-weight-bold">Patient Information</h1>
    </div>
@endsection

@section('content')
    <div class="container mt-5">
        <!-- Patient Details Card -->
        <div class="card shadow-lg border-0 rounded-lg mb-4">
            <div class="card-body p-5">
                <div class="d-flex justify-content-center mb-4">
                    @if($patient->user->image)
                        <img src="{{ asset($patient->user->image) }}" class="img-fluid rounded-circle shadow-lg" alt="Profile Image" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="profile-placeholder d-flex justify-content-center align-items-center bg-light rounded-circle shadow-lg" style="width: 150px; height: 150px;">
                            <span class="text-muted font-weight-bold">No Image</span>
                        </div>
                    @endif
                </div>

                <h4 class="font-weight-bold mb-4 text-center">Patient Personal Information</h4>

                <!-- Personal Info Table -->
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td><strong class="text-primary">Full Name:</strong></td>
                            <td>{{ $patient->user->name }}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Email Address:</strong></td>
                            <td>{{ $patient->user->email }}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Gender:</strong></td>
                            <td>{{ ucfirst($patient->user->gender) }}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Date of Birth:</strong></td>
                            <td>{{ $patient->user->date_of_birth }}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Phone Number:</strong></td>
                            <td>{{ $patient->user->phone }}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Blood Type:</strong></td>
                            <td>{{ $patient->blood_type }}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Assigned Doctor:</strong></td>
                            <td>{{ $patient->doctor ? $patient->doctor->user->name : 'No doctor assigned' }}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Health Condition:</strong></td>
                            <td>{{ $patient->description_of_condition }}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">City:</strong></td>
                            <td>{{ $patient->city }}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Street:</strong></td>
                            <td>{{ $patient->street }}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Room Number:</strong></td>
                            <td>{{ $patient->room_number }}</td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Entry Date:</strong></td>
                            <td>{{ $patient->entry_date }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-body p-5 text-center">
                <a href="{{ route('dashboard.patients.edit', $patient->id) }}" class="btn btn-primary btn-lg mb-3 w-100">
                    <i class="fas fa-edit"></i> Edit Patient
                </a>
                <form action="{{ route('dashboard.patients.destroy', $patient->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg w-100" onclick="return confirm('Are you sure you want to delete this patient?')">
                        <i class="fas fa-trash"></i> Delete Patient
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
