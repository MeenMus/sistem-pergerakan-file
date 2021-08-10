<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementFile extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function fileid()
    {
        return $this->belongsTo(Movement::class, 'id', 'id');
    }
}
