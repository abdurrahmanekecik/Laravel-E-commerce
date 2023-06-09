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
                    Your pay transaction is successful.
                </main>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{asset("assets/js/app.js")}}"></script>
</html>

