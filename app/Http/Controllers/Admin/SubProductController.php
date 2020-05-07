<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubProduct\IndexSubProductRequest;
use App\Http\Requests\SubProduct\StoreSubProductRequest;
use App\Http\Requests\SubProduct\UpdateSubProductRequest;
use App\Ntrax\Repositories\Product\ProductInterface;
use App\Ntrax\Repositories\SubProduct\SubProductInterface;
use DataTables;
use Illuminate\Support\Facades\DB;
use Validator;
use Zizaco\Entrust\EntrustFacade as Entrust;

class SubProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $subproduct;
    private $product;
    public function __construct(SubProductInterface $subproduct,ProductInterface $product)
    {
        $this->subproduct = $subproduct;
        $this->product = $product;
    }
    public function index(IndexSubProductRequest $request)
    {
        if ($request->ajax()) {
            return   $subproducts = $this->subproduct->getallsubproductdetails($request);
          }
       return view('admin.subproduct.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubProductRequest $request)
    {
        DB::beginTransaction();
        try{
            DB::commit();
            $savesubproduct= $this->subproduct->storesubproduct($request);
            return response()->json(['success' => 'Data Added successfully.']);
        }  catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            return redirect()->back()->with('error', 'Failed to Add');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = $this->subproduct->geteditdata($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubProductRequest $request)
    {
        DB::beginTransaction();
        try{
            $data = $this->subproduct->updatesubproduct($request);
            DB::commit();
            return response()->json(['success' => 'Data is successfully updated.']);
        }  catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            return redirect()->back()->with('error', 'Update failed');
        }
    }

    public function searchProduct()
    {
        $products = $this->product->searchProduct();
        $procuctArray=[];
        foreach ($products as $productkey=>$product){
            $procuctArray[$productkey]['id']=$product->id;
            $procuctArray[$productkey]['text']=$product->name;
        }
        return $procuctArray;
    }

    public function searchSubProduct()
    {
        $subproducts = $this->subproduct->searchSubProduct();
        $subprocuctArray=[];
        foreach ($subproducts as $productkey=>$subproduct){
            $subprocuctArray[$productkey]['id']=$subproduct->id;
            $subprocuctArray[$productkey]['text']=$subproduct->name;
        }
        return $subprocuctArray;
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Entrust::can('Delete SubProduct') ? 'true' : 'false' != 'false')
        {
        $data = $this->subproduct->destroysubproduct($id);
        return response()->json(['success'=>'SubProduct deleted successfully.']);
    } else {
        return response()->json(['errors'=>'You Dont Have Permission to Delete.']);
    }
    }
}
