<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use Auth;
use Carbon\Carbon;

class DendaController extends BaseController
{
    protected function showAllAturan(Request $request)
    {
        $sql = "CALL ShowAturanDenda ()";
        $PDO = DB::connection()->getPdo();
        $PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        $QUERY = $PDO->prepare($sql);
        $QUERY->execute();
        $result=$QUERY->fetchAll();
        $error = FALSE;
        return View('showAturanDenda', compact('result','error'));
    }

    protected function tambahAturanDenda(Request $request)
    {
        if($request->has('hariKe')&&$request->has('nominalDenda')){
            if($request->input('hariKe') != '' &&$request->input('nominalDenda') ){
                $hariKe = $request->input('hariKe');
                $nominalDenda = $request->input('nominalDenda');
        
                $sql = "CALL CreateAturanDenda ('$hariKe','$nominalDenda')";
                $PDO = DB::connection()->getPdo();
                // $PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
                $QUERY = $PDO->prepare($sql);
                $QUERY->execute();
                return redirect()->route('showAturanDenda');
            }
        }

        return redirect()->route('showAturanDenda')->with('error','Error Input');
    }

    protected function updateAturanDenda(Request $request)
    {
        if($request->has('hariKe')&&$request->has('nominalDenda')){
            if($request->input('hariKe') != '' &&$request->input('nominalDenda') ){
                $hariKe = $request->input('hariKe');
                $nominalDenda = $request->input('nominalDenda');
        
                $sql = "CALL UpdateAturanDenda ('$hariKe','$nominalDenda')";
                $PDO = DB::connection()->getPdo();
                $QUERY = $PDO->prepare($sql);
                $QUERY->execute();
        
                return redirect()->route('showAturanDenda');
            }
        }
        return redirect()->route('showAturanDenda')->with('error','Error Input');
    }

    protected function showDendaKu(Request $request)
    {
        $idUser = Auth::user()->id;
        // $tglNow = Carbon::now();

        $sql = "CALL ShowDendaKu ('$idUser')";
        $PDO = DB::connection()->getPdo();
        $PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        $QUERY = $PDO->prepare($sql);
        $QUERY->execute();
        $result=$QUERY->fetchAll();

        return View('showDendaKu', compact('result'));
    }

    protected function kembalikanBuku(Request $request)
    {
        $idUser = Auth::user()->id;
        $tglNow = Carbon::now();
        $kodeEksemplar = $request->get('kodeEksemplar');
        $tglPeminjaman = $request->get('tglMeminjam'); 
        $tglJatuhTempo = $request->get('tglJatuhTempo');

        $sql = "CALL kembalikanBuku ('$idUser','$kodeEksemplar','$tglPeminjaman','$tglJatuhTempo','$tglNow')";
        $PDO = DB::connection()->getPdo();
        $PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        $QUERY = $PDO->prepare($sql);
        $QUERY->execute();

        return redirect()->route('pinjamanBuku');
    }
}
