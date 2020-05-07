<?php

namespace App\Http\Requests\Zone;

use App\Models\Zone;
use App\Policies\ZonePolicy;
use Illuminate\Foundation\Http\FormRequest;

class StoreZoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->user()->can('List Zone'));
        return policy(Zone::class)->create($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'zonename' => 'required|min:3|max:35|unique:zones,zonename|regex:/^([a-zA-Z\' ])*$/',
            'country' =>  'required|required_with:state,city|exists:countries,id',
            'state' =>  'required|required_with:country,city|exists:states,id',
            'city' =>  'required|required_with:country,state|exists:cities,id',
        ];
    }

    public function messages()
    {
        return [
            'zonename.required' => trans('errors.ZONE_101'),
            'zonename.min' => trans('errors.ZONE_102'),
            'zonename.regex' => trans('errors.ZONE_103'),
            'zone.unique'  => trans('errors.ZONE_104'),
        ];
    }

    public function forbiddenResponse()
    {
        return response()->view('errors.403');
        // dd(1);
        // return response()->json(['success' => 'Unsuccessfully updated.']);
    }
}
