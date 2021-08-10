<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function centerid()
    {
        return $this->belongsTo(Center::class, 'center_id', 'code');
    }
}
