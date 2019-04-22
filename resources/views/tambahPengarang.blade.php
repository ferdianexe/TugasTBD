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
  <div class="card-header">Tambah Pengarang</div>

        <div class="card-body">
            <form method="POST" action="">
                @csrf

                <div class="form-group row">
                    <label for="pengarangbaru" class="col-md-4 col-form-label text-md-right">Pengarang Baru</label>

                    <div class="col-md-6">
                        <input id="pengarangbaru" type="text" class="form-control{{ $errors->has('pengarangbaru') ? ' is-invalid' : '' }}" name="pengarangbaru" value="{{ old('pengarangbaru') }}" required autofocus>

                        @if ($errors->has('pengarangbaru'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('pengarangbaru') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="form-group row mb-0">
                  <div class="col-md-5 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                      Tambah Pengarang
                    </button>
                  </div>
                </div>
            </form>
          Semua Pengarang yang sudah ada <br>
          @foreach ($kumpulanPengarang as $pengarang)
            {{$pengarang->namaPengarang}} <br>
          @endforeach
        </div>
    </div>
  </div>
</div>
@endsection
