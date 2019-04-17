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
                /* Ini tambahan Intan */
                padding-bottom : 0px;
                margin-bottom : 0px;
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
                /* Ini tambahan Intan */
                padding-bottom : 0px;
                margin-bottom : 0px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .top-middle{
                padding-bottom : 0px;
                margin-bottom : 0px;
            }

            .top-left{
                position: absolute;
                left: 10px;
                top: 20px;
            }

            h4{
                padding-top: 30px;
                /* Ini tambahan Intan */
                padding-bottom : 0px;
                margin-bottom : 0px;
            }
            
            .halfBackground{
                /* background-image:url({{url('/images/imageHome.jpg')}}); */
                /* background: url("{{URL::asset('/images/imageHome.jpg')}}");
                background-repeat: no-repeat;
                background-size: 50% 100%; */
                background-image: url("../images/imageHome.jpg");
                background-size: 100% 300px;
                height :300px;
                background-position: center;
                background-repeat: no-repeat;
                margin-top: -15px;
            }

            h5{
                float:left;
                padding-bottom : 20px;
            }
            
        </style>
    </head>
    <body>
        <div class="flex-left position-ref">
                @if (Route::has('login'))
                    <div class="top-left links">
                        <a href="{{ url('/')}}">Beranda</a>
                    </div>
                @endif       
        </div>   
        <div class="flex-center position-ref">
            @if (Route::has('login'))
                <div class="flex-left top-left links">
                    <a href="{{ url('/')}}">Beranda</a>
                </div>
                <div class="top-middle">
                <a><h4>Pinjamanku</h4></a>
                </div>
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
            </div>    
            <br>
            <div class="content" style= "width:100%">
                <div class = "halfBackground">
                    <br>
                    <!-- <div class="container h-100">
                        <div class="d-flex justify-content-center h-100">
                            <div class="searchbar">
                                <input class="search_input" type="text" name="" placeholder="Search...">
                                <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                     -->
                    <br>

                    <!-- <div class="row container-fluid">
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
                    </div>-->
                    <br>
                </div>
                <br>
    
                <div class="container">
                    <h5>Buku-Buku yang Dipinjam</h5>

                    <div class="container">
                        <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <th>    </th>
                                    <th>Judul Buku</th>
                                    <th>Exemplar</th>
                                    <th>Status</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Denda</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Judul</td>
                                    <td>1</td>
                                    <td>Sedang dipinjam</td>
                                    <td>12-12-19</td>
                                    <td>22-12-19</td>
                                </tr>
                                <!-- <tr>
                                    
                                </tr> -->
                                </tbody>
                         </table>
                         <hr>
                    </div>
                </div>

                <br>
               
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"><a>Total Denda : </a></div>
                    <div class="col-sm-1"><a id="totalDenda" name="denda">0</a></div>
                    <div class="col-sm-1"></div>
                </div>

                <br>

                <div class="jumbotron" class="haflBackground">
                    <div class="container for-about">
                        <h1>Info</h1>
                    </div>
                </div>

            </div>
        
    </body>
    
</html>
