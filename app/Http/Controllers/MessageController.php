<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SendMessage;
use App\Message;
use App\User;
class MessageController extends Controller
{
    public function store(Request $req){

        
        $message = auth()->user()->message()->create(
            [   
                'user_name'=>auth()->user()->name,
                'content'=>$req->content,
                'chat_id'=>$req->chat_id,
            ]
        );
        event(new SendMessage($message));

    }
    public function show($chat){
        $messages = Message::where('chat_id', $chat)->get();
        return json_encode($messages);
        
    }
}
