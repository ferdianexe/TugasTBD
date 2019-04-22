<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DataPeminjamanController extends Controller
{
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $isAdmin = FALSE;
        if(Auth::user()->hakStatus==1){
          $isAdmin = TRUE;  
        }
        if($isAdmin){
          $sql = "CALL ShowPeminjaman (0)";
        }else{
          $id = Auth::user()->id;
          $sql = "CALL ShowPeminjaman ('$id')";
        }
        $results = DB::connection()->getPdo()->query($sql);
        
        $kumpulanPeminjaman = $results->fetchAll();
        return view('TampilanDataPeminjaman',compact('isAdmin','kumpulanPeminjaman'));
    }
}