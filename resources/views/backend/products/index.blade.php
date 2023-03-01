@extends('backend.app')
@section('tittle', 'Product İndex')
@section('content')


        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin Panel</h1>
            </div>
            <h2>Products</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ url("products/create") }}" class="btn btn-sm btn-outline-danger">New Adds</a>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Active</th>
                        <th scope="col">Process</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                    @if(count($products)>0)
                    @foreach($products as $product)

                                <td>{{ $product->name; }}</td>


                        @foreach($categories as $category)
                        @if($product->category_id == $category->category_id)
                        <td>{{ $category->name; }}</td>
                        @endif
                        @endforeach



                        <td>{{ $product->slug; }}</td>
                        <td>@if ($product->active=1)
                                <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-danger">Passive</span>
                            @endif

                        </td>
                        <td>


                            <ul class="nav float-start">

                                <li class="nav-item">
                                    <a href="{{ url("products/$product->product_id/edit") }}">
                                        <button class="btn btn-warning">Edit</button>
                                    </a>

                                </li>
                                <li class="nav-item">
                                   <form method="POST" action="{{ route('products.destroy', $product->product_id) }}">
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

