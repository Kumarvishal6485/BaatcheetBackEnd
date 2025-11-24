<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SearchUsers extends Controller
{
    public function searchUsers(Request $r) {
        $data = DB::table('users')->where('name','like','%'.$r->search.'%')->where('id', '!=', $r->userId)->select('id','name','image')->get();
        return response()->json(['data' => $data]);
    }
}
