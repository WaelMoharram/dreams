<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name'                  => 'required|unique:stores,name',
            "email"                 => 'nullable|email|unique:stores,email',
            "mobile"                => 'required|numeric|unique:stores,mobile',
            "commercial_register"   => 'required|unique:stores,commercial_register',
            "percent"               => 'required|numeric|min:4|max:100',
            "city_id"               => 'required|integer',
        ];
    }
}
