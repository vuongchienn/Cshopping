<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $products = Product::orderBy("id","desc")->paginate(10);
        return view("admin.product.index", ["products"=> $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();  
        return view("admin.product.create",["categories"=> $categories,'brands'=> $brands]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $validated = $request->validate([
            "name"=> "required",
            "price"=> "numeric|required",
            "brand_id"=> "required",
            "category_id"=>"required",
            "content"=>"required",
            "discount"=>"required|numeric",
            "weight"=>"required|numeric",
            "tag"=>"required",
            "description"=>"required",
            
        ]);
        $product = new Product();
        $product->quantity = 0;
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->category_id = $validated['category_id'];
        $product->content = $validated['content'];
        $product->brand_id = $validated['brand_id'];
        $product->discount = $validated['discount'];
        $product->description = $validated['description'];
        $product->weight = $validated['weight'];
        $product->tag = $validated['tag'];
        if(isset($request->featured)){
            $product->featured = 1;
        }
        else{
            $product->featured = 0;
        }
        
        $product ->save();
    
        return redirect()->route("product.index")->with("success","Product added successfully !");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view("admin.product.show", compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brands = Brand::all();
        $categories = Category::all();  
        $product = Product::find($id);
        return view("admin.product.edit", ["categories"=> $categories,'brands'=> $brands,'product'=> $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            "name"=> "required",
            "price"=> "numeric|required",
            "brand_id"=> "required",
            "category_id"=>"required",
            "content"=>"required",
            "discount"=>"required|numeric",
            "weight"=>"required|numeric",
            "tag"=>"required",
            "description"=>"required",
            
        ]);

        $product = Product::find($id);
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->category_id = $validated['category_id'];
        $product->content = $validated['content'];
        $product->brand_id = $validated['brand_id'];
        $product->discount = $validated['discount'];
        $product->description = $validated['description'];
        $product->weight = $validated['weight'];
        $product->tag = $validated['tag'];
        if(isset($request->featured)){
            $product->featured = 1;
        }
        else{
            $product->featured = 0;
        }
        $product->save();
        return redirect()->route('product.index')->with('success','Product updated successfully !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->with('success','Product deleted successfully !');
    }


    public function search(Request $request){

        $products = Product::where('name',$request->search)->orderBy("name","asc")->paginate(10);
        return view("admin.product.index", compact("products"));
    }

}

