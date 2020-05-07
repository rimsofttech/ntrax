<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChannelPartnerType;
use App\Ntrax\Repositories\ChannelPartnerType\ChannelPartnerTypeInterface;
use App\Http\Requests\ChannelPartnerType\IndexChannelPartnerTypeRequest;
use App\Http\Requests\ChannelPartnerType\UpdateChannelPartnerTypeRequest;
use App\Http\Requests\ChannelPartnerType\StoreChannelPartnerTypeRequest;
use DataTables;
use Illuminate\Support\Facades\DB;
use Validator;
use Zizaco\Entrust\EntrustFacade as Entrust;

class ChannelPartnerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $channelpartnertype;
    public function __construct(ChannelPartnerTypeInterface $channelpartnertype)
    {
        $this->channelpartnertype = $channelpartnertype;
    }

    public function index(IndexChannelPartnerTypeRequest $request)
    {
        if($request->ajax())
        {
            return  $channelpartnertypes= $this->channelpartnertype->getallchannelpartnertypedetails($request);
        }
        return view('admin.channelpartnertype.index');
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
    public function store(StoreChannelPartnerTypeRequest $request)
    {
       /*  $rules = array(
            'name'    =>  'required',
            );
        
            $error = Validator::make($request->all(), $rules);
    
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
    
            $savezone = $this->channelpartnertype->storechannelpartnertype($request);
            return response()->json(['success' => 'Data Added successfully.']);
 */
            DB::beginTransaction();
            try{
                DB::commit();
                $savezone = $this->channelpartnertype->storechannelpartnertype($request);
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
            $data = $this->channelpartnertype->getedittypedata($id);
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
    public function update(UpdateChannelPartnerTypeRequest $request)
    {
        /* $rules = array(
            'name'    =>  'required',
           
            );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
            $data = $this->channelpartnertype->updatechannelpartnertype($request);
            return response()->json(['success' => 'Data is successfully updated.']); */

            DB::beginTransaction();
            try{
                $data = $this->channelpartnertype->updatechannelpartnertype($request);
                DB::commit();
                return response()->json(['success' => 'Data is successfully updated.']);
            }  catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage());
                return redirect()->back()->with('error', 'Update failed');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Entrust::can('Delete ChannelPartnerType') ? 'true' : 'false' != 'false')
        {
            //dd(Entrust::can('Delete ChannalPartnerType'));
        $data = $this->channelpartnertype->destroychannelpartnertype($id);
        return response()->json(['success'=>'Deleted successfully.']);
        } else {
        return response()->json(['errors'=>'You Dont Have Permission to Delete.']);
              }
    }

    
}
