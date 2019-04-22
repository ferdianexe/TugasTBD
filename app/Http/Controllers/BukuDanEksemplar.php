<?php
namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BukuDanEksemplar extends Controller
{
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        // $id = ;
        $sql = "CALL ShowBukudanEksemplar ($id)";
        $results = DB::connection()->getPdo()->query($sql);
        
        $kumpulanBukudanEksemplar = $results->fetchAll();
        return view('TampilanDetailBuku',compact('kumpulanBukudanEksemplar'));
    }
}