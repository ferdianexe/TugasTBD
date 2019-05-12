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
  <!-- onsubmit="proses(event)" -->
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-1"></div>
    <h5 class="col-sm-7">
    <!-- Tambah Eksemplar -->
    </h5>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Judul</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri" placeholder="Masukkan Judul Buku">{{$buku[0]->nama}}</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Kategori</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri" placeholder="Masukkan Kategori Buku">Kategorinya</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Nomor Eksemplar</label>
    <div class="col-sm-2"></div>
      <!-- <label class="col-sm-8 col-form-label tulisanKekiri">1,2,3,4</label> -->
      <table class="col-sm-4">
      @foreach ($kumpulanBukudanEksemplar as $index=>$eksemplar)
        <tr>
          <td>{{$eksemplar->kodeEksemplar}}</td>
          <td>
          @if($eksemplar->statusPeminjaman == 0)
            Status : Tersedia
            @else
            Status : Dipinjam
            @endif
          </td>
          <td>
          @if ($eksemplar->statusPeminjaman == 0 AND !$isAdmin)
                <form method="POST" action="{{ route('tambahPeminjaman') }}">
                  @csrf
                  <input type="number" name="kodeEksemplar" value="{{$eksemplar->kodeEksemplar}}" hidden>
                  <input type="number" name="kodeBuku" value="{{$id}}" hidden>
                  <input type="submit" value="Pinjam">
                </form>
            @endif
          </td>
        </tr>
      @endforeach
      </table>
    
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Harga Buku</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">Rp {{$buku[0]->hargaBuku}},-</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Tebal Buku</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">{{$buku[0]->tebalBuku}} hlm</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Tahun Terbit</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">{{$buku[0]->tahunTerbit}}</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Nama Penerbit</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">{{$buku[0]->namaPenerbit}}</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Nama Pengarang</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">{{$buku[0]->namaPengarang}}</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <br>
  <div class="form-group row">
    <div class="col-sm-5">
    </div>
    <a class="btn btn-primary col-sm-2" href="{{ URL::previous() }}">Back</a>
    <div class="col-sm-5">
    </div>
  </div>
  <br><br>
  </div>
</div>
@endsection

