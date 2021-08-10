<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;

class CenterController extends Controller
{
    public function create()
    {

        return view('create-center');
    }

    public function store()
    {
        $attributes = array(
            ('code') => request('code'),
            ('name') => request('name'),
        );
        Center::create($attributes);
        session()->flash('centercreated');
        return redirect('/create-center');
    }
}
