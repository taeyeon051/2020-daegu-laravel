<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'user_id', 'user_name', 'writer', 'mdate', 'mtime', 'content', 'state'];
}
