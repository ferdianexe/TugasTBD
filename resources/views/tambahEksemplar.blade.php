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
  <form  method="POST" action="{{ route('tambahEksemplarForm') }}" id="tambahEksemplar">
  @csrf
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
    <label for="judul" class="col-sm-2 col-form-label tulisanKekiri">Judul Buku</label>
    <div class="col-sm-6">
    <select id="judul" type="text" class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}" name="judul" required>
      <option value="" selected disabled>Judul Buku</option>
      @foreach ($kumpulanBuku as $buku)
        <option value="{{$buku->idBuku}}">{{$buku->nama}}</option>
      @endforeach
    </select>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Nomor Eksemplar</label>
    <div class="col-sm-6">
      <input type="number" name="noEksemplar" class="form-control" min="1">
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  @if(isset($pesan))
    <div class="form-group row">
      <div class="col-sm-2">
      </div>
        {{$pesan}}
      <div class="col-sm-2">
      </div>
    </div>
  @endif
  <br>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <button class="btn btn-primary col-sm-2" type="submit" onclick="proses(event)">Delete Eksemplar</button>
    <div class="col-sm-4">
    </div>
    <button class="btn btn-primary col-sm-2" type="submit" onclick="proses2(event)">Tambah Eksemplar</button>
    <div class="col-sm-2">
    </div>
  </div>
  <br><br>
</form>
<!-- Div yg modal untuk buttonDeleteEksemplar -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Eksemplar</h4>
          <button type="button" class="close" onclick="batalHapus()" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <a>Delete Eksemplar dengan judul "..."?</a>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="deleteYes" type="submit" onclick="hapus()">Ya</button>
          <button type="button" class="btn btn-danger" id="deleteNo" type="submit" onclick="batalHapus()">Tidak</button>
        </div>
        
      </div>
    </div>
  </div>

  <!-- Div yg modal untuk buttonTambahEksemplar -->
  <div class="modal fade" id="myModalTambahEksemplar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Eksemplar</h4>
          <button type="button" class="close" onclick="batalHapus()" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <a>Tambah Eksemplar dengan judul "..."?</a>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="TambaheYes" type="submit" onclick="tambah()">Ya</button>
          <button type="button" class="btn btn-danger" id="TambahNo" type="submit" onclick="batalTambah()">Tidak</button>
        </div>
        
      </div>
    </div>
  </div>

  <script>
    function proses(e) {
      e.preventDefault();
      document.getElementById('myModal').className = "modal show";
    }
    function hapus(){
      document.getElementById('tambahEksemplar').submit();
      document.getElementById('myModal').className = "modal hide";
      window.location.href="/";
    }

    function batalHapus(){
      // query here;
      document.getElementById('myModal').className = "modal hide";
      document.getElementById('myModalTambahEksemplar').className = "modal hide";
    }

    function proses2(e) {
      e.preventDefault();
      document.getElementById('myModalTambahEksemplar').className = "modal show";
    }

    function tambah(){
      document.getElementById('tambahEksemplar').submit();
      document.getElementById('myModalTambahEksemplar').className = "modal hide";
      // window.location.href="/";
    }

    function batalTambah(){
      // query here;
      document.getElementById('myModalTambahEksemplar').className = "modal hide";
    }
  </script>
  </div>
</div>
@endsection

