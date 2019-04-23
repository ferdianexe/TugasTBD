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
      <h5>Seluruh Anggota</h5>

      <div class="container">
        <table class="table table-condensed">
          <thead>
          <tr>
            <th>Id</th>
            <th>Nama Anggota</th>
            <th>Status</th>
            <th>Terakhir Meminjam</th>
            <th>Terakhir Memesan</th>
            <th>Sedang Meminjam</th>
          </tr>
          </thead>
          <tbody>
          @foreach($result as $res)
            <tr>
              <td>{{$res['id']}}</td>
              <td>{{$res['name']}}</td>
              @if($res['statusAktif']==1){
                <td>Aktif</td>
              }
              @else{
                <td>Tidak Aktif</td>
              }
              @endif

              @if($res['terakhirMeminjam']==NULL)
                <td>Tidak Pernah</td>
              @else
                <td>{{$res['terakhirMeminjam']}}</td>
              @endif

              @if($res['terakhirMemesan']==NULL)
                <td>Tidak Pernah</td>
              @else
                <td>{{$res['terakhirMemesan']}}</td>
              @endif

              @if($res['hasReturned']==0)
                <td>Tidak</td>
              @else
                <td>Ya</td>
              @endif
            </tr>
          @endforeach
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
      <div class="col-sm-2"></div>
      <div class="col-sm-1"></div>
      <div class="col-sm-1"></div>
  </div>

  <br>

  <div class="jumbotron" class="haflBackground">
      <div class="container for-about">
          <h1>Info</h1>
      </div>
  </div>

</div>
@endsection
