<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostageRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'editItem' => 'array'
        ];
    }

    public function attributes()
    {
        return [
            'editItem' => '送料の追加情報'
        ];
    }
}
