<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Session;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /* Middleware */
    public function __construct()
    {
        $this->middleware('admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $rules = [
            'name' => 'required',
            'email' => 'required|email'
          
        ];

        $this->validate($request, $rules) ;

        // create user an profile
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password')
        ]);


        Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/users/user.png'
        ]);

        // notification
        Session::flash('success', 'User created successfully!');

        // redirection
        return redirect()->route('user');

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->profile->delete();
        $user->delete();

        Session::flash('success' , 'User and his profile has been deleted !');

        return redirect()->back();
    }

    /**
    * Make admin
     */
    public function admin($id){
        $user = User::findOrFail($id);

        $user->admin = 1;

        $user->save();

        Session::flash('success', 'Permissions changed to admin !');

        return redirect()->back();
    }


    public function notAdmin($id){
        $user = User::findOrFail($id);
        $user->admin = 0;
        $user->save();

        Session::flash('success',  'Admin permissions removed !');

        return redirect()->back();
    }
}
