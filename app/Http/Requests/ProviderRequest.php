<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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
            "email"                 => 'nullable|email|unique:users,email,'.$this->provider,
            "mobile"                => 'required|numeric|unique:users,mobile,'.$this->provider,
            "image"                 => 'nullable|required_without:_method|image',
            "city_id"               => 'required|integer',
            "bank_name"               => 'required|string',
            "bank_account_number"    => 'required|string',
            "bank_iban"             => 'required|string',
            "transportation_services"   => 'required|boolean',
            "rent_services"   => 'required|boolean',
            "sell_services"   => 'required|boolean',
            "driving_license_image"   => 'nullable|image',
            "working_license_image"   => 'nullable|image',
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
            "bank_name"               => __('Bank name'),
            "bank_account_number"    => __('Account number'),
            "bank_iban"             => __('IBAN'),
            "transportation_services"   => __('Transportation services'),
            "rent_services"   => __('Rent services'),
            "sell_services"   => __('Sell services'),
            "driving_license_image"   => __('Driving license image'),
            "working_license_image"   => __('Working license image'),
        ];
    }
}
