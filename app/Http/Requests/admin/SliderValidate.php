<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderValidate extends FormRequest
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
            'image'=>'required',
            'text'=>'required',
            'description'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'image.required'=>'Please Upload Image',
            'text.required'=>'Please Enter Title',
            'description.required'=>'Please Enter Description',
        ];
    }
}
