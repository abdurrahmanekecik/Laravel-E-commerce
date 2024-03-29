

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Laravel E-commerce</title>

    <link rel="stylesheet" href="{{asset("build/assets/app.css")}}">
    @yield("css")
    <meta name="theme-color" content="#712cf9">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>

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

        <div class="row">
        <div class="col-sm-3 pt-4">
            <h5>Hesabım</h5>
            <div class="list-group">
                <a href="/" class="list-group-item list-group-item-action">Sepetim</a>
            </div>
        </div>
        <div class="col-sm-9 pt-4">
            <h5>Sepetim</h5>
            @if(count($cart->details) > 0)
                <table class="table">
                    <thead>
                    <th>Fotoğraf</th>
                    <th>Ürün</th>
                    <th>Adet</th>
                    <th>Fiyat</th>
                    <th>İşlemler</th>
                    </thead>
                    <tbody>
                    @foreach($cart->details as $detail)
                        <tr>
                            <td>
                                <img src="{{asset("/storage/products/".$detail->product->images[0]->image_url)}}"
                                     alt="{{$detail->product->images[0]->alt}}" width="100">
                            </td>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $detail->product->price }}</td>
                            <td>
                                <a href="/sepetim/sil/{{$detail->cart_detail_id}}">Sepetten Sil</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="/satin-al" class="btn btn-success float-end">Satın Al</a>
            @else
                <p class="text-danger text-center">Sepetinizde ürün bulunamadı.</p>
            @endif
        </div>
    </div>
</div>
</body>
</html>
