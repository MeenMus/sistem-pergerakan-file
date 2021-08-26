<?php

namespace App\Imports;

use App\Models\File;
use App\Models\CentersFile;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FilesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new File([
            'existing_file_number'     => $row['existing_file_number'],
            'student_name'     => $row['student_name'],
            'student_metric'     => $row['student_metric'],
            'student_ic'     => $row['student_ic'],
            'file_status'     => $row['file_status'],
        ]);

    }
}
