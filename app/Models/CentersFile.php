<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentersFile extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;


    public function name()
    {
        return $this->belongsTo(Center::class, 'code', 'code');
    }
}
