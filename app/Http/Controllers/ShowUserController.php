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
        $PDO = DB::connection()->getPdo();
        $PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        $QUERY = $PDO->prepare($sql);
        $QUERY->execute();
        $result=$QUERY->fetchAll();

        return View('tampilanAnggota', compact('result'));
    }

    public function showUserDetail($id){
        $user = DB::select("CALL detailUser('$id')");
        $tagFavorit = DB::select("CALL TagFavoritPerAnggota('$id')");
        return View('UserDetail', compact('user','tagFavorit'));
    }
}
