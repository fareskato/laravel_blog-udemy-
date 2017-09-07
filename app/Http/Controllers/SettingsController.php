<?php

namespace App\Http\Controllers;

use App\Setting;
use Session;


class SettingsController extends Controller
{
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
        return view('admin.settings.index')->with('settings', Setting::first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        $settings = Setting::first();
        $this->validate(request(), [
            'site_name' => 'required',
            'site_email' => 'required',
            'site_phone' => 'required'
        ]);

        $settings->site_name = request()->site_name;
        $settings->site_email = request()->site_email;
        $settings->site_phone = request()->site_phone;

        $settings->save();

        Session::flash('success', 'Settings has been updated');
        return redirect()->back();
    }

}
