<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HalamanDepanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

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
        $kumpulanBuku = DB::select("CALL ShowAllBukuOnlyIdAndJudulWithLimit('12')");
        $kumpulanKategori = DB::select("CALL ShowAllCategory");
        return view('welcome',compact('isAdmin','kumpulanBuku','kumpulanKategori'));
    }
}
