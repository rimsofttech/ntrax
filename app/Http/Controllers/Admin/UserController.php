<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ntrax\Repositories\Permission\PermissionInterface;
use App\Ntrax\Repositories\Role\RoleInterface;
use App\Ntrax\Repositories\User\UserInterface;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $role;
    private $permission;
    private $user;
    public function __construct(RoleInterface $role,PermissionInterface $permission, UserInterface $user)
     {
         $this->role = $role;
         $this->permission = $permission;
         $this->user = $user;
     }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return   $users = $this->user->getallusersdetails($request);
           }
           return view('admin.user.index');
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
            'email' =>  'required',
            'role' =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $savezone = $this->user->storeuser($request);
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
    public function searchRole() 
    {
        $permissions = $this->role->getRole();
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
            $data = $this->user->geteditdata($id);
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
            'email'     =>  'required',
            'role'       =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
            $data = $this->user->updateuser($request);
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
        $data = $this->user->destroyuser($id);
        return response()->json(['success'=>'Role deleted successfully.']);
    }
}
