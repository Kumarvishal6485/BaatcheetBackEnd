<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Connect extends Controller
{
    public function connectionRequest(Request $r) {
        if ($r->input('userId') && $r->input('requestUid') && $r->input('userId') != $r->input('requestUid')) {
            DB::table('connection')->insert(['userId' => $r->requestUid , 'requestorId' => $r->userId]);
            return response()->json(['connection request sent']);
        }
    }

    function requestAccepted(Request $r)
    {
        $data = DB::table('connection')->where(['id'=>$r->id])->select('userId', 'requestorId')->get()->toArray();
        
        if ($data && count($data)) {
            DB::table('contacts')->insert(['user_id' => $data[0]->userId, 'friend_id'=> $data[0]->requestorId]);
            DB::table('contacts')->insert(['user_id' => $data[0]->requestorId, 'friend_id' => $data[0]->userId]);
        }
        return response()->json(['Friend Request Accepted']);
    }

    function requestRejected(Request $r)
    {

    }
}