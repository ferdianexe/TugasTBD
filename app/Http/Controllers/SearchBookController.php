<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Requests;

class SearchBookController extends Controller
{
    public function testParsingData(Request $request){
        // $test = $request->get('search');
        $test = "WOW";

        return view('hasilCariBuku', compact('test'));
        // return view('hasilCariBuku', array('test'=>$test));
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
