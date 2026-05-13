<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUpLog extends Model
{
    protected $primaryKey = 'hash_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['hash_id'];
}