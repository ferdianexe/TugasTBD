<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EksemplarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Method untuk menambahkan eksemplar
     * @param Request isinya adalah seluruh request dari form
     * cara pakai $request->input('nama_variable')
     * @return void
     */
    public function tambahEksemplar(Request $request)
    {
        $kodeJudulBuku = $request->input('judul');
        $nomorEksemplar = $request->input('noEksemplar');
        $status = DB::select("CALL checkEksemplar($kodeJudulBuku,$nomorEksemplar)");
        if(count($status) == 0){
          DB::select("CALL AddEksemplar($kodeJudulBuku,$nomorEksemplar)");
          
        }
        $kumpulanBuku = DB::select("CALL ShowAllBukuOnlyIdAndJudul()");
        $pesan = "";
        if($status==0){
          $pesan = "Eksemplar sukses ditambahkan !";
          return view('tambahEksemplar',compact('pesan','kumpulanBuku'));
        }
        else{
          $pesan = "Eksemplar ini sudah ditambahkan sebelumnya !";
          return view('tambahEksemplar',compact('pesan','kumpulanBuku'));
        }
        
    }
}
