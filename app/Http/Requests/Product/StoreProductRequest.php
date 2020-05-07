<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->user()->can('List Zone'));
        return policy(Product::class)->create($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    =>  'required|min:3|max:35|unique:products,name|regex:/^([a-zA-Z\' ])*$/',
        
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('errors.PRODUCT_102'),
            'name.min' => trans('errors.PRODUCT_103'),
            'name.regex' => trans('errors.PRODUCT_104'),
            'name.unique'  => trans('errors.PRODUCT_101'),
        ];
           
    }

    public function forbiddenResponse()
    {
        return response()->view('errors.403');
        // dd(1);
        // return response()->json(['success' => 'Unsuccessfully updated.']);
    }
}
