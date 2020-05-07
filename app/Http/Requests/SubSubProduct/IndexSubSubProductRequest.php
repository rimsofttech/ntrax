<?php

namespace App\Http\Requests\SubSubProduct;

use App\Models\SubSubProduct;
use App\Policies\SubSubProductPolicy;
use Illuminate\Foundation\Http\FormRequest;

class IndexSubSubProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->user()->can('List ChannelPartner'));
        return policy(SubSubProduct::class)->index($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function forbiddenResponse()
    {
        return response()->view('errors.403');
    }
}
