<?php

namespace App\Http\Controllers;

use App\Overwatchdetail;
use Illuminate\Http\Request;

class OverwatchDetailController extends Controller
{
    public function updatePosition(Request $req)
    {
        $overwatchdetail = Overwatchdetail::where('username', $req->username)->first();

        if($req->detail == 'role')
        {
            $overwatchdetail->mainRole = $req->input1;
            $overwatchdetail->save();
        }
        elseif($req->detail == 'hero')
        {
            $overwatchdetail->hero1 = $req->input1;
            $overwatchdetail->hero2 = $req->input2;
            $overwatchdetail->hero3 = $req->input3;
            $overwatchdetail->save();
        }
        elseif($req->detail == 'mmr')
        {
            $overwatchdetail->tier = $req->input1;
            $overwatchdetail->save();
        }
    }
}
