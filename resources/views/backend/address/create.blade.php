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
                        <label >City</label>
                        <input type="text" class="form-control" name="city" placeholder="City">
                        @error("city")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label >District</label>
                        <input type="text" class="form-control"  name="district" placeholder="District" value="{{old("district")}}">
                        @error("district")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label >Zipcode</label>
                            <input type="text" class="form-control" name="zipcode">
                            @error("zipcode")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                       </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="checkbox" class="form-check-input" name="is_default">
                            <label >Default</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label>Address</label>
                            <textarea  class="form-control" name="address" cols="20" rows="5">Address</textarea>
                            @error("address")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
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

