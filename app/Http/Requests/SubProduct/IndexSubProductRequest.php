<?php

namespace App\Http\Requests\SubProduct;

use App\Models\SubProduct;
use App\Policies\SubProductPolicy;
use Illuminate\Foundation\Http\FormRequest;

class IndexSubProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->user()->can('List ChannelPartner'));
        return policy(SubProduct::class)->index($this->user());
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
