@extends('backend.app')
@section('tittle', 'Users')
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
                    @if(count($users)>0)
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id; }}</td>
                        <td>{{ $user->name; }}</td>
                        <td>{{ $user->email; }}</td>
                        <td>{{ $user->status; }}</td>
                        <td>


                            <ul class="nav float-start">

                                <li class="nav-item">
                                    <a href="{{ route('users.edit',$user->id) }}">
                                        <button class="btn btn-warning">Edit</button>
                                    </a>

                                </li>
                                <li class="nav-item">
                                   <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                       @method('DELETE')
                                       @csrf
                                       <button class="btn btn-danger" type="submit">Delete</button>
                                    </a></form>

                                </li>
                                <li class="nav-item">
                                    <a href="{{url("/users/$user->id/change-password")}}" class="nav-link">
                                        <span>Password Change</span>
                                    </a>

                                </li>

                            </ul>

                        </td>


                    </tr>
                    @endforeach

                        @else  <tr>
                        <td colspan="5" class="text-center">Data Not Found</td>


                    </tr>

                    @endif
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>


@endsection
@section('js')
@endsection
@section('css')
@endsection

