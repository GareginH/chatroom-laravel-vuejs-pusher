@extends('layouts.app')
@section('content')

<div class="container">
    <form action="/profile/{{auth()->user()->id}}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="desc">Description</label>
            <input type="text"  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" aria-describedby="descHelp">
            <small id="descHelp" class="form-text text-muted">Please briefly describe yourself.</small>
            @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <input type="file" class="form-control-file{{ $errors->has('avatar') ? ' is-invalid' : '' }}" name="avatar" id="avatarFile" aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
            @if ($errors->has('avatar'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('avatar') }}</strong>
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-outline-orange">Submit</button>
    </form>
</div>
@endsection
