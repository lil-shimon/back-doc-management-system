<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'date',
        'title',
        'address',
        'note',
        'working_hours',
        'count'
    ];
}
