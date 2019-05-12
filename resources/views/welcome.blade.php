@extends('layouts.navbar')
@section('content')
<br>
<div class="content" style= "width:100%">
  <div class = "halfBackground">
  <br>
    <form method="GET" action="{{ route('searchBook') }}">
      <div class="container h-100">
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
          <div class="col-sm-4">
            <div class="form-group ">
              <select id="inputState " data-live-search="true" class="selectpicker form-control" name="filter">
                <option class="hint" selected value="0" disabled="disabled">(Genre)</option>
                @foreach($kumpulanKategori as $kategori)
                  <option value="{{$kategori->idKategori}}" data-tokens='{{$kategori->kategori}}'>{{$kategori->kategori}} </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
     </form>
    </div>
    <br>
    <div class="container">
        <h2>Kumpulan Buku Buku Baru</h2>
        
        <div class="card-columns">
        @foreach ($kumpulanBukuRekomendasi as $buku)
             <a href="{{ url('TampilanDetailBuku/'.$buku->idBuku)}}" class="card bg-recommend">
                <div class="card-body text-center">
                    <p class="card-text">{{$buku->nama}}</p>
                </div>
            </a>
            @endforeach
            @foreach ($kumpulanBuku as $buku)
             <a href="{{ url('TampilanDetailBuku/'.$buku->idBuku)}}" class="card bg-light">
                <div class="card-body text-center">
                    <p class="card-text">{{$buku->nama}}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>

  <br>

  <div class="row">
      @if($isAdmin)
        <div class="col-sm-3">
          <a type="button" href= "{{ route('searchBook') }}" class="btn btn-primary active">Tampilkan Lebih Banyak</a>
        </div>
        <div class="col-sm-2">
          <a type="button" href="{{ route('tambahBuku') }}" class="btn btn-primary active">Tambah Buku</a>
        </div>
        <div class="col-sm-2">
          <a type="button" href="{{ route('tambahEksemplar') }}" class="btn btn-primary active">Tambah Eksemplar</a>
        </div>
        <div class="col-sm-2">
          <a type="button" href="{{ route('pinjamanBuku') }}"class="btn btn-primary active">Laporan</a>
        </div>
        <div class="col-sm-2">
          <a type="button" href="{{ route('showAturanDenda') }}"class="btn btn-primary active">Aturan Denda</a>
        </div>
      @else
        <div class="col-sm-3"></div>
        <div class="col-sm-3">
        <a type="button" href= "{{ route('searchBook') }}" class="btn btn-primary active">Tampilkan Lebih Banyak</a>
        </div>
        <div class="col-sm-3">
          <a type="button" href="{{ route('pinjamanBuku') }}"class="btn btn-primary active">Pinjamanku</a>
        </div>
        <div class="col-sm-3">
          <a type="button" href="{{ route('showDendaKu') }}"class="btn btn-primary active">Dendaku</a>
        </div>
      @endif
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
