@extends('backend.app')
@section('tittle', 'Users Password Change')
@section('content')



        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin Panel</h1>
            </div>
            <h2>Users Password Change</h2>



            <form method="POST" action="{{url("/users/$user->id/change-password")}}">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label >Password</label>
                            <input type="password" class="form-control" name="password" value="{{$user->password}}"">
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

