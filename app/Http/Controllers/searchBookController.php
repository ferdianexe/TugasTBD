<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class SearchBookController extends Controller
{
    public function testParsingData(Request $request){
        $search = $request->get('search');
        $filter = $request->get('filter');
        $kumpulanBuku = DB::select("CALL ShowAllBukuOnlyIdAndJudul()");
        return view('hasilCariBuku', compact('search','filter','kumpulanBuku'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('hasilCariBuku');
    }
}