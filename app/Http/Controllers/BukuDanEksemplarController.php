<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BukuDanEksemplarController extends Controller
{
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        $sql = "CALL ShowBukuById ($id)";
        $buku = DB::select("CALL ShowBukuById($id)");
    
        $kumpulanBukudanEksemplar = DB::select("CALL ShowBukudanEksemplar ($id)");
        $isAdmin = FALSE;
        if(Auth::user()->hakStatus==1){
          $isAdmin = TRUE;  
        }
        return view('TampilanDetailBuku',compact('kumpulanBukudanEksemplar','buku','isAdmin','id'));
    }
}