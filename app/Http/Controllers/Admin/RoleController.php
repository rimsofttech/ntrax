<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ntrax\Repositories\Permission\PermissionInterface;
use App\Ntrax\Repositories\Role\RoleInterface;
use Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $role;
    private $permission;
    public function __construct(RoleInterface $role,PermissionInterface $permission)
     {
         $this->role = $role;
         $this->permission = $permission;
     }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return   $roles = $this->role->getallrolesdetails($request);
           }
           return view('admin.roles.index');
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
            'rolename'    =>  'required',
            'displayname' =>  'required',
            'description' =>  'required',
            'permission'  =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $savezone = $this->role->storerole($request);
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
    public function searchPermission() 
    {
        $permissions = $this->permission->getPermission();
        $permissionArray=[];
        foreach ($permissions as $permissionkey=>$permission){
            $permissionArray[$permissionkey]['id']=$permission->id;
            $permissionArray[$permissionkey]['text']=$permission->name;
        }
        return $permissionArray;
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
            $data = $this->role->geteditdata($id);
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
            'rolename'    =>  'required',
            'displayname'     =>  'required',
            'description'       =>  'required',
            'permission'        =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
            $data = $this->role->updaterole($request);
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
        $data = $this->role->destroyrole($id);
        return response()->json(['success'=>'Role deleted successfully.']);
    }
}
