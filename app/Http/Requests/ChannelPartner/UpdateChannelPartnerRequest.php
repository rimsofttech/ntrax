<?php

namespace App\Http\Requests\ChannelPartner;

use App\Models\ChannelPartner;
use App\Policies\ChannelPartnerPolicy;
use Illuminate\Foundation\Http\FormRequest;

class UpdateChannelPartnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->user()->can('List Zone'));
        return policy(ChannelPartner::class)->update($this->user());
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
            'name' => 'required|min:3|max:35|regex:/^([a-zA-Z\' ])*$/|unique:channel_partners,name,'.$this->request->get("hidden_id"),
            'companyname' =>  'required|min:3|max:35|regex:/^([a-zA-Z\' ])*$/',
            'email'       =>  'required|email',
            'additionalemail' => 'required|email',
            'phone'  => 'required|numeric|regex:/^[1-9][0-9]{6,14}/|min:7',
            'additionalphone' => 'required|numeric|regex:/^[1-9][0-9]{6,14}/',
            'commissionpercentage' => 'required|numeric',
            'channelpartnertype'   => 'required|exists:channel_partner_types,id',
           
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('errors.CHANNELPARTNER_102'),
            'name.min' => trans('errors.CHANNELPARTNER_103'),
            'name.regex' => trans('errors.CHANNELPARTNER_104'),
            'name.unique'  => trans('errors.CHANNELPARTNER_101'),
            'companyname.required' => trans('errors.CHANNELPARTNER_105'),
            'companyname.min' => trans('errors.CHANNELPARTNER_106'),
            'companyname.regex' => trans('errors.CHANNELPARTNER_107'),
            'email.required' => trans('errors.CHANNELPARTNER_108'),
            'additionalemail.required' => trans('errors.CHANNELPARTNER_109'),
            'phone.required' => trans('errors.CHANNELPARTNER_110'),
            'additionalphone.required' => trans('errors.CHANNELPARTNER_111'),
            'commissionpercentage.required' => trans('errors.CHANNELPARTNER_112'),
            'channelpartnertype.required' => trans('errors.CHANNELPARTNER_113'),
            'phone.numeric' => trans('errors.CHANNELPARTNER_114'),
            'phone.regex' => trans('errors.CHANNELPARTNER_115'),
            'channelpartnertype.exists' => trans('errors.CHANNELPARTNER_116'),
        ];
    }

    public function forbiddenResponse()
    {
        // return response()->view('errors.403');
        // dd(1);
        return response()->json(['success' => 'Unsuccessfully updated.']);
    }
}
