<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentRequest extends FormRequest
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

        $rules = [
            'show_doc_type_id' => 'integer',
            'select_items' => 'array',
            'id' => 'integer',
            'doc_info' => 'array',
            'product_item' => 'array',
            'postage_item' => 'array',
            'doc_type' => 'integer',
            'remarks' => 'string|nullable',
            'status' => 'integer',
            'is_show_trash' => 'integer'
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'show_doc_type_id' => '表示する書類の種類',
            'select_items' => '絞り込み条件',
            'id' => '書類ID',
            'doc_info' => '書類の情報',
            'product_item' => '商品',
            'postage_item' => '送料',
            'doc_type' => '書類の種類',
            'remarks' => '備考',
            'status' => 'ステータス',
            'is_show_trash' => 'ゴミ箱表示'
        ];
    }
}
