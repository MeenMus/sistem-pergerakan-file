<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Center;
use App\Models\CentersFile;
use App\Models\Archive;
use App\Models\ArchiveFile;
use App\Models\UnarchiveFile;
use App\Models\ApplicationsHistory;
use App\Models\Application;
use App\Models\MovementFile;
use App\Models\Movement;




class FileController extends Controller
{

    public function viewarchivefile($code)
    {

        $archive_details = Archive::with('centerid')->where('id', '=', $code)->first();

        $archivefile = ArchiveFile::with('fileid')->where('archive_id', '=', $code)->get();

        return view('view-archive-file', compact('archivefile', 'archive_details'));
    }

    public function viewunarchivefile($code)
    {
        if ($code == 'all-files') {
            $files = UnarchiveFile::get();
            return view('view-unarchive-file', compact('files'));
        } else {
            $file_id = File::where('file_number', 'LIKE', $code . '-%')->get('id');
            $files = UnarchiveFile::whereIn('file_id', $file_id)->get();
            return view('view-unarchive-file', compact('files'));
        }
    }

    public function search()
    {

        $q = request('search');

        $files = File::where('file_number', 'LIKE', '%' . $q . '%')
            ->orWhere('existing_file_number', 'LIKE',  '%' . $q . '%')
            ->orWhere('student_name', 'LIKE',  '%' . $q . '%')
            ->orWhere('student_metric', 'LIKE', '%' . $q . '%')
            ->orWhere('student_ic', 'LIKE', '%' . $q . '%')->get();

        return view('search', compact('files'));
    }

    public function viewfilepage($id)
    {

        $file_number = File::where('id', '=', $id)->get();

        $new = Application::whereIn('file_id', array($id))->where('status', '=', 'NEW')->get();
        $checkedout = Application::whereIn('file_id', array($id))->where('status', '=', 'CHECKED OUT')->get();
        $cancel = Application::whereIn('file_id', array($id))->where('status', '=', 'NEW')->get();

        $archives = Archive::get();

        $apphistory = ApplicationsHistory::whereIn('file_id', array($id))->get();

        $movehistory = MovementFile::with('fileid')->where('file_id', '=', $id)->get();

        return view('file-page', compact('movehistory', 'apphistory', 'file_number', 'new', 'checkedout', 'cancel', 'archives'));
    }

    public function getfile($code)
    {

        if ($code == 'all-files') {
            $files = File::get();
            return view('delete-file', compact('files'));
        } else {
            $files = File::where('file_number', 'LIKE', $code . '-%')->get();
            return view('delete-file', compact('files'));
        }
    }



    public function deletefile($code)
    {
        $ids = request('id');

        if (empty($ids)) {
            session()->flash('fail');
            return redirect()->back();
        }

        foreach ($ids as $id) {

            Application::where('file_id', '=', $id)->delete();
            ArchiveFile::where('file_id', '=', $id)->delete();
            CentersFile::where('id', '=', $id)->delete();
            File::where('id', '=', $id)->delete();
            MovementFile::where('file_id', '=', $id)->delete();
            Movement::where('file_id', '=', $id)->delete();

        }

        session()->flash('deletedfile');
        return redirect()->back();
    }
}
