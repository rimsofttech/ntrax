<?php

namespace App\Ntrax\Repositories\Zone;

use App\Models\City;
use App\Models\Zone;
use App\Models\Country;
use App\Models\State;
use DataTables;
class ZoneRepository implements ZoneInterface
{
    private $zone;
    private $country;
    private $state;
    private $city;

    public function __construct(Zone $zone,Country $country,State $state,City $city){
        $this->zone = $zone;
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
    }

    public function getallzonesdetails($request)
    {
        // $zoneArray = [];
        // $zonesdetails = $this->zone->all();
        // foreach($zonesdetails as $keys=>$zonesdetail){
        // $stateids = explode(',',$zonesdetail->state);
        // $cityids = explode(',',$zonesdetail->city);
        // $state_name = [];
        // $city_name = [];
        // foreach($stateids as $key => $stateid){
        // $State = $this->state::where('id',$stateid)->first();
        // $state_name[] = $State->state_name;
        // }
        // foreach($cityids as $key => $cityid){
        //     $City = $this->city::where('id',$cityid)->first();
        //     $city_name[] = $City->city_name;
        //     }
        // $zonesdetail->state_name = implode(' , ',$state_name);
        // $zonesdetail->city_name = implode(' , ',$city_name);

        // $zoneArray[] = $zonesdetail;
        // }
        // return  $zoneArray;

            $data = Zone::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('country', function ($data) {
                            $Country = $this->country::where('id',$data->country)->first();
                            return $Country->country_name;
                        })
                    ->editColumn('state', function ($data) {
                        $stateids = explode(',',$data->state);
                        $state_name = [];
                        foreach($stateids as $key => $stateid){
                            $State = $this->state::where('id',$stateid)->first();
                            $state_name[] = $State->state_name;
                            }
                        return $state_name;
                    })
                    ->editColumn('city', function ($data) {
                        $citiesids = explode(',',$data->city);
                        $city_name = [];
                        foreach($citiesids as $key => $cityid){
                            $City = $this->city::where('id',$cityid)->first();
                            $city_name[] = $City->city_name;
                            }
                        return $city_name;
                    })
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

    public function searchCountry($keyword = null)
    {
        return  $countries_name = Country::where('country_name', 'like', '%'.$keyword.'%')->select('id', 'country_name')->limit(10)->get();
    }

    public function searchState($keyword = null,$request)
    {
          $states_name =State::where('country_id',$request->country_id)->where('state_name', 'like', '%'.$keyword.'%')->select('id', 'state_name')->get();
          return $states_name;
    }

    public function searchCity($keyword = null,$request)
    { 
        // dd($request->state_id);
        $stateids = explode(',',$request->state_id);
        $states_name = [];
        foreach($stateids as $state)
        {
            $states_name[] = City::where('state_id',$state)->where('city_name', 'like', '%'.$request->q.'%')->select('id', 'city_name')->get();
        }
        // dd($states_name);
        return  $states_name ;
    }
     
    public function storezone($request)
    {
        $form_data = array(
            'zonename'        =>  $request->zonename,
            'country'         =>  $request->country,
            'state'         =>  implode(',',$request->state),
            'city'         =>  implode(',',$request->city),
        );

       $zone =  Zone::create($form_data);

        return $zone;
    }

    public function updatezone($request)
    {
        $form_data = array(
            'zonename'        =>  $request->zonename,
            'country'         =>  $request->country,
            'state'         =>  implode(',',$request->state),
            'city'         =>  implode(',',$request->city),
        );

       $zone =  $this->zone::whereId($request->hidden_id)->update($form_data);
        return $zone;
    }

    public function geteditdata($id)
    {
         
        $data = $this->zone::findOrFail($id);
        $Country = $this->country::where('id',$data->country)->first();
        $data->country_name = $Country->country_name;
        $stateids = explode(',',$data->state);
        $citiesids = explode(',',$data->city);
        $state_name = [];
        $state_id = [];
        foreach($stateids as $key => $stateid){
            $State = $this->state::where('id',$stateid)->first();
            $state_name[] = $State->state_name;
            $state_id[] = $State->id;
            }
        $data->state_name = $state_name;
        $data->state_id = $state_id;
        $city_name = [];
        $city_id = [];
        foreach($citiesids as $key => $cityid){
            $City = $this->city::where('id',$cityid)->first();
            $city_name[] = $City->city_name;
            $city_id[] =  $City->id;
            }
            $data->city_name = $city_name;
            $data->city_id = $city_id;
        // dd($data);
        return $data;
    }

    public function destroyzone($id)
    {
        $data = $this->zone::findOrFail($id);
        $data->delete();
        return $data;
    }

}
