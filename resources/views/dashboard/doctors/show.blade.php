@extends('layouts.master')

@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('page-header')
    <!-- Page header content -->
@endsection

@section('content')
    <!-- row -->
    <a class="btn btn btn-outline-primary my-3" href="{{ route('dashboard.doctors.create') }}">Create New Doctor</a>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-md-nowrap" id="example1">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="wd-15p">Image</th>
                                    <th class="wd-15p">Full Name</th>
                                    <th class="wd-15p">Specialty</th>
                                    <th class="wd-15p">department</th>
                                    <th class="wd-20p">Phone</th>
                                    <th class="wd-15p">Date of Birth</th>
                                    <th class="wd-25p">E-mail</th>
                                    <th class="wd-15p">Gender</th>
                                    <th class="wd-25p">About</th>
                                    <th class="wd-25p">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>
                                            @if($doctor->user->image)
                                                <img src="{{ asset($doctor->user->image) }}" alt="Doctor Image" class="img-thumbnail" style="width: 60px; height: 60px;">
                                            @else
                                                <img src="{{ asset('assets/img/default-avatar.png') }}" alt="Default Image" class="img-thumbnail" style="width: 60px; height: 60px;">
                                            @endif
                                        </td>
                                        <td>{{ $doctor->user->name }}</td>
                                        <td>{{ $doctor->specialty }}</td>
                                        <td>{{ $doctor->department_id }}</td>
                                        <td>{{ $doctor->user->phone }}</td>
                                        <td>{{ $doctor->user->date_of_birth }}</td>
                                        <td>{{ $doctor->user->email }}</td>
                                        <td>{{ $doctor->user->gender }}</td>
                                        <td>{{ $doctor->about }}</td>
                                        <td class="d-flex">
                                            <!-- Details -->
                                            <a href="{{ route('dashboard.doctors.show', $doctor->id) }}" class="btn btn-info btn-sm mr-2">
                                                <i class="fas fa-eye"></i> Details
                                            </a>

                                            <!-- Update Button -->
                                            <a href="{{ route('dashboard.doctors.edit', $doctor->id) }}" class="btn btn-warning btn-sm mr-2">
                                                <i class="fas fa-edit"></i> Update
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('dashboard.doctors.destroy', $doctor->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this doctor?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- row closed -->
@endsection

@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Internal Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
@endsection
