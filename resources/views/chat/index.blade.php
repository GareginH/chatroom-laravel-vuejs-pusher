@extends('layouts.app')
@section('content')
<div class="chat-screen">
<div class="container ">
    <div class="main-chat d-flex justify-content-center flex-column ">
        <div id="chat-header">
            <a href="{{route('viewprofile', auth()->user()->id)}}">
                {{auth()->user()->name}}
            </a>
        </div>
        <div id="chatBox">
            <div class="col-12 chat-profile-container">
                <a href={{route('viewprofile', auth()->user()->id)}}>
                    <img src="/storage/avatars/{{$profile}}" alt="" class="chat-profile-picture img-fluid">
                </a>
            </div>
            @foreach ($chat as $item )
            <div class="col-12 mt-2 mb-2">
                <a href="{{route('chatroom', $item->id)}}" class="btn btn-outline-orange col-12">
                    {{$item->name}}
                </a>
            </div>
            @endforeach
        </div>
        <div class="chatbox-form">
            <a href="{{route('create')}}" class="btn btn-outline-orange col-8">CHAT WITH OTHERS</a>
        </div>

    </div>

</div>
</div>
@endsection
