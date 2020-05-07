<?php

namespace App\Ntrax\Repositories\Product;

use App\Models\Product;
use App\Role;
use DataTables;

class ProductRepository implements ProductInterface
{
    private $product;

    public function __construct(Product $product){
        $this->product = $product;
    }

    public function getallproductdetails($request)
    {
        $data = $this->product::latest()->get();
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

    public function storeproduct($request)
    {
        $product = $this->product;

        $product->name = $request->get('name');
       

        $product->save();
        return $product;

    }

 
    public function updateproduct($request)
    {
        $product = $this->product->find($request->hidden_id);
        
        $product->name = $request->get('name');
      

        $product->save();
        return $product;
    }

     public function getedittypedata($id)
     {
      //   dd($id);
       return $this->product->findOrFail($id);
    }

    public function destroyproduct($id)
    {
        $data = $this->product::findOrFail($id);
        $data->delete();
        return $data;
    }

    public function find($id)
    {
        return $data = $this->product::findOrFail($id);
        
    }

    public function searchProduct()
    {

        return $products = $this->product->get();
    }

    

}
