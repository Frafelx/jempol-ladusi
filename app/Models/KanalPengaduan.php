<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KanalPengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kanal_aduan',
        'link', // <-- INI TAMBAHANNYA
        'username',
        'password',
    ];
}