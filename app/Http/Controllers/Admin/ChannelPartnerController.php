<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ntrax\Repositories\ChannelPartner\ChannelPartnerInterface;
use Validator;
class ChannelPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $channelpartner;
    public function __construct(ChannelPartnerInterface $channelpartner)
    {
        $this->channelpartner = $channelpartner;
    }
    
    public function index(Request $request)
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
    public function store(Request $request)
    {
       // dd($request->all());
       $rules = array(
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
        }

        $savezone = $this->channelpartner->storechannelpartner($request);
        return response()->json(['success' => 'Data Added successfully.']);
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
    public function update(Request $request)
    {
        $rules = array(
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
        }
            $data = $this->channelpartner->updatechannelpartner($request);
            return response()->json(['success' => 'Data is successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->channelpartner->destroychannelpartner($id);
        return response()->json(['success'=>'Role deleted successfully.']);
    }
}
