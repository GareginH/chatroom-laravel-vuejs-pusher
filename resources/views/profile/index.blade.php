@extends('layouts.app')
@section('content')

<div class="chat-screen">
        <div id="chat-header" class="d-flex">
            <a href="{{route('home')}}" class="btn btn-outline-orange chat-bk-button col-2">Back</a>
            <div class="col text-right">Profile</div>
        </div>
        <div id="post">
                <div id="chatBox">
                    <div class="chat-profile-container">
                        @foreach ($profile as $item)
                        <div class="col-12">
                                <img src="/storage/avatars/{{$item->image}}" alt="" class="chat-profile-picture img-fluid">
                            </div>
                        <div class="col-12 mb-3">
                            {{$item->title}}
                        </div>
                        <div class="col-12 mb-3">
                            {{$item->description}}
                        </div>
                        @if($ourprofile)
                            <a href="{{ route('editprofile', ['user'=>auth()->user()]) }}" class="btn btn-outline-orange">
                                Edit
                            </a>
                        @endif
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
@endsection
