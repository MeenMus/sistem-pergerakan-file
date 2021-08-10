<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\CentersFile;
use App\Models\Center;
use App\Models\File;
use App\Models\FileStatus;
use App\Models\ApplicationsHistory;

class ApplicationController extends Controller
{

    public function request($code)
    {

        if ($code == 'all-files') {
            $files = Application::where('status', '=', 'NEW')
                ->select('applicant_id', 'applicant_name', 'email', Application::raw('count(*) as total'))
                ->groupBy('applicant_id', 'applicant_name', 'email')
                ->get();
            return view('manage-request', compact('files'));
        } else {
            $codeid = CentersFile::where('code', $code)->pluck('id')->toArray();
            $files = Application::where('status', '=', 'NEW')
                ->whereIn('file_id', $codeid)
                ->select('applicant_id', 'applicant_name', 'email', Application::raw('count(*) as total'))
                ->groupBy('applicant_id', 'applicant_name', 'email')
                ->get();
            return view('manage-request', compact('files'));
        }
    }

    public function getrequestfiles($code, $applicant_id)
    {

        $applicant_details = Application::where('applicant_id', '=', $applicant_id)->first();

        if ($code == 'all-files') {
            $applicant_id = Application::with('file')
                ->where('status', '=', 'NEW')
                ->where('applicant_id', '=', $applicant_id)
                ->get();
            return view('manage-checkout', compact('applicant_id', 'applicant_details'));
        } else {
            $codeid = CentersFile::where('code', $code)->pluck('id')->toArray();
            $applicant_id = Application::with('file')
                ->where('status', '=', 'NEW')
                ->where('applicant_id', '=', $applicant_id)
                ->whereIn('file_id', $codeid)->get();
            return view('manage-checkout', compact('applicant_id', 'applicant_details'));
        }
    }

    public function checkout($code)
    {

        $ids = request('id');
        $value = request('value');
        $value2 = request('value2');

        if (empty($ids)) {
            session()->flash('fail');
            return redirect()->back();
        }

        if ($value == 1) {
            foreach ($ids as $id) {

                $getID[] = Application::whereIn('id', array($id))->pluck('file_id');

                Application::whereIn('id', array($id))
                    ->update(['status' => 'CHECKED OUT']);

                $file_id = Application::whereIn('id', array($id))->first()
                    ->replicate([
                        'return_date',
                    ])
                    ->fill([
                        'status' => 'CHECKED OUT'
                    ])->toArray();
                ApplicationsHistory::create($file_id);
            }

            File::whereIn('id', $getID)->update(['file_status' => 2]);

        }

        if ($value != 1) {
            foreach ($ids as $id) {
                Application::whereIn('id', array($id))
                    ->update(['status' => 'CANCELED']);
            }
            if ($value2 == "1") {
                session()->flash('cancel');
                return redirect()->back();
            } else {
                session()->flash('cancel');
                return redirect("/manage-request/$code");
            }
        }

        if ($value2 == "1") {
            session()->flash('checkout');
            return redirect()->back();
        } else {
            session()->flash('checkout');
            return redirect("/manage-request/$code");
        }
    }

    public function unreturned($code)
    {

        if ($code == 'all-files') {
            $files = Application::where('status', '=', 'CHECKED OUT')
                ->select('applicant_id', 'applicant_name', 'email', Application::raw('count(*) as total'))
                ->groupBy('applicant_id', 'applicant_name', 'email')
                ->get();
            return view('manage-unreturned', compact('files'));
        } else {
            $codeid = CentersFile::where('code', $code)->pluck('id')->toArray();
            $files = Application::where('status', '=', 'CHECKED OUT')
                ->whereIn('file_id', $codeid)
                ->select('applicant_id', 'applicant_name', 'email', Application::raw('count(*) as total'))
                ->groupBy('applicant_id', 'applicant_name', 'email')
                ->get();
            return view('manage-unreturned', compact('files'));
        }
    }

    public function getunreturnedfiles($code, $applicant_id)
    {

        $applicant_details = Application::where('applicant_id', '=', $applicant_id)->first();

        if ($code == 'all-files') {
            $applicant_id = Application::with('file')
                ->where('status', '=', 'CHECKED OUT')
                ->where('applicant_id', '=', $applicant_id)
                ->get();
            return view('manage-checkin', compact('applicant_id', 'applicant_details'));
        } else {
            $codeid = CentersFile::where('code', $code)->pluck('id')->toArray();
            $applicant_id = Application::with('file')
                ->where('status', '=', 'CHECKED OUT')
                ->where('applicant_id', '=', $applicant_id)
                ->whereIn('file_id', $codeid)->get();
            return view('manage-checkin', compact('applicant_id', 'applicant_details'));
        }
    }

    public function checkin($code)
    {

        $ids = request('id');
        $value = request('value');

        if (empty($ids)) {
            session()->flash('fail');
            return redirect()->back();
        }

        foreach ($ids as $id) {

            $getID[] = Application::whereIn('id', array($id))->pluck('file_id');

            Application::whereIn('id', array($id))
                ->update(['status' => 'CHECKED IN']);

            $file_id = Application::whereIn('id', array($id))->first()
                ->replicate([
                    'return_date',
                ])
                ->fill([
                    'status' => 'CHECKED IN'
                ])->toArray();
            ApplicationsHistory::create($file_id);
        }

        File::whereIn('id', $getID)->update(['file_status' => 1]);

        if($value == 1){
            session()->flash('checkin');
            return redirect()->back();
        }
        else{
            session()->flash('checkin');
            return redirect("/manage-unreturned/$code");
        }


    }

    public function movementlog($code)
    {

        $centers = Center::all(['code', 'name']);

        if ($code == 'all-files') {
            $files = ApplicationsHistory::with('file')->get();
            return view('applications-log', compact('files', 'centers'));
        } else {
            $id = File::where('file_number', 'LIKE', $code . '-%')->get('id');
            $files = ApplicationsHistory::with('file')->whereIn('file_id', $id)->get();
            return view('applications-log', compact('files', 'centers'));
        }
    }
}
