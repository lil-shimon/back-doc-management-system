<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'file_path',
        'file_path_two',
        'file_path_three',
        'order_id'
    ];
}
