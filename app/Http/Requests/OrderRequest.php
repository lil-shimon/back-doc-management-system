<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   *
   * @return void
   */
  public function rules()
  {
    $rules = [
      'id' => 'integer',
      'order_info' => 'array',
      'order_item' => 'array',
      'attachment' => 'array',
      'contractedcompany' => 'array',
    ];
    return $rules;
  }

  /**
   *
   * @return void
   */
  public function attributes()
  {
    return [
      'id' => 'order id',
    ];
  }
}
