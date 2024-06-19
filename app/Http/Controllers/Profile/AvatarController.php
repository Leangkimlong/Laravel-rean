<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {
        // give path in larvael file
        // $path = $request->file('avatar')->store('avatars' , 'public');
        $path = Storage::disk('public')->put('avatars', $request->file('avatar'));

        // check if have previous avatar if have delete before update the new avatar
        if($oldAvatar = $request->user()->avatar){
            Storage::disk('public')->delete($oldAvatar);
        }

        // update avatar column with path information
        auth()->user()->update(['avatar' => $path]);

        // dd(auth()->user());
        // store avatar
        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }
}
