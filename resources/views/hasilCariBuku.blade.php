@extends('layouts.navbar')
@section('content')

<div class="content" style="width:inherit; height:inherit; background-image:url('../images/library2.jpg');">
  <div class="row">
    <div class="col-sm-3"></div>

    <div class="col-sm-6">
      @if(isset($search))
      <H3 style="color:aqua;">Yang dicari= {{$search}} {{$filter}}</H3>
      @endif
      <div class="container">
          <br>
          <form method="GET" action="{{ route('searchBook') }}">
            <div class="container h-100">
              <div class="d-flex justify-content-center h-100">
                <div class="searchbar">
                  <input class="search_input" type="text" name="search" placeholder="Search...">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          
          
            <br>

          <div class="row container-fluid">
            <div class="row align-items-center justify-content-center" style= "width:100%;">
              <div class="form-group ">
                <select id="inputState " class="selectpicker form-control" name="filter">
                  <option class="hint" data-live-search="true" selected value="0" disabled="disabled">(Genre)</option>
                  @foreach($kumpulanKategori as $kategori)
                  <option value="{{$kategori->idKategori}}" data-tokens='{{$kategori->kategori}}'>{{$kategori->kategori}} </option>
                @endforeach
                </select>
              </div>
            </div>
          </div>
          </form>
      </div>
      
      <div class="container-fluid" style="background-color:orange;opacity:0.9">
          <div class="container-fluid" style="opacity:1;">
              <table class="table">
                  <thead>
                  <tr>
                    <th>Nomor Buku</th>
                    <th>Judul Buku</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($kumpulanBuku as $key=>$buku)
                    <tr>
                      <td>{{($key+1)+($page*12)}}</td>
                      <td><a href="{{ url('TampilanDetailBuku/'.$buku->idBuku)}}">{{$buku->nama}}</a></td>
                    </tr>
                  @endforeach
                  </tbody>

                  </table>
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="/hasilCariBuku">1</a></li> 
                      @foreach($previousPage as $prePage)
                        <li class="page-item"><a class="page-link" href="/hasilCariBuku?page={{$prePage-1}}">{{$prePage}}</a></li> 
                      @endforeach  
                      @foreach($paginationPage as $pagPage)
                        <li class="page-item"><a class="page-link" href="/hasilCariBuku?page={{$pagPage-1}}">{{$pagPage}}</a></li> 
                      @endforeach 
                    </ul>
              </table>
          </div>

          <div class="row">
              <div class="col-sm-2"></div>
              <div class="col-sm-3">
                  <button type="button" class="btn btn-primary active">Prev</button>
              </div>
              <div class="col-sm-2"></div>
              <div class="col-sm-3">
                  <button type="button" class="btn btn-primary active">Next</button>
              </div>
              <div class="col-sm-2"></div>
          </div>
      </div><br><br>

  </div>

  
</div>

@endsection