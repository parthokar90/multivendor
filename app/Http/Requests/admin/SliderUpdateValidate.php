<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateValidate extends FormRequest
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
            'text'=>'required',
            'description'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'text.required'=>'Please Enter Title',
            'description.required'=>'Please Enter Description',
        ];
    }
}
