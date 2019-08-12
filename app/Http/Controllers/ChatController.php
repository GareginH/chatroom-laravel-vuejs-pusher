<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
use Illuminate\Support\Facades\DB;
class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $req){

        /*$name = User::find($req['user_two'])->name;
        $chat = Chat::where('name', auth()->user()->name." " .$name)->first();
        if ($chat === null) {
            $chat = Chat::where('name', $name." " .auth()->user()->name)->first();
            if ($chat === null) {
                $chat = auth()->user()->chats()->create([
                    'name' => auth()->user()->name . " " . $name,
                ]);
                User::find($req['user_two'])->chats()->syncWithoutDetaching($chat);
            }
        }
        return $this->chatroom($chat->id);
        *///Previous version

        $text = array();
        $counter = 0;
        if($req['users_list'] === null){
            return redirect('chat');
        }
        foreach ($req['users_list'] as $user){

            array_push($text, User::find($user)->name);
            $counter++;
        }
        array_push($text, auth()->user()->name);
        sort($text);
        $name = implode(' ', $text);
        $chat = Chat::where('name', $name)->first();
        if($chat === null){
            $chat = auth()->user()->chats()->create([
                'name' => $name,
                'group'=>($counter > 1)? True : False,
            ]);
            foreach ($req['users_list'] as $user){
                User::find($user)->chats()->syncWithoutDetaching($chat);
            }
        }
        return $this->chatroom($chat->id);
    }

    public function create(){
        $users = User::all();
        return view('chat.create', compact('users'));
    }

    public function index(){
        $chat = auth()->user()->chats;
        $profile = auth()->user()->profile()->pluck('image')->first();
        return view('chat.index', compact('chat', 'profile'));
    }

    public function chatroom($room){
        $chat = Chat::where('id', '=', $room)->first();
        if ($chat === null) {
            return redirect('chat');
        }
        return view('chat.chat', compact('room', 'chat'));
    }
}
