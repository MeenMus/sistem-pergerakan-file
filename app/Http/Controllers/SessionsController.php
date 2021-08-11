<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionsController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store()
    {

        $attributes = request()->validate([

            'email' => 'required|email',
            'password' => 'required',

        ]);

        $remember = request('remember_me');

        if (auth()->attempt($attributes, $remember )) {

            if (auth()->user()->role_id == 1) {
                return redirect('/dashboard');
            }

            return redirect('/home/all-files');
        }

        return back()->withErrors(['error' => 'Your provided credentials could not be verified']);
    }

    public function destroy()
    {

        auth()->logout();

        return redirect('/');
    }
}
