<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Archive;
use App\Models\ArchiveFile;
use App\Models\UnarchiveFile;


class ArchiveController extends Controller
{
    public function create($code)
    {

        $files = File::where('file_number', 'LIKE', $code . '-%')->where('file_status', '!=', 3)->get();
        $archives = Archive::get();
        return view('archive-file', compact('files', 'archives'));
    }

    public function archiveFiles($code)
    {
        $archive_number = request('archive_id');
        $ids = request('id');

        if (empty($ids)) {
            session()->flash('fail');
            return redirect()->back();
        }

        if (empty($archive_number)) {

            $files = File::where('file_number', 'LIKE', $code . '-%')->get();

            $attributes = array(
                ('archive_number') => Archive::count() + 1,
                ('center_id') => $code,
            );

            Archive::create($attributes);

            foreach ($ids as $id) {

                $attributes = array(
                    ('archive_id') => Archive::latest()->pluck('id')->first(),
                    ('file_id') => $id,
                );

                File::whereIn('id', array($id))
                    ->update(['file_status' => 3]);

                ArchiveFile::create($attributes);
            }

            $archive_number = Archive::latest()->pluck('archive_number')->first();
            session()->flash('filearchive');
            return redirect()->back()->with('archive_number', $archive_number);
        }

        if (!(Archive::where('id', '=', $archive_number)->exists())) {

            $files = File::where('file_number', 'LIKE', $code . '-%')->get();

            $attributes = array(
                ('archive_number') => $archive_number,
                ('center_id') => $code,
            );

            Archive::create($attributes);

            foreach ($ids as $id) {

                $attributes = array(
                    ('archive_id') => Archive::latest()->pluck('id')->first(),
                    ('file_id') => $id,
                );

                File::whereIn('id', array($id))
                    ->update(['file_status' => 3]);

                ArchiveFile::create($attributes);
            }

            session()->flash('filearchive');
            return redirect()->back()->with('archive_number', $archive_number);
        }

        $archive_id = Archive::where('id', '=', $archive_number)->first()->id;

        if (Archive::where('id', '=', $archive_id)->exists()) {

            $archive_number = Archive::where('id', '=', request('archive_id'))->pluck('archive_number')->first();

            foreach ($ids as $id) {

                $attributes = array(
                    ('archive_id') => $archive_id,
                    ('file_id') => $id,
                );

                File::whereIn('id', array($id))
                    ->update(['file_status' => 3]);

                ArchiveFile::create($attributes);
            }

            session()->flash('filearchive');
            return redirect()->back()->with('archive_number', $archive_number);
        }
    }

    public function create2($code)
    {
        if ($code == 'all-files') {

            $files = File::where('file_status', '=', 3)->pluck('id');
            $archivefile = ArchiveFile::with('fileid', 'archiveid')->whereIn('file_id', $files)->get();
            return view('unarchive-file', compact('archivefile'));
        } else {

            $files = File::where('file_number', 'LIKE', $code . '-%')->where('file_status', '=', 3)->pluck('id');
            $archivefile = ArchiveFile::with('fileid', 'archiveid')->whereIn('file_id', $files)->get();
            return view('unarchive-file', compact('archivefile'));
        }
    }

    public function unarchiveFiles($code)
    {

        $ids = request('id');

        if (empty($ids)) {
            session()->flash('fail');
            return redirect()->back();
        }

        foreach ($ids as $id) {

            $archive_id = ArchiveFile::where('file_id','=',$id)->pluck('archive_id')->first();

            ArchiveFile::where('file_id', '=', $id)->delete();

            File::whereIn('id', array($id))
                ->update(['file_status' => 1]);

            $attributes = array(
                ('file_id') => $id,
                ('archive_id') => $archive_id,
                ('purpose') =>  request('purpose'),
            );
            UnarchiveFile::create($attributes);
        }
        
        session()->flash('fileunarchive');
        return redirect()->back();
    }

    public function editarchive($code){

        Archive::where('id', '=', $code)->update(['archive_number' => request('archive_number')]);

        session()->flash('editarchive');
        return redirect()->back();

    }
}
