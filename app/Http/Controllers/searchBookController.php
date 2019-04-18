<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Requests;
class SearchBookController extends Controller
{
    public function testParsingData(Request $request){
        $search = $request->get('search');
        $filter = $request->get('filter');
        return view('hasilCariBuku', compact('search','filter'));
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