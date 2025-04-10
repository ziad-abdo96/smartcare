@extends('layouts.master')

@section('page-header')
    <h2 class="main-content-title tx-24">Welcome to SmartCare Dashboard</h2>
    <p class="mg-b-0">Monitor healthcare statistics and manage operations efficiently.</p>
@endsection

@section('content')
<div class="row">
    <!-- Stats Overview -->
    <div class="col-lg-3 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-user-md fa-2x text-primary"></i>
                <h5 class="card-title mt-2">Total Doctors</h5>
                <h3>{{ $doctorCount }}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-user-nurse fa-2x text-success"></i>
                <h5 class="card-title mt-2">Total Nurses</h5>
                <h3>{{ $nurseCount }}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-procedures fa-2x text-danger"></i>
                <h5 class="card-title mt-2">Total Patients</h5>
                <h3>{{ $patientCount }}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-pills fa-2x text-warning"></i>
                <h5 class="card-title mt-2">Total Treatments</h5>
                <h3>{{ $treatmentCount }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Recent Records -->
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-user-md"></i> Recent Doctors</h5>
                <ul class="list-group">
                    @foreach($recentDoctors as $doctor)
                        <li class="list-group-item">{{ $doctor->user->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-procedures"></i> Recent Patients</h5>
                <ul class="list-group">
                    @foreach($recentPatients as $patient)
                        <li class="list-group-item">{{ $patient->user->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Alerts & Quick Actions -->
<div class="row">
    <div class="col-lg-6">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-exclamation-triangle"></i> Alerts</h5>
                <p>⚠️ Pending Tasks: <strong>{{ $pendingTasks }}</strong></p>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="card-title"><i class="fas fa-bolt"></i> Quick Actions</h5>
                <a href="{{ route('dashboard.patients.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Patient
                </a>
                <a href="{{ route('dashboard.doctors.create') }}" class="btn btn-secondary">
                    <i class="fas fa-user-md"></i> Add Doctor
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
