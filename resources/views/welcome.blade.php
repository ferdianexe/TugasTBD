<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

        <!-- Styles -->
        <link href="{{ asset('css/tbd.css') }}" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <!-- https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css -->

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            
        </style>
    </head>
    <body>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        {{Auth::getUser()->name}}({{Auth::getUser()->username}})
                        <a href="{{ url('/home') }}">Home</a>
                        <a href="{{ url('/logout') }}">Logout</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif       
            
            <br>
            <div class="content" style= "width:100%">
                <div class = "halfBackground">
                    <br>
                    <form method="GET" action="{{ route('searchBook') }}">
                        <div class="container h-100">
                            <div class="d-flex justify-content-center h-100">
                                <div class="searchbar">
                                    <input class="search_input" type="text" name="search" placeholder="Search...">
                                    <!-- <a href="{{ route('searchBook') }}" class="search_icon"><i class="fas fa-search"></i></a> -->
                                    <button type="submit" class="btn btn-default">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <br>

                    <div class="row container-fluid">
                        <div class="row align-items-center justify-content-center" style= "width:100%;">
                                <div class="col-sm-4">
                                    <div class="form-group ">
                                        <select id="inputState " class="form-control">
                                            <option selected>Brand</option>
                                            <option>BMW</option>
                                            <option>Audi</option>
                                            <option>Maruti</option>
                                            <option>Tesla</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <br>
                </div>
                <br>
    
                <div class="container">
                    <h2>Kumpulan Buku Buku Baru</h2>

                    <div class="card-columns">
                        <div class="card bg-primary">
                            <div class="card-body text-center">
                                <p class="card-text">Some text inside the first card</p>
                            </div>
                        </div>
                        <div class="card bg-warning">
                            <div class="card-body text-center">
                                <p class="card-text">Some text inside the second card</p>
                            </div>
                        </div>
                        <div class="card bg-success">
                            <div class="card-body text-center">
                                <p class="card-text">Some text inside the third card</p>
                            </div>
                        </div>
                        <div class="card bg-danger">
                            <div class="card-body text-center">
                                <p class="card-text">Some text inside the fourth card</p>
                            </div>
                        </div>  
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <p class="card-text">Some text inside the fifth card</p>
                            </div>
                        </div>
                        <div class="card bg-info">
                            <div class="card-body text-center">
                                <p class="card-text">Some text inside the sixth card</p>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-primary active">Tampilkan Lebih Banyak</button>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-primary active">Pinjamanku</button>
                    </div>
                    <div class="col-sm-3"></div>
                </div>

                <br>

                <div class="jumbotron" class="haflBackground">
                    <div class="container for-about">
                        <h1>Info</h1>
                    </div>
                </div>

                <div class = "halfBackground">
                    <!-- <img class = "halfBackground"> -->
                </div>
            </div>
        </div>
    </body>
    
</html>
