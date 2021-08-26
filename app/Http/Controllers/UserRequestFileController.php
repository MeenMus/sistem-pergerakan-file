<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Application;
use App\Models\Center;
use Illuminate\Http\Request;

class UserRequestFileController extends Controller
{

    public function userfile($code)
    {

        $centers = Center::all(['code', 'name']);

        if ($code == 'all-files') {

            $files = Application::with('file')->where('applicant_id', '=', auth()->user()->staff_id)->get();
            return view('home', compact('files', 'centers'));
        } else {

            $id = File::where('file_number', 'LIKE', $code . '-%')->get('id');
            $files = Application::with('file')->whereIn('file_id', $id)->where('applicant_id', '=', auth()->user()->staff_id)->get();
            return view('home', compact('files', 'centers'));
        }
    }


    public function viewfile($code)
    {

        $centers = Center::all(['code', 'name']);

        if ($code == 'all-files') {
            $files = File::get();
            return view('request-file', compact('files', 'centers'));
        } else {
            $files = File::where('file_number', 'LIKE', $code . '-%')->get();
            return view('request-file', compact('files', 'centers'));
        }
    }

    public function store(Request $request)
    {
        $ids = $request->input('id');

        if (empty($ids)) {
            session()->flash('fail');
            return redirect()->back();
        }

        foreach ($ids as $id) {
            $attributes = array(
                ('applicant_id') => auth()->user()->staff_id,
                ('applicant_name') => auth()->user()->name,
                ('email') => auth()->user()->email,
                ('file_id') => ($id),
                ('return_date') => request('date'),
                ('purpose') => request('purpose'),
                ('status') => ('NEW'),
            );
            Application::create($attributes);

            File::where('id','=', $id)->update(['file_status' => 4]);

        }
        session()->flash('success');
        return redirect('/request-file/all-files');
    }
}
