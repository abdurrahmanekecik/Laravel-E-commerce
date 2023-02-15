@extends('backend.app')
@section('tittle', 'Category Create')
@section('content')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Admin Panel</h1>
        </div>
        <h2>Category Add</h2>



        <form action="{{url("/categories")}}" method="POST" autocomplete="off" novalidate>
                @csrf

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <x-input label="Name" placeholder="Name Enter" field="name"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <x-input label="Slug" placeholder="Slug Enter" field="slug"/>
                </div>
                </div>
                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <x-checkbox label="Active" field="is_active"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success"> Save</button>

                        </div>
                    </div>
                </div>


            </form>






@endsection
@section('js')
@endsection
@section('css')
@endsection

