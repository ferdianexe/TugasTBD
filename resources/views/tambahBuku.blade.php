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
                <div class="card-header">Tambah Buku</div>

        <div class="card-body">
            <form method="POST" action="{{ route('tambahbukuform') }}">
                @csrf

                <div class="form-group row">
                    <label for="judulBuku" class="col-md-4 col-form-label text-md-right">Judul Buku</label>

                    <div class="col-md-6">
                        <input id="judulBuku" type="text" class="form-control{{ $errors->has('judulBuku') ? ' is-invalid' : '' }}" name="judulBuku" value="{{ old('judulBuku') }}" required autofocus>

                        @if ($errors->has('judulBuku'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('judulBuku') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-md-4 col-form-label text-md-right">Kategori</label>

                    <div class="col-md-6">
                        <input id="text" type="text" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" name="category" value="{{ old('category') }}" required>
                        @if ($errors->has('category'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
                        @endif
                    </div>
                    <span class="col-md-2 info">
                        Pisahkan dengan koma contoh : Informatika,Java,Coding
                    </span>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-md-4 col-form-label text-md-right">Harga Buku</label>

                    <div class="col-md-6">
                        <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}" required>

                        @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tebalBuku" class="col-md-4 col-form-label text-md-right">Tebal Buku</label>

                    <div class="col-md-6">
                        <input id="tebalBuku" type="number" class="form-control{{ $errors->has('tebalBuku') ? ' is-invalid' : '' }}" name="tebalBuku" value="{{ old('tebalBuku') }}" required>

                        @if ($errors->has('tebalBuku'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tebalBuku') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahunTerbit" class="col-md-4 col-form-label text-md-right">Tahun Terbit</label>

                    <div class="col-md-6">
                        <input id="tahunTerbit" type="number" class="form-control{{ $errors->has('tahunTerbit') ? ' is-invalid' : '' }}" name="tahunTerbit" value="{{ old('tahunTerbit') }}" required>

                        @if ($errors->has('tahunTerbit'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tahunTerbit') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="namaPenerbit" class="col-md-4 col-form-label text-md-right">Nama Penerbit</label>

                    <div class="col-md-6">
                        <select id="namaPenerbit" type="text" data-live-search="true" class="selectpicker form-control{{ $errors->has('namaPenerbit') ? ' is-invalid' : '' }}" name="namaPenerbit" required>
                          <option value="" selected disabled>Nama Penerbit</option>
                          <?php
                            $hasil = DB::select("CALL ShowAllPenerbit()");
                                foreach($hasil as $row)
                                {
                                    $term = $row->namaPenerbit;
                                    $id = $row ->idPenerbit;
                                    echo "<option value='$id' data-tokens='$term'>".$term."</option>";

                                }
                            
                         ?>
                        </select>
                        @if ($errors->has('namaPenerbit'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('namaPenerbit') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namaPengarang" class="col-md-4 col-form-label text-md-right">Nama Pengarang</label>

                    <div class="col-md-6">
                        <select id="namaPengarang" type="text" data-live-search="true" class="selectpicker form-control{{ $errors->has('namaPengarang') ? ' is-invalid' : '' }}" name="namaPengarang" required>
                          <option value="" selected disabled>Nama Pengarang</option>
                          <?php
                            $hasil = DB::select("CALL ShowAllPengarang()");
                                foreach($hasil as $row)
                                {
                                    $term = $row->namaPengarang;
                                    $id = $row ->idPengarang;
                                    echo "<option value='$id' data-tokens='$term'>".$term."</option>";

                                }
                            
                         ?>
                        </select>
                        @if ($errors->has('namaPengarang'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('namaPengarang') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-3">
                        <a href="{{ route('tambahPengarang') }}" class="btn btn-primary">
                           Tambah Pengarang
                        </a>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                           Tambah Buku
                        </button>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('tambahKategori') }}" class="btn btn-primary">
                           Tambah Kategori
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('tambahPenerbit') }}" class="btn btn-primary">
                           Tambah Penerbit
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
@endsection
