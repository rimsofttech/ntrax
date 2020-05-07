<?php

namespace App\Ntrax\Repositories\SubSubProduct;

use App\Models\SubSubProduct;
use App\Models\Product;
use App\Ntrax\Repositories\SubProduct\SubProductInterface;
use App\Ntrax\Repositories\SubSubProduct\SubSubProductInterface;
use App\Role;
use DataTables;

class SubSubProductRepository implements SubSubProductInterface
{
    private $subsubproduct;
    private $subproduct;

    public function __construct(SubSubProduct $subsubproduct,SubProductInterface $subproduct){
        $this->subsubproduct = $subsubproduct;
        $this->subproduct = $subproduct;
    }

    public function getallsubsubproductdetails($request)
    {
        $data = $this->subsubproduct::latest()->get();
        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('subproduct_id', function ($data) {
                    $subproductname = $this->subproduct->geteditdata($data->subproduct_id);
                    return $subproductname->name;
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

    public function storesubsubproduct($request)
    {
        $subsubproduct = $this->subsubproduct;
        $subsubproduct->name = $request->get('name');
        $subsubproduct->subproduct_id = $request->get('subproduct_name');
        $subsubproduct->rate = $request->get('rate');
        $subsubproduct->margin = $request->get('margin');
        $subsubproduct->max_discount = $request->get('discount');
        $subsubproduct->save();
        return $subsubproduct;
    }

 
    public function updatesubsubproduct($request)
    {
        $subsubproduct = $this->subsubproduct->find($request->hidden_id);
        $subsubproduct->name = $request->get('name');
        $subsubproduct->subproduct_id = $request->get('subproduct_name');
        $subsubproduct->rate = $request->get('rate');
        $subsubproduct->margin = $request->get('margin');
        $subsubproduct->max_discount = $request->get('discount');
        $subsubproduct->save();
        return $subsubproduct;
    }

     public function geteditdata($id)
     {
        $subsubproduct = $this->subsubproduct->findOrFail($id);
       // dd($subsubproduct);
        $subproductname = $this->subproduct->geteditdata($subsubproduct->subproduct_id);
        $subsubproduct->subproductname = $subproductname->name;
        return $subsubproduct;

    }

    public function destroysubsubproduct($id)
    {
        $data = $this->subsubproduct::findOrFail($id);
        $data->delete();
        return $data;
    }

}
