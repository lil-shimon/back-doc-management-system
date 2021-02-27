<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyLogoRequest extends FormRequest
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
            'editItem' => 'array',
            'img_path' => 'string',
            'data' => ['title' => 'string', 'file' => 'image'],
            'id' => 'integer'
        ];
    }

    public function attributes()
    {
        return [
            'editItem' => '会社ロゴの追加情報',
            'img_path' => '写真のファイル名',
            'data' => '画像',
            'id' => '書類ID'
        ];
    }
}
