@extends('layouts.navbar')
@section('content')
<br>
<div class="content" style= "width:100%">
  <div class = "halfBackgroundPeminjaman">
      <br>
      <br>
      <br>
  </div>
  <br>

  <div class="container">
    <div class="row">
      @if($isAdmin)
        <div class="col-sm-1"></div>
        <div class="col-sm-2">
          <a type="button" href="{{route('pinjamanBuku')}}" class="btn btn-primary active">Semua</a>
        </div>
        <div class="col-sm-2">
          <a type="button" href="{{route('tagTerfavorit')}}" class="btn btn-primary active">Tag Favorit</a>
        </div>
        <div class="col-sm-2">
        <a type="button" href="{{ route('pemesananBuku') }}" class="btn btn-primary active">Request</a>
        </div>
        <div class="col-sm-3">
          <a type="button" href="{{route('bukuTerfavorit')}}"class="btn btn-primary active">Buku Favorit</a>
        </div>
        <div class="col-sm-2">
          <a type="button" href="{{route('seluruhanggota')}}"class="btn btn-primary active">Daftar Anggota</a>
        </div>
      @endif
    </div>
      <h5>
        Kategori Favorite
      </h5>

      <div class="container">
        <table class="table table-condensed">
          <thead>
          <tr>
            <th>    </th>
            <th>Nama Kategori</th>
            <th>Total</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($kumpulanKategori as $index=>$kategori)
          <tr>
            <td>{{$index+1}} </td>
            <td>{{$kategori->Kategori}}</td>
            <td>{{$kategori->total}}</td>
           
          </tr>
          @endforeach
          <!-- <tr>
              
          </tr> -->
          </tbody>
        </table>
        <hr>
      </div>
  </div>
</div>
@endsection
