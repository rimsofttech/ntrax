<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Zone;
use App\Ntrax\Repositories\Zone\ZoneInterface;
use DataTables;
use Validator;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $zone;
    private $country;
    private $state;
    private $city;
    public function __construct(ZoneInterface $zone,Country $country, State $state, City $city)
     {
         $this->zone = $zone;
         $this->country = $country;
         $this->state = $state;
         $this->city = $city;
     }
    public function index(Request $request)
    {
        if ($request->ajax()) {
         return   $zones = $this->zone->getallzonesdetails($request);
        }
        return view('admin.zone.index');
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = $this->country->all();
        $states = $this->state->all();
        $citys = $this->city->all();

        return view('admin.zone/create',compact('country','states','city'));
    }

    public function searchCountry($keyword=null)
    {
        $countries = $this->zone->searchCountry($keyword);
        $countryArray=[];
        foreach ($countries as $countrykey=>$country){
            $countryArray[$countrykey]['id']=$country->id;
            $countryArray[$countrykey]['text']=$country->country_name;
        }
        return $countryArray;
    }

    public function searchState($keyword=null,Request $request)
    {
        $states = $this->zone->searchState($keyword,$request);
        $stateArray=[];
        foreach ($states as $stateykey=>$state){
            $stateArray[$stateykey]['id']=$state->id;
            $stateArray[$stateykey]['text']=$state->state_name;
        }
        return $stateArray;
    }

    public function searchCity($keyword=null,Request $request)
    {
        $cities = $this->zone->searchCity($keyword,$request);
        $cityArray=[];
        $cityuu = [];
        foreach ($cities as $citykey=>$citys){
            foreach($citys as $citykeys=> $city){
                $cityArray[$citykey][$citykeys]['id']=$city->id;
                $cityArray[$citykey][$citykeys]['text']=$city->city_name;
            }
            
        }
        return array_merge($cityArray[0],$cityArray[1]);
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
            'zonename'    =>  'required',
            'country'     =>  'required',
            'state'       =>  'required',
            'city'        =>'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $savezone = $this->zone->storezone($request);
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
            $data = $this->zone->geteditdata($id);
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
            'zonename'    =>  'required',
            'country'     =>  'required',
            'state'       =>  'required',
            'city'        =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $savezone = $this->zone->updatezone($request);
        return response()->json(['success' => 'Data is successfully updated.']);
       
    }

    /**
     * Remove the specified resource from storage.$dd =
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->zone->destroyzone($id);
        return response()->json(['success'=>'Zone deleted successfully.']);
    }
}
