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
  <div class="card-header">Tambah Penerbit</div>

        <div class="card-body">
            <form method="POST" action="">
                @csrf

                <div class="form-group row">
                    <label for="penerbitbaru" class="col-md-4 col-form-label text-md-right">Penerbit Baru</label>

                    <div class="col-md-6">
                        <input id="penerbitbaru" type="text" class="form-control{{ $errors->has('penerbitbaru') ? ' is-invalid' : '' }}" name="penerbitbaru" value="{{ old('penerbitbaru') }}" required autofocus>

                        @if ($errors->has('penerbitbaru'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('penerbitbaru') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="form-group row mb-0">
                  <div class="col-md-5 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                      Tambah Penerbit
                    </button>
                  </div>
                </div>
            </form>
          Semua Penerbit yang sudah ada <br>
          @foreach ($kumpulanPenerbit as $penerbit)
            {{$penerbit->namaPenerbit}} <br>
          @endforeach
        </div>
    </div>
  </div>
</div>
@endsection
