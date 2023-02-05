@extends('backend.app')
@section('tittle', 'Users Create')
@section('content')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Admin Panel</h1>
        </div>
        <h2>Users Add</h2>



            <form method="POST" action="{{url("/users")}}">
                @csrf
                <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label >Name Surname</label>
                        <input type="text" class="form-control" name="name" placeholder="name@example.com">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label >E-mail</label>
                        <input type="email" class="form-control"  name="email" placeholder="name@example.com" value="{{old("email")}}">
                        @error("email")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label >Password</label>
                            <input type="password" class="form-control" name="password" ">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Repeat Password</label>
                            <input type="password" class="form-control" name="password2" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label >Permission</label>
                            <select name="is_admin">
                                <option value="0">Users</option>
                                <option value="1">Admin</option>
                            </select>
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

