<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalInvoice extends Model
{
  protected $fillable = [
    'name'
  ];

  /**
   * order
   *
   * @return hasMany
   */
  public function orders()
  {
    return $this->hasMany('App\Order');
  }
}
