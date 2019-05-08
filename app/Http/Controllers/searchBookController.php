<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class SearchBookController extends Controller
{
    public function testParsingData(Request $request){
        $searchStatus = $request->has('search');
        $page=0;
        if($request->has('page')){
            $page = $request->input('page');
          }
        if($searchStatus == true)
        {
            $search = $request->get('search');
            $filter = $request->get('filter');
            $kumpulanBuku = DB::select("CALL VSMsearch('$search')");
            return view('hasilCariBuku', compact('search','filter','kumpulanBuku'));
        }
        else
        {
            $kumpulanBuku = DB::select("CALL ShowAllBukuOnlyIdAndJudul()");
            $counter = ceil((count($kumpulanBuku)*1.0)/12);
            $paginationPage = array(); 
            $previousPage = array();
            $startVal = (int)($page/10);
            $continousPagination = ($page%10);
            for($i = 1 ; $i<10;$i++){
                if(($page-9+$i)>1){
                  array_push ($previousPage,($page-9+$i)); //masukan selama page tidak negatif
                }
                if(($startVal+$continousPagination+$i)==1)continue; // masukan selama page bukan 1 (1 ga masuk looping)
                if(($startVal*10)+$continousPagination+$i>=$counter) continue; // masukan selama masih tersedia didalam counter
                  array_push ($paginationPage,(($startVal*10)+$continousPagination+$i));
                }
                if($page != $counter){ //jika page = counter tidak perlu dimasukan karena ujung page selalu di print
                  array_push ($paginationPage, $counter);
                }
            $kumpulanBuku = DB::select("CALL ShowAllBukuOnlyIdAndJudulWithLimit('$page')"); //query sebenarnya yang mmenggunakan offset
           
            return view('hasilCariBuku', compact('kumpulanBuku','paginationPage','page','previousPage'));
        }
        
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