<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $user = $this->route()->parameter('user');
        $httpMethod = $this->route()->getActionMethod();

        $rules = [
            'id' => 'integer',
            'name' => 'required',
            // 'email' => [
            //     'required',
            //     'email',
            //     Rule::unique('users', 'email')
            //         ->ignore($user->id ?? null),
            // ],
            'email' => 'required',
        ];

        if ($httpMethod === 'store') {
            $rules['password'] = 'required';
        }


        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'ユーザー名',
        ];
    }
}
