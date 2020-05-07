<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ntrax\Repositories\ChannelPartner\ChannelPartnerInterface;
use App\Http\Requests\ChannelPartner\IndexChannelPartnerRequest;
use App\Http\Requests\ChannelPartner\StoreChannelPartnerRequest;
use App\Http\Requests\ChannelPartner\UpdateChannelPartnerRequest;
use App\Ntrax\Repositories\ChannelPartnerType\ChannelPartnerTypeInterface;
use DataTables;
use Illuminate\Support\Facades\DB;
use Validator;
use Zizaco\Entrust\EntrustFacade as Entrust;
class ChannelPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $channelpartner;
    private $channelpartnertype;
    public function __construct(ChannelPartnerInterface $channelpartner,ChannelPartnerTypeInterface $channelpartnertype)
    {
        $this->channelpartner = $channelpartner;
        $this->channelpartnertype = $channelpartnertype;
    }
    
    public function index(IndexChannelPartnerRequest $request)
    {
        if ($request->ajax()) {
             return   $channelpartners = $this->channelpartner->getallchannelpartnerdetails($request);
           }
        return view('admin.channelpartner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChannelPartnerRequest $request)
    {
       // dd($request->all());
      /*  $rules = array(
        'name'    =>  'required',
        'companyname' =>  'required',
        'email'       =>  'required',
        'additionalemail' => 'required',
        'phone'  => 'required',
        'additionalphone' => 'required',
        'commissionpercentage' => 'required',
        'channelpartnertype'   => 'required'
        );
    
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        } */
        DB::beginTransaction();
        try{
            DB::commit();
            $savezone = $this->channelpartner->storechannelpartner($request);
            return response()->json(['success' => 'Data Added successfully.']);
        }  catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            return redirect()->back()->with('error', 'Failed to Add');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = $this->channelpartner->geteditdata($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChannelPartnerRequest $request)
    {
       // dd($request->all());
        DB::beginTransaction();
        try{
            $data = $this->channelpartner->updatechannelpartner($request);
            DB::commit();
            return response()->json(['success' => 'Data is successfully updated.']);
        }  catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            return redirect()->back()->with('error', 'Update failed');
        }
    }

    public function searchChannelPartnerType()
    {
        $channelpartnertypes = $this->channelpartnertype->searchChannelPartnerType();
        $channelpartnertypeArray=[];
        foreach ($channelpartnertypes as $channelpartnertypekey=>$channelpartnertype){
            $channelpartnertypeArray[$channelpartnertypekey]['id']=$channelpartnertype->id;
            $channelpartnertypeArray[$channelpartnertypekey]['text']=$channelpartnertype->name;
        }
        return $channelpartnertypeArray;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Entrust::can('Delete ChannelPartner') ? 'true' : 'false' != 'false')
        {
        $data = $this->channelpartner->destroychannelpartner($id);
        return response()->json(['success'=>'ChannelPartner deleted successfully.']);
    } else {
        return response()->json(['errors'=>'You Dont Have Permission to Delete.']);
    }
    }

    
}
