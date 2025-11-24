<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Contacts extends Controller
{
    function getContacts(Request $r)
    {
        $data = DB::table('contacts')->join('users','contacts.friend_id','users.id')->where(['contacts.user_id'=>$r->userId])->select('contacts.friend_id','users.name')->get();
        return response()->json($data);
    }
}