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
    <div class="row">
        <div class="col-6">
            <h3>Tambah Aturan Denda</h3>
            <form action="{{ route('tambahAturanDenda') }}">
                Hari Ke: <input type="number" name="hariKe" style="margin-right:20px;">
                <!-- <br> -->
                Nominal Denda: <input type="number" name="nominalDenda">
                <br><br>
                <input type="submit" value="Add">
            </form> 
        </div>
        <br><br>
        <div class="col-6">
            <h3>Update Aturan Denda</h3>
            <form action="{{ route('updateAturanDenda') }}">
                Hari Ke: <input type="number" name="hariKe" style="margin-right:20px;">
                <!-- <br> -->
                Nominal Denda: <input type="number" name="nominalDenda">
                <br><br>
                <input type="submit" value="Update">
            </form> 
        </div>
    </div>

    <br>

    <div class="container">
        <h5>Aturan-Aturan Denda</h5>

        <div class="container">
            <table class="table table-condensed">
            <thead>
            <tr>
                <th>Hari Ke</th>
                <th>Nominal Denda</th>
            </tr>
            </thead>
            <tbody>
            @foreach($result as $res)
                <tr>
                <td>{{$res['hariKe']}}</td>
                <td>{{$res['nominalDenda']}}</td>
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
