<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->user()->can('List Zone'));
        return policy(Product::class)->update($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($this->zone);
        return [
            'name' => 'required|min:3|max:35|regex:/^([a-zA-Z\' ])*$/|unique:products,name,'.$this->request->get("hidden_id"),
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
        // return response()->view('errors.403');
        // dd(1);
        return response()->json(['success' => 'Unsuccessfully updated.']);
    }
}
