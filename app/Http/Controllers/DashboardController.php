<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\CentersFile;
use App\Models\Center;
use App\Models\File;
use App\Models\FileStatus;
use App\Models\ApplicationsHistory;
use App\Models\ArchiveFile;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $request = Application::where('status', '=', 'NEW')->get();
        $data['request'] = $request->count();

        $unreturned = Application::where('status', '=', 'CHECKED OUT')->get();
        $data['unreturned'] = $unreturned->count();

        $filenum = File::get();
        $data['filenum'] = $filenum->count();

        $archived = ArchiveFile::get();
        $data['archived'] = $archived->count();


        $applicants = Application::where('status', '=', 'NEW')->get();

        $app_request = Application::with('file', 'center.name')
            ->where('status', '=', 'NEW')
            ->orderBy('id', 'DESC')
            ->take(10)
            ->get();

        $app_unreturned = Application::with('file', 'center.name')
            ->where('status', '=', 'CHECKED OUT')
            ->orderBy('id', 'DESC')
            ->take(10)
            ->get();


        return view('dashboard', ['data' => $data], compact('app_request', 'app_unreturned'));
    }

    public function manual(){

        return view('manual');
    }
}
