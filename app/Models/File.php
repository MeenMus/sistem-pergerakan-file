<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function appid()
    {
        return $this->hasMany(Application::class, 'id' ,'file_id');
    }

    public function filestatus()
    {
        return $this->belongsTo(FileStatus::class, 'file_status', 'id');
    }

    public function center()
    {
        return $this->belongsTo(CentersFile::class, 'id', 'id');
    }

    public function archive()
    {
        return $this->belongsTo(ArchiveFile::class, 'id', 'file_id');
    }


}
