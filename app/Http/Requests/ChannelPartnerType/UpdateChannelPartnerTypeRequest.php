<?php

namespace App\Http\Requests\ChannelPartnerType;

use App\Models\ChannelPartnerType;
use App\Policies\ChannelPartnerTypePolicy;
use Illuminate\Foundation\Http\FormRequest;

class UpdateChannelPartnerTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->user()->can('List Zone'));
        return policy(ChannelPartnerType::class)->update($this->user());
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
            'name' => 'required|min:3|max:35|regex:/^([a-zA-Z\' ])*$/|unique:channel_partner_types,name,'.$this->request->get("hidden_id"),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('errors.CHANNELPARTNERTYPE_102'),
            'name.min' => trans('errors.CHANNELPARTNERTYPE_103'),
            'name.regex' => trans('errors.CHANNELPARTNERTYPE_104'),
            'name.unique'  => trans('errors.CHANNELPARTNERTYPE_101'),
        ];
    }

    public function forbiddenResponse()
    {
        // return response()->view('errors.403');
        // dd(1);
        return response()->json(['success' => 'Unsuccessfully updated.']);
    }
}
