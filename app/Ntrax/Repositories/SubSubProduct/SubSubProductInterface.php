<?php

namespace App\Ntrax\Repositories\SubSubProduct;

interface SubSubProductInterface
{
     public function getallsubsubproductdetails($request);
     public function geteditdata($id);
     public function storesubsubproduct($request);
     public function updatesubsubproduct($request);
     public function destroysubsubproduct($id);

}
