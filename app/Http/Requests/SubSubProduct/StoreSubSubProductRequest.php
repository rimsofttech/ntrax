<?php

namespace App\Http\Requests\SubSubProduct;

use App\Models\SubSubProduct;
use App\Policies\SubSubProductPolicy;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubSubProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->user()->can('List Zone'));
        return policy(SubSubProduct::class)->create($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'name'    =>  'required|min:3|max:35|unique:sub_sub_products,name|regex:/^([a-zA-Z\' ])*$/',
        'subproduct_name'   => 'required|exists:sub_products,id',
        'rate'    =>  'required|min:3|max:35|numeric',
        'margin'    =>  'required|min:3|max:35|numeric',
        'discount'    =>  'required|min:3|max:35|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('errors.SUBSUBPRODUCT_102'),
            'name.min' => trans('errors.SUBSUBPRODUCT_103'),
            'name.regex' => trans('errors.SUBSUBPRODUCT_104'),
            'name.unique'  => trans('errors.SUBSUBPRODUCT_101'),
            'subproduct_name.exists' => trans('errors.SUBSUBPRODUCT_105'),
            'subproduct_name.required' => trans('errors.SUBSUBPRODUCT_106'),
            'rate.required' => trans('errors.SUBSUBPRODUCT_107'),
            'rate.min' => trans('errors.SUBSUBPRODUCT_108'),
            'rate.regex' => trans('errors.SUBSUBPRODUCT_109'),
            'margin.required' => trans('errors.SUBSUBPRODUCT_110'),
            'margin.min' => trans('errors.SUBSUBPRODUCT_111'),
            'margin.regex' => trans('errors.SUBSUBPRODUCT_112'),
            'discount.required' => trans('errors.SUBSUBPRODUCT_113'),
            'discount.min' => trans('errors.SUBSUBPRODUCT_114'),
            'discount.regex' => trans('errors.SUBSUBPRODUCT_115'),
            'rate.numeric' => trans('errors.SUBSUBPRODUCT_116'),
            'margin.numeric' => trans('errors.SUBSUBPRODUCT_117'),
            'discount.numeric' => trans('errors.SUBSUBPRODUCT_118'),
        ];
           
    }

    public function forbiddenResponse()
    {
        return response()->view('errors.403');
        // dd(1);
        // return response()->json(['success' => 'Unsuccessfully updated.']);
    }
}
