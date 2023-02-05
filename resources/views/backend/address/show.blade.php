@extends('backend.app')
@section('tittle', 'Users Create')
@section('content')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Admin Panel</h1>
        </div>
        <h2>Users</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-outline-danger">New Add</a>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">İd</th>
                    <th scope="col">Name Surname</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Status</th>
                    <th scope="col">Process</th>
                </tr>
                </thead>
                <tbody>



@endsection
@section('js')
@endsection
@section('css')
@endsection

