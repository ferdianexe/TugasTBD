<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

     <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/tbd.css') }}" rel="stylesheet">

    <!-- Bootstrap,CSS,JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
<body background="../images/library2.jpg">

    <nav class="navbar navbar-inverse" style="margin-bottom:0;">
        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="{{ url('/home') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-center" style="margin-left:35%">
                <li><H3 style="color:white" style="text-align:center;">Rak Buku Hasil Pencarian</H3></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{url('/logout')}}"><span class="glyphicon glyphicon-log-in"></span> Sign Out</a></li>
            </ul>

        </div>
    </nav>

    <div class="row">
        <div class="col-sm-3"></div>

        <div class="col-sm-6">
            <H3 style="color:aqua;">Yang dicari= {{$search}} {{$filter}}</H3>
            <div class="container" style ="width:100%;">
                <br>
                <form method="GET" action="{{ route('searchBook') }}">
                    <div class="container h-100" style ="width:100%;">
                        <div class="d-flex justify-content-center h-100">
                            <div class="searchbar">
                                <input class="search_input" type="text" name="search" placeholder="Search...">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                
                
                    <br>

                    <div class="row container-fluid">
                        <div class="row align-items-center justify-content-center" style= "width:100%;">
                                <div class="form-group ">
                                    <select id="inputState " class="form-control" name="filter">
                                        <option class="hint" selected value="0" disabled="disabled">(Genre)</option>
                                        <option value="1">Technology</option>
                                        <option value="2">Economy</option>
                                        <option value="3">Art</option>
                                        <option value="4">Math</option>
                                        <option value="5">Science</option>
                                        <option value="6">Nature</option>
                                        <option value="7">Physcology</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="container-fluid" style="background-color:orange;opacity:0.9">
                <div class="container-fluid" style="opacity:1;">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>John</td>
                            <td>Doe</td>
                            <td>john@example.com</td>
                        </tr>
                        <tr>
                            <td>Mary</td>
                            <td>Moe</td>
                            <td>mary@example.com</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-primary active">Prev</button>
                    </div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-primary active">Next</button>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div><br><br>

            
            <div class="background">
                <div class="transbox">
                    <p>This is some text that is placed in the transparent box.</p>
                </div>
            </div>

        </div>

        <div class="col-sm-3" style="background-color:orange;opacity:0.9">
            <H3>Keranjang BukuKu</H3>
            <div class="row" height="50%">
                <div class="container-fluid" style="background-color:white;opacity:1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Buku</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Test</td>
                                <td>ready</td>
                            </tr>
                            <tr>
                                <td>Test2</td>
                                <td>ready</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button type="button" class="btn btn-primary active" width="90%" style="margin-left:60%">Pinjam Buku</button>
            </div><br><br>

            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-8">
                    <button type="button" class="btn btn-primary active" width="90%">Pinjamanku</button>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
</body>
</html>