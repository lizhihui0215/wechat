<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
          'username' => 'required|max:30|alpha|unique:users',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|min:8|confirmed',
        ];
    }

    // protected function formatErrors(Validator $validator)
    // {
    //     return $validator->errors()->all();
    // }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => '需要用户名',
            'email.required'  => '需要填写email',
        ];
    }
}
