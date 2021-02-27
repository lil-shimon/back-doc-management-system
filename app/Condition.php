<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
  protected $fillable = [
    'name'
  ];

  /**
   *
   * orders 
   *
   * @return hasMany
   */
  public function orders()
  {
    return $this->hasMany('App\Order');
  }
}
