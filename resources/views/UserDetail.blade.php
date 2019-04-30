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
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-1"></div>
    <h5 class="col-sm-7">
    </h5>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label class="col-sm-2 col-form-label tulisanKekiri">Nama Anggota</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">{{$user[0]->name}}</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label class="col-sm-2 col-form-label tulisanKekiri">Tanggal Lahir</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri" placeholder="Masukkan Kategori Buku">{{$user[0]->tglLahir}}</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label class="col-sm-2 col-form-label tulisanKekiri">Tanggal Bergabung</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">{{$user[0]->tglGabung}}</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label class="col-sm-2 col-form-label tulisanKekiri">Alamat</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">{{$user[0]->alamat}}</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label class="col-sm-2 col-form-label tulisanKekiri">Email</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">{{$user[0]->email}}</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label class="col-sm-2 col-form-label tulisanKekiri">Username</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">{{$user[0]->username}}</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label class="col-sm-2 col-form-label tulisanKekiri">Kategori Favorit</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">
        @foreach($tagFavorit as $tag)
        {{$tag->Kategori}}({{$tag->total}}),
        @endforeach
      </label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <br>
  <div class="form-group row">
    <div class="col-sm-5">
    </div>
    <button class="btn btn-primary col-sm-2">Back</button>
    <div class="col-sm-5">
    </div>
  </div>
  <br><br>
  </div>
  
@endsection

