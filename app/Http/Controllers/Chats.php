<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Events\sendMessage;

class Chats extends Controller
{
    function saveMessage(Request $r)
    {
        DB::table('messages')->insert(['message'=>$r->message, 'sender_id'=>$r->sender_id, 'reciever_id'=>$r->reciever_id,'d_sender'=>false,'d_reciever'=>false]);
        $msg_content = ['message'=>$r->message, 'sender_id'=>$r->sender_id, 'reciever_id'=>$r->reciever_id];
        event(new sendMessage($msg_content));
        $data = DB::table('messages')
        ->where(function($query) use ($r) {
            $query->where('sender_id', $r->sender_id)
                  ->where('reciever_id', $r->reciever_id);
        })
        ->orWhere(function($query) use ($r) {
            $query->where('sender_id', $r->reciever_id)
                  ->where('reciever_id', $r->sender_id);
        })
        ->select('id','message','sender_id','reciever_id')
        ->get();


        event(new sendMessage(['reciever_id'=>$r->reciever_id,'sender_id'=>$r->sender_id,'message'=>$r->message]));
        
        return response()->json($data);
    }
}
