<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'editItem' => 'array|required',
            'img_path' => 'string'
        ];
    }

    public function attributes()
    {
        return [
            'editItem' => '追加する商品・送料等の情報',
            'img_path' => '画像のファイル名'
        ];
    }
}
