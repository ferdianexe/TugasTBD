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
@endsection