<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.profile');
//        Or we can do it like follows then we use Auth::user() in the view
        //return view('admin.users.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        // validate data
        $rules = [
            'name' =>'required',
            'email' =>'required | email',
            'facebook' => 'required | url',
            'youtube' => 'required | url',
        ];
        $this->validate($request, $rules);
        // check if the user update the avatar
        if($request->hasFile('avatar')){
            $avatar = $request->avatar;
            $new_avatar_name = time(). $avatar->getClientOriginalName();
            $avatar->move('uploads/avatars', $new_avatar_name);
            $user->profile->avatar = 'uploads/avatars/' . $new_avatar_name;
            $user->profile->save();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile->facebook = $request->facebook;
        $user->profile->youtube = $request->youtube;
        $user->profile->about = $request->about;

        $user->save();
        $user->profile->save();

        // check if the password updated or it is set by default on the UsersController
        if($request->has('password')){
            $user->password = bcrypt($request->password);
            $user->save();
        }


        Session::flash('success', 'Profile updated successfully !');

        return redirect()->back();




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
