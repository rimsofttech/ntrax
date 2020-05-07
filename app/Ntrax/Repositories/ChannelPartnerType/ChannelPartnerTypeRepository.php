<?php

namespace App\Ntrax\Repositories\ChannelPartnerType;

use App\Models\ChannelPartnerType;
use App\Role;
use DataTables;

class ChannelPartnerTypeRepository implements ChannelPartnerTypeInterface
{
    private $channelpartnertype;

    public function __construct(ChannelPartnerType $channelpartnertype){
        $this->channelpartnertype = $channelpartnertype;
    }

    public function getallchannelpartnertypedetails($request)
    {
        $data = $this->channelpartnertype::latest()->get();
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

    public function storechannelpartnertype($request)
    {
        $channelpartnertype = $this->channelpartnertype;

        $channelpartnertype->name = $request->get('name');
       

        $channelpartnertype->save();
        return $channelpartnertype;

    }

 
    public function updatechannelpartnertype($request)
    {
        $channelpartnertype = $this->channelpartnertype->find($request->hidden_id);
        
        $channelpartnertype->name = $request->get('name');
      

        $channelpartnertype->save();
        return $channelpartnertype;
    }

     public function getedittypedata($id)
     {
      //   dd($id);
       return $this->channelpartnertype->findOrFail($id);
    }

    public function destroychannelpartnertype($id)
    {
        $data = $this->channelpartnertype::findOrFail($id);
        $data->delete();
        return $data;
    }

    public function find($id)
    {
        return $data = $this->channelpartnertype::findOrFail($id);
        
    }

    public function searchChannelPartnerType()
    {

        return $channelpartnertypes = $this->channelpartnertype->get();
    }

    

}
