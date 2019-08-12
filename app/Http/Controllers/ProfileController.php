<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class ProfileController extends Controller
{
    public function index(User $user){

        $profile = $user->profile()->get();
        if(count($profile) < 1){
            return redirect('chat');
        }
        $ourprofile = ($profile->pluck('user_id')->first() === auth()->user()->id)? True : False;
        return view('profile.index', compact('profile', 'ourprofile'));

    }

    public function edit(User $user){
        $this->authorize('update', $user->profile);
        return view('profile.edit');
    }

    public function update(Request $request){
        $user = auth()->user();
        $this->authorize('update', $user->profile);
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description'   => 'required',
        ]);
        $avatarName = $user->id.'_avatar'.'.'.request()->avatar->getClientOriginalExtension();
        $request->avatar->storeAs('public/avatars',$avatarName);
        $user->profile->image = $avatarName;
        $user->profile->description = $request->description;
        $user->profile->save();

        return $this->index($user);
    }
}
