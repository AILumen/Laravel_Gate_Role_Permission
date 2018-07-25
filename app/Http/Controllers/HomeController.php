<?php

namespace App\Http\Controllers;
use Gate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }



    public function private()
    {
       if (Gate::allows('admin-only', auth()->user())) {
            return view('private');
        }
        return 'You are not admin!!!!';
    }
}
