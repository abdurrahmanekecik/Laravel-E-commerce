@extends('backend.app')
@section('tittle', 'Address İndex')
@section('content')


        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin Panel</h1>
            </div>
            <h2>Address</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ url("users/$user->id/address/create") }}" class="btn btn-sm btn-outline-danger">New Adds</a>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">İd</th>
                        <th scope="col">City</th>
                        <th scope="col">District</th>
                        <th scope="col">Zipcode</th>
                        <th scope="col">Address</th>
                        <th scope="col">Process</th>
                    </tr>
                    </thead>
                    <tbody>


                    @if(count($addrs)>0)
                    @foreach($addrs as $addr)


                    <tr>
                        <td>{{ $addr->id; }}</td>
                        <td>{{ $addr->city; }}</td>
                        <td>{{ $addr->district; }}</td>
                        <td>{{ $addr->zipcode; }}</td>
                        <td>{{ $addr->Address; }}</td>
                        <td>@if ($addr->is_default=1)
                                <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-danger">Passive</span>
                            @endif

                        </td>
                        <td>


                            <ul class="nav float-start">

                                <li class="nav-item">
                                    <a href="{{ url("users/$user->id/address/$addr->id/edit") }}">
                                        <button class="btn btn-warning">Edit</button>
                                    </a>

                                </li>
                                <li class="nav-item">
                                   <form method="POST" action="{{ url("users/$user->id/address/$addr->id/destroy") }}">
                                       @method('DELETE')
                                       @csrf
                                       <button class="btn btn-danger" type="submit">Delete</button>
                                    </a></form>

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

