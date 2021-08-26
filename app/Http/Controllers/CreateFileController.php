<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\FileStatus;
use App\Models\Center;
use App\Models\CentersFile;
use App\Imports\FilesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


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

    public function import() 
    {
        Excel::import(new FilesImport, request()->file('student_files'));

        $files = File::whereNull('file_number')->pluck('id');
        $year = date("Y");
        $code = request('code');
        
        foreach($files as $file){

            $filenum = $code . "-" . $year . "-" . $file;

            File::where('id' ,'=', $file)
            ->update([
                'file_number' =>  $filenum,
            ]);
            
            $centerfile = array(
                ('id') => ($file),
                ('code') => ($code),
            );
    
            CentersFile::create($centerfile);
            
        }

        File::whereNull('existing_file_number')->update(['existing_file_number' =>  'NONE',]);

        session()->flash('fileimported');
        return redirect('/create-file');
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
