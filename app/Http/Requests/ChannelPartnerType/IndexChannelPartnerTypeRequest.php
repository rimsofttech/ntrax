<?php

namespace App\Http\Requests\ChannelPartnerType;

use App\Models\ChannelPartnerType;
use App\Policies\ChannelPartnerTypePolicy;
use Illuminate\Foundation\Http\FormRequest;

class IndexChannelPartnerTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->user()->can('List Zone'));
        return policy(ChannelPartnerType::class)->index($this->user());
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
