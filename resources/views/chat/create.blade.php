@extends('layouts.app')
@section('content')
<div class="chat-screen">
    <div class="container">
        <div class="d-flex flex-column">
            <div id="chat-header" class="d-flex">
                <a href="{{route('home')}}" class="btn btn-outline-orange chat-bk-button col-2">Back</a>
                <div class="col text-right">Chat with</div>
            </div>
            <div id="chatBox">
                <form action="/chat-create" method="POST">
                    @csrf
                    @foreach($users as $user)
                        @if ($user->name !== auth()->user()->name)
                        <div class="col-12 btn-outline-orange chat-creation">
                            <input id="users_list[{{$loop->index}}]" type="checkbox" name="users_list[{{$loop->index}}]" value={{$user->id}}>
                            <label for="users_list[{{$loop->index}}]">{{$user->name}}</label>
                            <img src="/storage/avatars/{{$user->profile->image}}" class="img-fluid chat-creation-image">
                        </div>
                        @endif
                    @endforeach
                    <input type="submit" id="submit-form" class="d-none" />
                </form>
            </div>
            <div class="chatbox-form">
                <label for="submit-form" class="btn btn-outline-orange col-8" tabindex="0">Create room</label>
            </div>
        </div>
    </div>
</div>
@endsection
