<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubSubProduct\IndexSubSubProductRequest;
use App\Http\Requests\SubSubProduct\StoreSubSubProductRequest;
use App\Http\Requests\SubSubProduct\UpdateSubSubProductRequest;
use App\Ntrax\Repositories\SubProduct\SubProductInterface;
use App\Ntrax\Repositories\SubSubProduct\SubSubProductInterface;
use DataTables;
use Illuminate\Support\Facades\DB;
use Validator;
use Zizaco\Entrust\EntrustFacade as Entrust;

class SubSubProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $subsubproduct;
    private $subproduct;
    public function __construct(SubSubProductInterface $subsubproduct,SubProductInterface $subproduct)
    {
        $this->subsubproduct = $subsubproduct;
        $this->subproduct = $subproduct;
    }
    public function index(IndexSubSubProductRequest $request)
    {
        if ($request->ajax()) {
            return   $subsubproducts = $this->subsubproduct->getallsubsubproductdetails($request);
          }
       return view('admin.subsubproduct.index');
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
    public function store(StoreSubSubProductRequest $request)
    {
        DB::beginTransaction();
        try{
            DB::commit();
            $savesubsubproduct= $this->subsubproduct->storesubsubproduct($request);
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
            $data = $this->subsubproduct->geteditdata($id);
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
    public function update(UpdateSubSubProductRequest $request)
    {
        DB::beginTransaction();
        try{
            $data = $this->subsubproduct->updatesubsubproduct($request);
            DB::commit();
            return response()->json(['success' => 'Data is successfully updated.']);
        }  catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            return redirect()->back()->with('error', 'Update failed');
        }
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
        if(Entrust::can('Delete SubSubProduct') ? 'true' : 'false' != 'false')
        {
        $data = $this->subsubproduct->destroysubsubproduct($id);
        return response()->json(['success'=>'Details deleted successfully.']);
    } else {
        return response()->json(['errors'=>'You Dont Have Permission to Delete.']);
    }
    }
}
