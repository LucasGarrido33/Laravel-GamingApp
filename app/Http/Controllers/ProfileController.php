<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use App\Game;
use Image;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }

    /**
     * Show the edit form profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user->profile);

        return view('user.edit', ['user' => $user , 'games'=> Game::all()]);
    }

    /**
     * Update the given user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user->profile);
        $this->validate($request, [
            'bio' => 'required|max:25',
        ]);


        $user->profile->bio = $request->bio;
        $user->profile->gender = $request->gender;

        if ($request->hasFile('avatar')) {
            $imagename = time() . '.' . $request->avatar->getClientOriginalExtension();
            $destinationPath = ('public/avatars');
            $user->profile->avatar = $imagename;
            $avatar = Image::make($request->avatar)->resize(300, 200);

            Storage::put($destinationPath . '/' . $imagename, $avatar->stream());
        }

        $user->games()->detach();
        $user->games()->sync($request->games);

        $user->profile->save();

        return redirect()->action(
            'ProfileController@show', ['id' => $id]
        );
    }


}
