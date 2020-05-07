<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\IndexProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Ntrax\Repositories\Product\ProductInterface;
use DataTables;
use Illuminate\Support\Facades\DB;
use Validator;
use Zizaco\Entrust\EntrustFacade as Entrust;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $product;
    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    public function index(IndexProductRequest $request)
    {
        if($request->ajax())
        {
            return  $products= $this->product->getallproductdetails($request);
        }
        return view('admin.product.index');
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
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();
            try{
                DB::commit();
                $saveproduct= $this->product->storeproduct($request);
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
            $data = $this->product->getedittypedata($id);
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
    public function update(UpdateProductRequest $request)
    {
        DB::beginTransaction();
            try{
                $data = $this->product->updateproduct($request);
                DB::commit();
                return response()->json(['success' => 'Data is successfully updated.']);
            }  catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage());
                return redirect()->back()->with('error', 'Update failed');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Entrust::can('Delete Product') ? 'true' : 'false' != 'false')
        {
            //dd(Entrust::can('Delete ChannalPartnerType'));
        $data = $this->product->destroyproduct($id);
        return response()->json(['success'=>'Deleted successfully.']);
        } else {
        return response()->json(['errors'=>'You Dont Have Permission to Delete.']);
              }
    }
}
