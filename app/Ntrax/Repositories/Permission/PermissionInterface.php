<?php

namespace App\Ntrax\Repositories\Permission;

interface PermissionInterface
{
     public function getallpermissionsdetails($request);
     public function getPermission();
    
     public function geteditdata($id);
     public function storepermission($request);
     public function updatepermission($request);
     public function destroypermission($id);

}
