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
  <form  method="POST" action="{{route('tambahEksemplarForm')}}" id="tambahEksemplar">
    @csrf
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-1"></div>
    <h5 class="col-sm-7">
    Tambah Eksemplar
    </h5>
    <h6 class="col-sm-7">
      @if($success)
        Penambahan Buku Berhasil
      @elseif($error)
        Terjadi kesalahan Input
      @endif
    </h6>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Judul Buku</label>
    <div class="col-sm-6">
      <select id="namaBuku" type="text" data-live-search="true" class="selectpicker form-control{{ $errors->has('namaBuku') ? ' is-invalid' : '' }}" name="namaBuku" required>
        <option value="" selected disabled>Judul Buku</option>
        @foreach ($kumpulanBuku as $buku)
              <option value='{{$buku->idBuku}}' data-tokens='{{$buku->nama}}'>{{$buku->nama}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Nomor Eksemplar</label>
    <div class="col-sm-6">
      <input type="number" class="form-control" id="inputKodeEksemplar" name="kodeEksemplar" min="1">
    </div>
    <div class="col-sm-2">
    </div>
  </div>
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
          <a id="modal-text"></a>
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
    }

    function batalHapus(){
      // query here;
      document.getElementById('myModal').className = "modal hide";
      document.getElementById('myModalTambahEksemplar').className = "modal hide";
    }

    function proses2(e) {
      e.preventDefault();
      let domInputBuku = document.getElementById('namaBuku');
      if(domInputBuku.selectedIndex==0){
        alert("Pilih nama buku !");
      }else{
        let selectedInput = domInputBuku.options[domInputBuku.selectedIndex].text;
        document.getElementById('modal-text').innerHTML = "Tambah Eksemplar dengan judul " + selectedInput;
        document.getElementById('myModalTambahEksemplar').className = "modal show";

      }
    }

    function tambah(){
      let inputKodeEksemplar = document.getElementById('inputKodeEksemplar').value;
      let inputNamaBuku = document.getElementById('namaBuku').value;
      if(inputKodeEksemplar && inputNamaBuku ){
        document.getElementById('myModalTambahEksemplar').className = "modal hide";
        document.getElementById('tambahEksemplar').submit();
      }else{
        alert("Masukan semua input form dengan benar !");
        document.getElementById('myModalTambahEksemplar').className = "modal hide";
      }
    }

    function batalTambah(){
      document.getElementById('myModalTambahEksemplar').className = "modal hide";
    }
  </script>
  </div>
</div>
@endsection

