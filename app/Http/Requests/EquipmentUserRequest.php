<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentUserRequest extends FormRequest
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
            'equipment_id'=>'required',
            'brand_id'=>'required',
            'name'=>'required',
            'note'=>'required',
            'image'=>'required|image',
            'for'=>'in:rent,transportation'
        ];
    }

    public function attributes()
    {
        return [
            'equipment_id' => __('Equipment'),
            'brand_id' => __('Brand'),
            'name' => __('Name'),
            'note' => __('Note'),
            'image' => __('Image'),
        ];
    }
}
