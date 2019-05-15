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
        <h5>DendaKu</h5>

        <div class="container">
            <table class="table table-condensed">
            <thead>
            <tr>
                <th>Nama Buku</th>
                <th>Tanggal Meminjam</th>
                <th>Tanggal Jatuh Tempo</th>
                <th>Tanggal Dibalikan</th>
                <th>Total Denda</th>
            </tr>
            </thead>
            <tbody>
            @foreach($result as $res)
                <tr>
                    <td>{{$res['namaBuku']}}</td>
                    <td>{{$res['tanggalMeminjam']}}</td>
                    <td>{{$res['tglJatuhTempo']}}</td>
                    <td>{{$res['tanggalDibalikan']}}</td>
                    <td>{{$res['totalDenda']}}</td>
                </tr>
            @endforeach
            </tbody>
            </table>
            <hr>
        </div>
    </div>

    <br>

    <br>

    <div class="jumbotron" class="haflBackground">
        <div class="container for-about">
            <h1>Info</h1>
        </div>
    </div>

</div>
@endsection
