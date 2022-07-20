<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'password'              => 'required|confirmed|min:8',
            "name"            => 'required|string',
            "email"                 => 'nullable|email|unique:users,email',
            "mobile"                => 'required|numeric|unique:users,mobile',
            "image"                 => 'nullable|image',
            "country_id" =>'required|integer',
            "city_id" =>'required|integer',
            "birthdate" =>'required|date',
            "job" =>'required|string',
            "gender" =>'required|boolean',



        ];
    }
}
