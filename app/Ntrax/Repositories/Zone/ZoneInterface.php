<?php

namespace App\Ntrax\Repositories\Zone;

interface ZoneInterface
{
     public function getallzonesdetails($request);
     public function geteditdata($id);
     public function searchCountry($keyword = null);
     public function searchState($keyword = null,$request);
     public function searchCity($keyword = null,$request);
     public function storezone($request);
     public function updatezone($request);
     public function destroyzone($id);

}
