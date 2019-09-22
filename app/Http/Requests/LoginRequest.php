<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username' => 'required',
            'password' => 'required|min:8|max:16',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'username is required',
            'password.required' => 'password is required',
            'password.min' => 'password length must between 8-16 character',
        ];
    }
}
