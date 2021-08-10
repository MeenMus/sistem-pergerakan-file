<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function center()
    {
        return $this->belongsTo(CentersFile::class, 'file_id', 'id');
    }
}
