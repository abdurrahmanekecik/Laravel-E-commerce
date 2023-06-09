@extends('backend.app')
@section('tittle', 'Address İndex')
@section('content')


        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin Panel</h1>
            </div>
            <h2>Photos</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ url("products/$product->product_id/images/create") }}" class="btn btn-sm btn-outline-danger">New Add</a>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">İd</th>
                        <th scope="col">İmage</th>
                        <th scope="col">Alt</th>
                        <th scope="col">Sequence No</th>
                        <th scope="col">Status</th>
                        <th scope="col">Process</th>
                    </tr>
                    </thead>
                    <tbody>


                    @if(count($images)>0)
                    @foreach($images as $image)


                    <tr>
                        <td>{{ $image->id }}</td>
                        <td><img src="{{ $image->url }}" style="width: 150px; height: 150px; "> </td>
                        <td>{{ $image->alt }}</td>
                        <td>{{ $image->seq }}</td>
                        <td>@if ($image->status=1)
                                <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-danger">Passive</span>
                            @endif
                        </td>
                        <td>
                            <ul class="nav float-start">
                                <li class="nav-item">
                                    <a href="{{ url("products/$product->product_id/images/$image->image_id/edit") }}">
                                        <button class="btn btn-warning">Edit</button>
                                    </a>

                                </li>
                                <li class="nav-item">
                                   <form method="POST" action="{{ url("products/$product->product_id/images/$image->image_id/destroy") }}">
                                       @method('DELETE')
                                       @csrf
                                       <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>

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


@endsection


