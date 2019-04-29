<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
        $kumpulanBuku = DB::select("CALL ShowAllBukuOnlyIdAndJudul()");
        return view('welcome',compact('isAdmin','kumpulanBuku'));
    }
}
