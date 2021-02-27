<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductList extends Model
{
    use SoftDeletes;

    protected $table = 'products_list';
}
