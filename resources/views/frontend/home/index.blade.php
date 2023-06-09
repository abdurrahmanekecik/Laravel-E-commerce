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
            <h5>Categories</h5>
            <div class="list-group">
                <a href="/"  class="list-group-item list-group-item-action">All</a>
                @if(count($categories)>0)
                    @foreach($categories as $category)
                        <a class="list-group-item list-group-item-action" href="{{url("category/")}}/{{$category->slug}}">{{$category->name}}</a>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-sm-9 pt-4">
            <h5>Products</h5>
            <ul>
                @if(count($products)>0)
                    <div class="card-group">
                        @foreach($products as $product)
                            <div class="card" style="width: 18rem;">
                                @if( isset($product->images[0]))

                                    <img src="{{asset("data/".$product->images[0]->url)}}"
                                         class="card-img-top" alt="{{$product->images[0]->alt}}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{$product->name}}</h5>
                                    <h6 class="card-title">Price: {{$product->price}}TL</h6>
                                    <p class="card-text">{{$product->lead}}</p>
                                    <a href="/addtocart/add/{{$product->product_id}}" class="btn btn-primary">Add to Cart</a>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
            </ul>
        </div>
    </div>
</div>
</body>
<script src="{{asset("assets/js/app.js")}}"></script>
</html>

