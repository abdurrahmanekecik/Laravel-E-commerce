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
<div class="container">
    <div class="row">
        <div class="col-4 offset-4">
            <main class="mt-5">
                <form method="POST" action="{{url("/checkout")}}">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal">Kredi Kartı Bilgileri</h1>

                    <div class="form-group mt-2">
                        <x-input label="Name Surname" placeholder="Cart Name Surname" field="name"/>
                    </div>

                    <div class="form-group mt-2">
                        <x-input label="Cart No" placeholder="Enter your 16 digit card number" field="cart_no"/>
                    </div>

                    <div class="form-group mt-2">
                        <x-input label="Month of End Use" placeholder="Enter the last month of use" field="expire_month"
                                 type="number"/>
                    </div>

                    <div class="form-group mt-2">
                        <x-input label="Year of Last Use" placeholder="Enter the last year of use" field="expire_year"
                                 type="number"/>
                    </div>

                    <div class="form-group mt-2">
                        <x-input label="Cvc" placeholder="Enter the cvc code" field="cvc" type="number"/>
                    </div>

                    <button class="w-100 btn btn-lg btn-success mt-4" type="submit">Satın Al</button>
                </form>
            </main>
        </div>
    </div>
</div>
</div>
</body>
<script src="{{asset("assets/js/app.js")}}"></script>
</html>


