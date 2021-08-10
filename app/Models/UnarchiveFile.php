<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnarchiveFile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function fileid()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function archiveid()
    {
        return $this->belongsTo(Archive::class, 'archive_id', 'id');
    }
}
