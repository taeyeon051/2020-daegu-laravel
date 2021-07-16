<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    public $timestamps = false;
    protected $fillable = ['book_name', 'book_image', 'writer_name', 'target', 'create_date', 'meeting_week', 'meeting_time'];
}
