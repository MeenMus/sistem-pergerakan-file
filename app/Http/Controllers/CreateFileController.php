<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\FileStatus;
use App\Models\Center;
use App\Models\CentersFile;


class CreateFileController extends Controller
{
    public function create()
    {
        $centers = Center::all(['code', 'name']);
        return view('create-file', compact('centers'));
    }

    public function store(Request $request)
    {
        $code = request('code');
        $year = date("Y");
        $id = File::count() + 1;
        $filenum = $code . "-" . $year . "-" . $id;
        $existingfile = request('existing_file_number');

        if (empty($existingfile)) {
            $existingfile = 'NONE';
        }

        $attributes = array(
            ('student_name') => request('student_name'),
            ('student_metric') => request('student_metric'),
            ('student_ic') => request('student_ic'),
            ('existing_file_number') => ($existingfile),
            ('file_number') => ($filenum),
            ('file_status') => (1),
        );

        File::create($attributes);

        $centerfile = array(
            ('code') => ($code),
        );

        CentersFile::create($centerfile);

        session()->flash('filecreated');

        return redirect("/create-file")->with('filenum', $filenum);
    }


    public function getfile($id){

        $file = File::where('id','=',$id)->get()->first();

        return view('edit-file', compact('file'));

    }


    public function editfile($id){

        File::where('id' ,'=', $id)
        ->update([
            'existing_file_number' => request('existing_file_number'),
            'student_name' => request('student_name'),
            'student_metric' => request('student_metric'),
            'student_ic' => request('student_ic'),
        ]);     

        session()->flash('editfile');
        return redirect("/file-page/$id");

    }

}
