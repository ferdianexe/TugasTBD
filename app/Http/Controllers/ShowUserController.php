<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class ShowUserController extends BaseController
{
    protected function showAllUser(Request $request)
    {
        $sql = "CALL ShowUser ()";
        // $result = DB::connection()->getPdo()->exec($sql);
        // $result = $result->fetchAll(PDO::FETCH_ARRAY);
        $PDO = DB::connection()->getPdo();
        $QUERY = $PDO->prepare($sql);
        $QUERY->execute();
        $result=$QUERY->fetchAll();

        return View('tampilanAnggota', compact('result'));
        // return $result;
    }
}
