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
  
  <form onsubmit="proses()">
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
    <div class="col-sm-6">
      <input type="text" class="form-control" placeholder="Masukkan Judul Buku">
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Kategori</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" placeholder="Masukkan Kategori Buku">
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Nomor Eksemplar</label>
    <div class="col-sm-6">
      <input type="number" class="form-control" min="1">
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Harga Buku</label>
    <div class="col-sm-6">
      <input type="number" class="form-control" min="1">
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Tebal Buku</label>
    <div class="col-sm-6">
      <input type="number" class="form-control" min="1">
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Tahun Terbit</label>
    <div class="col-sm-6">
      <input type="number" class="form-control" min="1" placeholder="Masukkan Tahun Terbit Buku">
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <label for="staticEmail" class="col-sm-2 col-form-label tulisanKekiri">Nama Penerbit</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" placeholder="Masukkan Nama Penerbit Buku">
    </div>
    <div class="col-sm-2">
    </div>
  </div>
  <br>
  <div class="form-group row">
    <div class="col-sm-2">
    </div>
    <button class="btn btn-primary col-sm-2" data-toggle="modal" data-target="#myModal">Delete Eksemplar</button>
    <div class="col-sm-4">
    </div>
    <button class="btn btn-primary col-sm-2">Tambah Eksemplar</button>
    <div class="col-sm-2">
    </div>
  </div>
  <br><br>
</form>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Delete Eksemplar dengan judul "..."?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="deleteYes" type="submit">Ya</button>
          <button type="button" class="btn btn-danger" id="deleteNo" type="submit">Tidak</button>
        </div>
        
      </div>
    </div>
  </div>

  <script>
    function proses(e) {
      $('#myModal').modal('show');
      if(document.getElementById('deleteYes'))
      {
        // "blablablaa";
      }
      $('#myModal').modal('hide');
    }

// $('#Delete').click(function () {
//    var studentId = $('#itemid').val();

//    $.post(@Url.Action("Delete", "Delete"), { id: studentId }, function (data) {
//        // do something after calling delete action method
//        // this alert box just an example
//        alert("Deleted StudentId: " + studentId);
//    });

//    $('#exampleModalCenter').modal('hide');
// });
  </script>
  </div>
</div>
@endsection
