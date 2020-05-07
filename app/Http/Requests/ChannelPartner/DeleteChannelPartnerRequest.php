<?php

namespace App\Http\Requests\ChannelPartner;

use App\Models\ChannelPartner;
use App\Policies\ChannelPartnerPolicy;
use Illuminate\Foundation\Http\FormRequest;

class DeleteChannelPartnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->user()->can('Delete Zone'));
        return policy(ChannelPartner::class)->delete($this->user());
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
        // dd(1);
        // return response()->json(['success' => 'Unsuccessfully updated.']);
    }
}
