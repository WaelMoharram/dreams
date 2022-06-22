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
            "id_image"     => 'required|image',
            "email"                 => 'nullable|email|unique:users,email',
            "mobile"                => 'required|numeric|unique:users,mobile',
            "image"                 => 'nullable|image',
            "city_id"               => 'required|integer',
            "account_type"               => 'nullable|string',
            "transportation_services"    => 'nullable|bool',
            "rent_services"             => 'nullable|bool',
            "sell_services"             => 'nullable|bool',
        ];
    }
}
