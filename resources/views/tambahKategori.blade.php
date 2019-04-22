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
  <div class="card">
    <div class="card-header">Tambah Kategori</div>
      <div class="card-body">
          <form method="POST" action="">
              @csrf

              <div class="form-group row">
                  <label for="kategoriBaru" class="col-md-4 col-form-label text-md-right">Kategori Baru</label>

                  <div class="col-md-6">
                      <input id="kategoriBaru" type="text" class="form-control{{ $errors->has('kategoriBaru') ? ' is-invalid' : '' }}" name="kategoriBaru" value="{{ old('kategoriBaru') }}" required autofocus>

                      @if ($errors->has('kategoriBaru'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('kategoriBaru') }}</strong>
                      </span>
                      @endif
                  </div>
              </div>
              <br>
              <div class="form-group row mb-0">
                <div class="col-md-5 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Tambah Kategori
                  </button>
                </div>
              </div>
          </form>
          Semua Kategori yang sudah ada <br>
          @foreach ($kumpulanKategori as $kategori)
            {{$kategori->kategori}} <br>
          @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
