<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\CentersFile;
use App\Models\File;

class CenterController extends Controller
{
    public function create()
    {
        Center::get();
        return view('centercontrol');
    }

    public function store()
    {
        if (Center::whereIn('code', array(request('code')))->exists()) {
            session()->flash('dupcenter');
            return redirect()->back();
        }

        if (Center::whereIn('name', array(request('name')))->exists()) {
            session()->flash('dupcenter');
            return redirect()->back();
        }

        $attributes = array(
            ('code') => request('code'),
            ('name') => request('name'),
        );
        Center::create($attributes);
        session()->flash('centercreated');
        return redirect('/centercontrol');
    }

    public function deletecenter()
    {
        $code = request('code');

        if (CentersFile::where('code', '=', $code)->exists()) {
            session()->flash('errorcenter');
            return redirect()->back();
        }

        Center::where('code', '=', $code)->delete();

        session()->flash('centerdeleted');
        return redirect()->back();
    }

    public function editcenter()
    {
        $code = request('code');
        $ids =  CentersFile::where('code', '=', $code)->pluck('id');

        if (Center::whereIn('code', array(request('edit_code')))->exists()) {
            session()->flash('dupcenter');
            return redirect()->back();
        }

        if (Center::whereIn('name', array(request('edit_name')))->exists()) {
            session()->flash('dupcenter');
            return redirect()->back();
        }

        foreach ($ids as $id) {

            $date = File::where('id', '=', $id)->pluck('created_at');
            $getdate = substr($date, 2, 4);

            $filenum = request('edit_code') . "-" . $getdate . "-" . $id;

            File::where('id', '=', $id)->update(['file_number' => $filenum]);

            CentersFile::where('id', '=', $id)->update(['code' => request('edit_code')]);
        }

        Center::where('code', '=', $code)->update(['code' => request('edit_code'), 'name' => request('edit_name')]);
        session()->flash('centeredited');
        return redirect()->back();
    }
}
