<?php

namespace App\Ntrax\Repositories\ChannelPartner;

use App\Models\ChannelPartner;
use App\Role;
use DataTables;

class ChannelPartnerRepository implements ChannelPartnerInterface
{
    private $channelpartner;

    public function __construct(ChannelPartner $channelpartner){
        $this->channelpartner = $channelpartner;
    }

    public function getallchannelpartnerdetails($request)
    {
        $data = $this->channelpartner::latest()->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->diffForHumans();
                })
                ->editColumn('updated_at', function ($data) {
                    return $data->updated_at->diffForHumans();
                })
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-outline-info btn-rounded waves-effect waves-light"><i class="mdi mdi-square-edit-outline"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-outline-danger btn-rounded waves-effect waves-light waves-light"><i class="mdi mdi-delete"></i></button>';
                    return $button;
                        
                })
                ->rawColumns(['action'])
                ->make(true);

    }

    public function storechannelpartner($request)
    {
        $channelpartner = $this->channelpartner;

        $channelpartner->name = $request->get('name');
        $channelpartner->company_name = $request->get('companyname');
        $channelpartner->email = $request->get('email');
        $channelpartner->addn_email = $request->get('additionalemail');
        $channelpartner->phone = $request->get('phone');
        $channelpartner->addn_phone = $request->get('additionalphone');
        $channelpartner->commission_percentage = $request->get('commissionpercentage');
        $channelpartner->partner_type = $request->get('channelpartnertype');

        $channelpartner->save();
        return $channelpartner;

    }

 
    public function updatechannelpartner($request)
    {
        $channelpartner = $this->channelpartner->find($request->hidden_id);

        $channelpartner->name = $request->get('name');
        $channelpartner->company_name = $request->get('companyname');
        $channelpartner->email = $request->get('email');
        $channelpartner->addn_email = $request->get('additionalemail');
        $channelpartner->phone = $request->get('phone');
        $channelpartner->addn_phone = $request->get('additionalphone');
        $channelpartner->commission_percentage = $request->get('commissionpercentage');
        $channelpartner->partner_type = $request->get('channelpartnertype');

        $channelpartner->save();
        return $channelpartner;
    }

     public function geteditdata($id)
     {
         
       return $this->channelpartner->findOrFail($id);
    }

    public function destroychannelpartner($id)
    {
        $data = $this->channelpartner::findOrFail($id);
        $data->delete();
        return $data;
    }

    

}
