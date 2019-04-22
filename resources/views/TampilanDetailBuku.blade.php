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
  <form  method="GET" action="/hasilCariBuku" id="detailBuku">
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
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Judul Buku</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri" placeholder="Masukkan Judul Buku">Judulnya</label>
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
        <tr>
            <td>1</td>
            <td>Status : Dipinjam</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Status : Dipinjam</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Status : Dipinjam</td>
        </tr>
      </table>
    
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Harga Buku</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">Rp 10.000,-</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Tebal Buku</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">130 hlm</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Tahun Terbit</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">1998</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Nama Penerbit</label>
    <div class="col-sm-8">
      <label class="col-sm-8 col-form-label tulisanKekiri">Michael Stevin</label>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <br>
  <div class="form-group row">
    <div class="col-sm-5">
    </div>
    <button class="btn btn-primary col-sm-2" type="submit">Back</button>
    <div class="col-sm-5">
    </div>
  </div>
  <br><br>
</form>

  <script>
    // function kembali(e){
    //   e.preventDefault();
    //   window.location.href="/hasilCariBuku";
    //   document.getElementById('detailBuku').submit();
    // }
  </script>
  </div>
</div>
@endsection

