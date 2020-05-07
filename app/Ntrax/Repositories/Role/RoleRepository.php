<?php

namespace App\Ntrax\Repositories\Role;

use App\Ntrax\Repositories\Permission\PermissionInterface;
use App\Role;
use DataTables;

class RoleRepository implements RoleInterface
{
    private $role;
    private $permission;

    public function __construct(Role $role,PermissionInterface $permission){
        $this->role = $role;
        $this->permission = $permission;
    }

    public function getallrolesdetails($request)
    {
        $data = Role::latest()->get();
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

    public function storerole($request)
    {
        $role = $this->role;

        $role->name = $request->get('rolename');

        $role->display_name = $request->get('displayname');

        $role->description = $request->get('description');

        $role->save();

        $role->permissions()->sync($request->get('permission'));

        return $role;

    }

 
    public function updaterole($request)
    {
        $role = $this->role->find($request->hidden_id);

        $role->name = $request->get('rolename');

        $role->display_name = $request->get('displayname');

        $role->description = $request->get('description');

        $role->save();

        $role->permissions()->sync($request->get('permission'));

        return $role;
    }

     public function geteditdata($id)
     {
         
       return $this->role->with('permissions')->findOrFail($id);
    }

    public function destroyrole($id)
    {
        $data = $this->role::findOrFail($id);
        $data->delete();
        return $data;
    }

    public function getRole()
    {
        return  $roles = $this->role->get();
        
    }

}
