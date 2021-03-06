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
    <div class="row">
      @if($isAdmin)
        <div class="col-sm-1"></div>
        <div class="col-sm-2">
          <a type="button" href="{{route('pinjamanBuku')}}" class="btn btn-primary active">Semua</a>
        </div>
        <div class="col-sm-2">
          <a type="button" href="{{route('tagTerfavorit')}}" class="btn btn-primary active">Tag Favorit</a>
        </div>
        <div class="col-sm-1">
        <a type="button" href="{{ route('pemesananBuku') }}" class="btn btn-primary active">Request</a>
        </div>
        <div class="col-sm-2">
        <a type="button" href="{{route('bukuTerfavorit')}}"class="btn btn-primary active">Buku Favorit</a>
        </div>
        <div class="col-sm-2">
          <a type="button" href="{{route('seluruhanggota')}}"class="btn btn-primary active">Daftar Anggota</a>
        </div>
        <div class="col-sm-2">
          <a type="button" href="{{route('rekomendasi')}}"class="btn btn-primary active">Buat Rekomendasi</a>
        </div>
      @endif
    </div>
      <h5>
        @if($isAdmin)
          Laporan
        @else
          Buku-Buku yang Dipinjam
        @endif
      </h5>

      <div class="container">
        <table class="table table-condensed" id="table-peminjaman">
          <thead>
          <tr>
            <th>    </th>
            <th>Judul Buku</th>
            <th>Exemplar</th>
            <th>Status</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Jatuh Tempo</th>
            <th>Tanggal Pengembalian</th>
            <th>Denda</th>
            @if($isAdmin)
            <th>User</th>
            @endif
          </tr>
          </thead>
          <tbody>
          <?php $tempSumDenda = 0; ?>
          @foreach ($kumpulanPeminjaman as $index=>$peminjaman)
          <tr>
            <td>{{($index+1)+($page*10)}} </td>
            <td>{{$peminjaman->nama}}</td>
            <td>{{$peminjaman->kodeEksemplar}}</td>
            <td>
              @if($peminjaman->hasReturned)
                Dikembalikan
              @else
                Sedang dipinjam
              @endif
            </td>
            <td>{{$peminjaman->tanggalMeminjam}}</td>
            <td>{{$peminjaman->tglJatuhTempo}}</td>
            <td>{{$peminjaman->tanggalDibalikan}}</td>
            <td>{{$peminjaman->totalDenda}} </td>
            @if($isAdmin)
            <td> <a  href="{{ route('detailUser',$peminjaman->idUser) }}">{{$peminjaman->namaUser}}</a></td>
            @endif
            <td>
              @if ($peminjaman->hasReturned == 0 and !$isAdmin)
                <form action="{{ route('kembalikanBuku') }}">
                  <input type="number" name="kodeEksemplar" value="{{$peminjaman->kodeEksemplar}}" hidden>
                  <input type="timestamp" name="tglMeminjam" value="{{$peminjaman->tanggalMeminjam}}" hidden>
                  <input type="date" name="tglJatuhTempo" value="{{$peminjaman->tglJatuhTempo}}" hidden>
                  <input type="submit" value="Kembalikan">
                </form>
              @endif
            </td>
          </tr>
          <?php $tempSumDenda = $tempSumDenda + $peminjaman->totalDenda; ?>
          @endforeach
          </tbody>
        </table>
          <ul class="pagination">
              <li class="page-item"><a class="page-link" href="/TampilanDataPeminjaman">1</a></li> 
            @foreach($previousPage as $prePage)
              <li class="page-item"><a class="page-link" href="/TampilanDataPeminjaman?page={{$prePage-1}}">{{$prePage}}</a></li> 
            @endforeach  
            @foreach($paginationPage as $pagPage)
              <li class="page-item"><a class="page-link" href="/TampilanDataPeminjaman?page={{$pagPage-1}}">{{$pagPage}}</a></li> 
            @endforeach 
          </ul>
        <hr>
      </div>
  </div>

  <br>
  
  <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-2"></div>
      <div class="col-sm-2"></div>
      <div class="col-sm-2"></div>
      @if(!$isAdmin)
        <div class="col-sm-2"><a>Total Denda : </a></div>
        <div class="col-sm-1">
          <a id="totalDenda" name="denda">{{$tempSumDenda}}</a>
        </div>
      @endif
      <div class="col-sm-1"></div>
  </div>

  <br>
  <div class="jumbotron" class="haflBackground">
      <div class="container for-about">
          <h1>Info</h1>
      </div>
  </div>

</div>
@endsection
