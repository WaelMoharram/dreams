<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'name.en' => 'required|string|regex:/^[a-zA-Z ]+$/u',
            'name.ar' => 'required|string|regex:/^[\x{0600}-\x{06FF} ]+$/u',
            //^[\u0621-\u064A0-9 ]+$ OR ^[\u0621-\u064A\u0660-\u0669 ]+$ To accept numbers too
        ];
    }

    public function attributes()
    {
        return [
            'name.ar' => __('Name in Arabic'),
            'name.en' => __('Name in English'),
        ];
    }
}
