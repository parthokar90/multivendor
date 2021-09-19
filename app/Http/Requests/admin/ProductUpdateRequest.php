<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'product_name'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
            'brand_id'=>'required',
            'shop_id'=>'required',
            'category_id'=>'required',
            
        ];
    }

    public function messages()
    {
        return [
            'product_name.required'=>'Please Enter Product Name',
            'short_description.required'=>'Please Enter Short Description',
            'long_description.required'=>'Please Enter Long Description',
            'brand_id.required'=>'Please Select Brand',
            'shop_id.required'=>'Please Select Shop',
            'category_id.required'=>'Please Select Category',
        ];
    }
}
