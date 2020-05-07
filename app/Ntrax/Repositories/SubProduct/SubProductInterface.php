<?php

namespace App\Ntrax\Repositories\SubProduct;

interface SubProductInterface
{
     public function getallsubproductdetails($request);
     public function geteditdata($id);
     public function storesubproduct($request);
     public function updatesubproduct($request);
     public function destroysubproduct($id);
     public function searchSubProduct();

}
