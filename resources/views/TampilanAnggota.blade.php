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
          <tr>
            <td>1</td>
            <td>Cooler Ujang</td>
            <td>Aktif</td>
            <td>12-12-19</td>
            <td>Tidak Pernah</td>
            <td>Ya</td>
          </tr>
          @foreach($result as $res)
            <td>{{$res['id']}}</td>
            <td>{{$res['name']}}</td>
            @if($res['statusAktif']==1){
              <td>Aktif</td>
            }
            @else{
              <td>Tidak Aktif</td>
            }
            @endif
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
