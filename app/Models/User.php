<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function roleid()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
