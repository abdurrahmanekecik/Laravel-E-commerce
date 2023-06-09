<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Laravel E-commerce">
    <meta name="author" content="Abdurrahman Ekecik">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Laravel E-commerce</title>
    <link rel="stylesheet" href="{{asset("assets/css/app.css")}}">
    @yield("css")
    <meta name="theme-color" content="#712cf9">
</head>
<body>


<div class="container">

    <div class="row">
        <div class="row">
            <div class="col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="/">E-Commerce</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                                </li>
                                @auth()
                                    <li class="nav-item">
                                        <a class="nav-link" href="/addtocart">Cart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/logout">Logout</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="/login">Log-in</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/register">Register</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-3 pt-4">
            <h5>Account</h5>
            <div class="list-group">
                <a href="/" class="list-group-item list-group-item-action">Cart</a>
            </div>
        </div>
        <div class="col-sm-9 pt-4">
            <h5>Cart</h5>
            @if(count($cart->details) > 0)
                <table class="table">
                    <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Process</th>
                    </thead>
                    <tbody>
                   -
                    @foreach($cart->details as $detail)

                        @foreach($products as $product)

                            @if($product->product_id == $detail->product_id)

                        <tr>
                            <td>
                                @if(isset($product->images[0]))
                                <img src="{{asset("/data/products/".$product->images[0]->url)}}"
                                     alt="{{$product->images[0]->alt}}" width="100">
                                @endif
                            </td>

                            <td>{{ $product->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <a href="/addtocart/remove/{{$detail->cart_detail_id}}">Cart Remove</a>
                            </td>
                        </tr>
                            @endif
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
                <a href="/checkout" class="btn btn-success float-end">Buy Now</a>
            @else
                <p class="text-danger text-center">Not Found.</p>
            @endif
        </div>
    </div>
</div>
</body>
<script src="{{asset("assets/js/app.js")}}"></script>
</html>
