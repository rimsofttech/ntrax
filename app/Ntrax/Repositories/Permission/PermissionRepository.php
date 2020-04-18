<?php

namespace App\Ntrax\Repositories\Permission;

use App\Permission;
use DataTables;
class PermissionRepository implements PermissionInterface
{
    private $permission;

    public function __construct(Permission $permission){
        $this->permission = $permission;
    }

    public function getallpermissionsdetails($request)
    {
        $data = $this->permission::latest()->get();
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

    
     
    public function storepermission($request)
    {
        $form_data = array(
            'name'        =>  $request->permissionname,
            'display_name'=>  $request->displayname,
            'description' =>  $request->description,
        );

        $permission =  $this->permission::create($form_data);

        return $permission;
    }

    public function updatepermission($request)
    {
        $form_data = array(
            'name'        =>  $request->permissionname,
            'display_name'=>  $request->displayname,
            'description' =>  $request->description,
        );

       $permission =  $this->permission::whereId($request->hidden_id)->update($form_data);
        return $permission;
    }

    public function geteditdata($id)
    {
         
        $data = $this->permission::findOrFail($id);
        return $data;
    }

    public function destroypermission($id)
    {
        $data = $this->permission::findOrFail($id);
        $data->delete();
        return $data;
    }
    public function getPermission()
    {
        return  $permissions = $this->permission->get();
        
    }

}
