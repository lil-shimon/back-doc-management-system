<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostageList extends Model
{
    use SoftDeletes;

    protected $table = 'postages_list';
}
