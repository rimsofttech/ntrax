<?php

namespace App\Ntrax\Repositories\Role;

interface RoleInterface
{
     public function getallrolesdetails($request);
     public function geteditdata($id);
     public function storerole($request);
     public function updaterole($request);
     public function destroyrole($id);
     public function getRole();

}
