<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
  protected $fillable = [
    'document_id',
    'order_id'
  ];

  public function documents()
  {
    return $this->hasMany('App\Http\Models\Document');
  }

  public function orders()
  {
    return $this->hasMany('App\Order');
  }
}
