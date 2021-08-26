<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

        if (auth()->attempt($attributes, $remember)) {

            if (auth()->user()->role_id == 3) {
                return redirect('/home/all-files');
            }
            return redirect('/dashboard');
        }

        return back()->withErrors(['error' => 'Your provided credentials could not be verified']);
    }

    public function create_reg()
    {
        return view('register');
    }

    public function store_reg()
    {

        $staffid = request('staff_id');
        $email = request('email');

        if (User::whereIn('staff_id', array($staffid))->exists()) {
            return back()->withErrors(['error' => 'Sorry! The email or staff ID provided exists!']);
        }

        if (User::whereIn('email', array($email))->exists()) {
            return back()->withErrors(['error' => 'Sorry! The email or staff ID provided exists!']);
        }

        $attributes = array(
            ('staff_id') => request('staff_id'),
            ('name') => request('name'),
            ('email') => request('email'),
            ('password') => Hash::make(request('password')),
            ('role_id') => (3),
        );

        User::create($attributes);

        return redirect('/')->with('success','Account created successfully! Sign in here');

    }


    public function destroy()
    {

        auth()->logout();

        return redirect('/');
    }
}
