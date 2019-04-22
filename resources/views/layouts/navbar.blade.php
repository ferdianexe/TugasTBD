<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Perpustakaan Online</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/tbd.css') }}" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
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
            <h4>{{ Request::is('tambaheksemplar') ? 'Tambah Eksemplar' : '' }}
                {{ Request::is('tambahbuku') ? 'Tambah Buku' : '' }}
                {{ Request::is('TampilanDetailBuku') ? 'Detail Buku' : '' }}
                @if (Request::is('TampilanDataPeminjaman'))
                    @if($isAdmin)
                        Laporan
                    @else
                        Pinjamanku
                    @endif
                @endif
            </h4>
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
        <body>
            
        <body>
        @yield('content')
        </body>

</html>
