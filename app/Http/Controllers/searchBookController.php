<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class SearchBookController extends Controller
{
    public function testParsingData(Request $request){
        $searchStatus = $request->has('search') || $request->has('filter');
        $page = 0;
        $paginationPage = array(); 
        $previousPage = array();
        $kumpulanKategori = DB::select("CALL ShowAllCategory");
        if($request->has('page')){
            $page = $request->input('page');
        }
        $filter = NULL;
        if($searchStatus)
        {
            if($request->has('filter')){
                $filter = $request->get('filter');
                $namaKategori = DB::select("CALL giveCategoryName('$filter')");
                $kumpulanBuku = DB::select("CALL searchByFilter('$filter',-1)");
                $counter = ceil((count($kumpulanBuku)*1.0)/12);
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
                if($page == 0){ // kalo dia page awal
                  if($counter != 1 && $counter != 0){ // masukin kalo pagenya lebih dari 1
                     array_push ($paginationPage, $counter);  
                  }
                }else if($page <= $counter){ // masukin selama page yang tersedia masih lebih besar dari pagenya
                  array_push ($paginationPage, $counter);
                }
                $kumpulanBuku = DB::select("CALL searchByFilter('$filter','$page')");
                return view('hasilCariBuku', compact('search','filter','kumpulanBuku','paginationPage','page','previousPage','kumpulanKategori','filter','namaKategori'));
            }
            $search = $request->get('search');
            $kumpulanBuku = DB::select("CALL VSMsearch('$search')");
            return view('hasilCariBuku', compact('search','filter','kumpulanBuku','paginationPage','page','previousPage','kumpulanKategori'));
        }
        else
        {
            $kumpulanBuku = DB::select("CALL ShowAllBukuOnlyIdAndJudul()");
            $counter = ceil((count($kumpulanBuku)*1.0)/12);
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
                if($page == 0){ // kalo dia page awal
                  if($counter != 1 && $counter != 0){ // masukin kalo pagenya lebih dari 1
                     array_push ($paginationPage, $counter);  
                  }
                }else if($page <= $counter){ // masukin selama page yang tersedia masih lebih besar dari pagenya
                  array_push ($paginationPage, $counter);
                }
            $kumpulanBuku = DB::select("CALL ShowAllBukuOnlyIdAndJudulWithLimit('$page')"); //query sebenarnya yang mmenggunakan offset
            return view('hasilCariBuku', compact('kumpulanBuku','paginationPage','page','previousPage','kumpulanKategori'));
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