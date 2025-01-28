<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetail;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($product_id)
    {
        $product = Product::findOrFail($product_id) ;   
        $productDetails = $product->productDetails;       
        return view('admin.product.detail.index', ['product'=> $product,'productDetails'=> $productDetails]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($product_id)
    {
        $product = Product::findOrFail($product_id) ;
        return view('admin.product.detail.create', ['product'=> $product]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'color'=> 'required',
            'size'=>'required',
            'quantity'=>'required|numeric',
            'product_id'=>'required'
        ]);
        
        $productDetail = ProductDetail::create($validated);
        $product=Product::find($request->product_id);
        $product->quantity+= $request->quantity;
        $product->save();
        return redirect('admin/product/'.$request->product_id.'/detail')->with('success','Added successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product_id,string $id)
    {
        $product = Product::findOrFail($product_id) ;
        $productDetail = ProductDetail::findOrFail($id) ;

        return view('admin.product.detail.edit', ['product'=> $product,'productDetail'=>$productDetail] );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request ,$product_id,string $id)
    {
      
        $validated = $request->validate([
            'color'=> 'required',
            'size'=>'required',
            'quantity'=>'required|numeric',
            'product_id'=>'required'
        ]);
        
        $productDetail = ProductDetail::findOrFail($id) ;
       
        $productDetail->update($validated);
     
        $product=Product::find($request->product_id);
       
        $product->quantity -= $request->oldQuantity;
        $product->quantity+= $request->quantity;

        $product->save();
       
        return redirect('admin/product/'.$request->product_id.'/detail')->with('success','Added successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id,string $id)
    {
        $productDetail = ProductDetail::findOrFail($id) ;
        $product=Product::find($product_id) ;
        $product->quantity -= $productDetail->quantity;
        $product->save();
        $productDetail->delete();

        
        return redirect('admin/product/'.$product_id.'/detail')->with('success','Deleted successfully !');

    }
}
