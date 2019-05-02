<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tambahBuku(Request $request)
    {
        $judul = addslashes($request->input('judulBuku')) ;
        $category = $request->input('category');
        $price = $request->input('price');
        $tahun = $request->input('tahunTerbit');
        $tebalBuku = $request->input('tebalBuku');
        $namaPenerbit = $request->input('namaPenerbit');
        $namaPengarang = $request->input('namaPengarang');
        DB::select("CALL TambahBuku ('$judul','$tebalBuku','$tahun','$price','$namaPenerbit','$namaPengarang','$category')");

        return redirect()->route('tambahBuku');
    }

    function loadNamaPenerbitdanPengarang()
    {
        $kumpulanPenerbit = DB::select("CALL ShowAllPenerbit()");
        $kumpulanPengarang = DB::select("CALL showAllPengarang()");
        return view('tambahBuku',compact('kumpulanPenerbit','kumpulanPengarang'));;
    }

    public function bukuTerfavorit(){
        $kumpulanBuku = DB::select("CALL ShowBukuTerfavorite()");
        $isAdmin = FALSE;
        if(Auth::user()->hakStatus==1){
         $isAdmin = TRUE;  
        }
        return view('TampilanBukuFavorite',compact('kumpulanBuku','isAdmin'));;
    }
}