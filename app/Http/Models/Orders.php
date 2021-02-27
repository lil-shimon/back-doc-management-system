<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    protected $fillable = ['start_date', 'end_date', 'expected_start_date', 'expected_end_date', 'invoice_note', 'sale_note', 'maintainance_note', 'sim_number', 'signnage_id'];

    use SoftDeletes;

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }
}
