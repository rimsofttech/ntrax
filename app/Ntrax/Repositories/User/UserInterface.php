<?php

namespace App\Ntrax\Repositories\User;

interface UserInterface
{
     public function getallusersdetails($request);
     public function geteditdata($id);
     public function storeuser($request);
     public function updateuser($request);
     public function destroyuser($id);
    

}
