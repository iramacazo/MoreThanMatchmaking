<?php

namespace App\Http\Controllers;

use App\Dotadetail;
use Illuminate\Http\Request;

class DotaDetailController extends Controller
{
    public function updatePosition(Request $req)
    {
        $dotadetail = Dotadetail::where('username', $req->username)->first();

        if($req->detail == 'role')
        {
            $dotadetail->mainRole = $req->input1;
            $dotadetail->save();
        }
        elseif($req->detail == 'hero')
        {
            $dotadetail->hero1 = $req->input1;
            $dotadetail->hero2 = $req->input2;
            $dotadetail->hero3 = $req->input3;
            $dotadetail->save();
        }
        elseif($req->detail == 'mmr')
        {
            $dotadetail->mmrBracket = $req->input1;
            $dotadetail->save();
        }
    }
}
