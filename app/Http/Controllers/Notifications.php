<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Notifications extends Controller
{
    function getNotifications(Request $r)
    {
        $data = DB::table('connection')->join('users', 'connection.requestorId','users.id')->where(['connection.userId' => $r->userId])->select('connection.id', 'userId', 'requestorId', 'users.name','users.image')->get();
        return response()->json($data);
    }
}
