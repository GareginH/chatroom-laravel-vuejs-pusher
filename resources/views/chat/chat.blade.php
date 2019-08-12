@extends('layouts.app')
@section('content')

<div class="chat-screen">
    <div id="chat-header" class="d-flex">
        <a href="{{route('home')}}" class="btn btn-outline-orange chat-bk-button col-2">Back</a>
        <div class="col text-right">{{str_replace(' ', '/', $chat->name)}}</div>
    </div>
    <div id="post">
    <chat-room room="{{$room}}" user="{{auth()->user()->name}}"></chat-room>
    </div>

</div>

@endsection
