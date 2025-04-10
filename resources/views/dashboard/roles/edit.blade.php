@extends('layouts.master')

@section('css')
@endsection

@section('page-header')
    <div class="page-header">
        <div class="page-title">
            <h1></h1>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">create new a Role</h3>
                </div>
                <div class="card-body">

                    <form action="{{ route('dashboard.roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        @include('dashboard.roles._form')                      
                        </form>
                        <!-- End of Form -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')