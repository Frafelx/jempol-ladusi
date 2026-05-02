<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $connection = 'mysql_jempolladusi';
    protected $table      = 'users';
    public    $timestamps = false;

    protected $fillable = [
        'name',
        'password',
        'nama',
    ];

    protected $hidden = ['password'];
}
