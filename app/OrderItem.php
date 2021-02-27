<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_date',
        'note',
        'sub_total',
        'quotation',
        'invoice',
        'remarks',
        'claim',
        'order_id'
    ];
}
