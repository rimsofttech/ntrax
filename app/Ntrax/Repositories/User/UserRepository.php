<?php

namespace App\Ntrax\Repositories\User;

use App\Ntrax\Repositories\Permission\PermissionInterface;
use App\Role;
use App\User;
use DataTables;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    private $role;
    private $permission;
    private $user;

    public function __construct(Role $role,PermissionInterface $permission,User $user){
        $this->role = $role;
        $this->permission = $permission;
        $this->user = $user;
    }

    public function getallusersdetails($request)
    {
        $data = $this->user::latest()->get();
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

    public function storeuser($request)
    {
        $user = $this->user;

        $user->name = $request->get('name');

        $user->email = $request->get('email');
        $user->password = Hash::make('password');
        $user->save();

        $user->roles()->attach($request->get('role'));

        return $user;

    }

 
    public function updateuser($request)
    {
        $user = $this->user->find($request->hidden_id);

        $user->name = $request->get('name');

        $user->email = $request->get('email');

        $user->save();

        $user->roles()->sync($request->get('role'));

        return $user;
    }

     public function geteditdata($id)
     {
         
       return $this->user->with('roles')->findOrFail($id);
    }

    public function destroyuser($id)
    {
        $data = $this->user::findOrFail($id);
        $data->delete();
        return $data;
    }

}
