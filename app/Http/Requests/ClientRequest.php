<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'password' => 'nullable|required_without:_method|confirmed',
            "name"            => 'required|string',
            "id_image"     => 'nullable|required_without:_method|image',
            "email"                 => 'nullable|unique:users,email,'.$this->client,
            "mobile"                => 'required|digits_between:10,12|numeric|regex:/(5)[0-9]/|unique:users,mobile,'.$this->client, //ksa mobile
            "image"                 => 'nullable|required_without:_method|image',
            "city_id"               => 'required|integer',
        ];


    }

    public function attributes()
    {
        return [
            'name' => __('Name'),
            'email' => __('Email'),
            'password' => __('Password'),
            "id_image"     => __('ID image'),
            "mobile"                => __('Mobile'),
            "image"                 => __('Image'),
            "city_id"               => __('City'),
        ];
    }
}
