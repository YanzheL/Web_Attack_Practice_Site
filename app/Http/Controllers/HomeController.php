<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//         $this->middleware('auth');
//         route('fakelogin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard()->check()) {
            if (Auth::user()->email == 'test36@test.test') {
                return view('admin', ['fetched_data' => Message::all()]);
            } else {
                return view('SHRmMFA1UkpZcnZsTU1hWUNcL1N3PT0iLCJ2YWx1ZSI6');
            }
        } else {
            return redirect()->route('fakelogin');
        }
    }
}
