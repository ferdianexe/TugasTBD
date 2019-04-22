<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class PenerbitController extends Controller
{
  
    
    public function showAllPenerbit()
    {
        $kumpulanPenerbit = DB::select("CALL ShowAllPenerbit()");
        return view('tambahPenerbit',compact('kumpulanPenerbit'));;
    }
}