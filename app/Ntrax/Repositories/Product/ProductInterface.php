<?php

namespace App\Ntrax\Repositories\Product;

interface ProductInterface
{
     public function getallproductdetails($request);
     public function getedittypedata($id);
     public function storeproduct($request);
     public function updateproduct($request);
     public function destroyproduct($id);
     public function find($id);
     public function searchProduct();

}
