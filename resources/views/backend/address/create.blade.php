@extends('backend.app')
@section('tittle', 'Address Create')
@section('content')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Admin Panel</h1>
        </div>
        <h2>Users Add</h2>



        <form action="{{url("/users/$user->id/address")}}" method="POST" autocomplete="off" novalidate>
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                @error("user_id")
                <span class="text-danger">{{$message}}</span>
                @enderror

                <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <x-input label="City" placeholder="City Enter" field="city"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <x-input label="Disctrict" placeholder="Disctrict Enter" field="disctrict"/>
                </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <x-input label="Zipcode" placeholder="Zipcode Enter" field="zipcode"/>
                       </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <x-checkbox label="Default" field="is_dafault"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <x-textarea label="Address" field="address" placeholder="Address Enter" />


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

