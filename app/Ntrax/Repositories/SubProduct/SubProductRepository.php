<?php

namespace App\Ntrax\Repositories\SubProduct;

use App\Models\SubProduct;
use App\Models\Product;
use App\Ntrax\Repositories\Product\ProductInterface;
use App\Ntrax\Repositories\SubProduct\SubProductInterface;
use App\Role;
use DataTables;

class SubProductRepository implements SubProductInterface
{
    private $subproduct;
    private $product;

    public function __construct(SubProduct $subproduct,ProductInterface $product){
        $this->subproduct = $subproduct;
        $this->product = $product;
    }

    public function getallsubproductdetails($request)
    {
        $data = $this->subproduct::latest()->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('product_id', function ($data) {
                    $productname = $this->product->getedittypedata($data->product_id);
                    return $productname->name;
                })
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

    public function storesubproduct($request)
    {
        $subproduct = $this->subproduct;
        $subproduct->name = $request->get('name');
        $subproduct->product_id = $request->get('product_name');
        $subproduct->save();
        return $subproduct;
    }

 
    public function updatesubproduct($request)
    {
        $subproduct = $this->subproduct->find($request->hidden_id);
        $subproduct->name = $request->get('name');
        $subproduct->product_id = $request->get('product_name');
        $subproduct->save();
        return $subproduct;
    }

     public function geteditdata($id)
     {
        $subproduct = $this->subproduct->findOrFail($id);
        $productname = $this->product->getedittypedata($subproduct->product_id);
        $subproduct->productname = $productname->name;
        return $subproduct;

    }

    public function destroysubproduct($id)
    {
        $data = $this->subproduct::findOrFail($id);
        $data->delete();
        return $data;
    }

    public function searchSubProduct()
    {

        return $subproducts = $this->subproduct->get();
    }

}
