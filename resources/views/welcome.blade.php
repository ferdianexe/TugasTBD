@extends('layouts.navbar')
@section('content')
<br>
<div class="content" style= "width:100%">
    <div class = "halfBackground">
        <br>
        <div class="container h-100">
            <div class="d-flex justify-content-center h-100">
                <div class="searchbar">
                    <input class="search_input" type="text" name="" placeholder="Search...">
                    <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
                </div>
            </div>
        </div>
        
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
            <a type="button" href="{{ route('pinjamanBuku') }}"class="btn btn-primary active">Pinjamanku</a>
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
@endsection
