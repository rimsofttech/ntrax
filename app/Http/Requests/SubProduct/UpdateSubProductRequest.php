<?php

namespace App\Http\Requests\SubProduct;

use App\Models\SubProduct;
use App\Policies\SubProductPolicy;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->user()->can('List Zone'));
        return policy(SubProduct::class)->update($this->user());
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
            'name' => 'required|min:3|max:35|regex:/^([a-zA-Z\' ])*$/|unique:sub_products,name,'.$this->request->get("hidden_id"),
            'product_name'   => 'required|exists:products,id',
           
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('errors.SUBPRODUCT_102'),
            'name.min' => trans('errors.SUBPRODUCT_103'),
            'name.regex' => trans('errors.SUBPRODUCT_104'),
            'name.unique'  => trans('errors.SUBPRODUCT_101'),
            'product_name.exists' => trans('errors.SUBPRODUCT_105'),
        ];
    }

    public function forbiddenResponse()
    {
        // return response()->view('errors.403');
        // dd(1);
        return response()->json(['success' => 'Unsuccessfully updated.']);
    }
}
