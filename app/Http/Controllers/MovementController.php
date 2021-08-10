<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Movement;
use App\Models\MovementFile;
use App\Models\CentersFile;

class MovementController extends Controller
{
    public function create($code)
    {
        $files = File::where('file_number', 'LIKE', $code . '-%')->get();
        return view('move-file', compact('files'));
    }

    public function moveFiles($code)
    {

        $ids = request('id');

        if (empty($ids)) {
            session()->flash('fail');
            return redirect()->back();
        }

        foreach ($ids as $id) {

            $attributes = array(
                ('file_id') => $id,
                ('originalcenter') => $code,
                ('newcenter') => request('center_id'),
                ('purpose') => request('purpose'),
                ('receivedat') => now(),
            );

            Movement::create($attributes);

            $filenum = request('center_id'). "-" . date("Y") . "-" . $id;

            $attributes2 = array(
                ('file_id') => $id,
                ('original_filenumber') => File::where('id','=',$id)->pluck('file_number')->first(),
                ('new_filenumber') => $filenum,
            );

            MovementFile::create($attributes2);

            File::where('id', '=', $id)->update(['file_number' => $filenum]);

            CentersFile::where('id', '=', $id)->update(['code' => request('center_id')]);

        }
        session()->flash('movedfile');
        return redirect()->back();
    }

}
