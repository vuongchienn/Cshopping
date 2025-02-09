<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
     
        $sortBy = $request->sort_by??'newest';
        $products = Product::orderBy('created_at','desc')->paginate(9);

        $categories = Category::all();
        $tags = Product::pluck('tag')->unique();
        if($sortBy == 'oldest'){
            $products = Product::orderBy('created_at','asc')->paginate(9);
        }
        else if($sortBy == 'name-ascending'){
            $products = Product::orderBy('name','asc')->paginate(9);
        }
        else if($sortBy == 'name-descending'){
            $products = Product::orderBy('name','desc')->paginate(9);
        }
        else if($sortBy == 'price-ascending'){
            $products = Product::orderBy('price','asc')->paginate(9);
        }
        else if($sortBy == 'price-descending'){
            $products = Product::orderBy('price','desc')->paginate(9);
        }

        $products->appends(['sort_by'=> $sortBy]);
  

        return view("customer.product.index", ['products'=>$products,'categories'=>$categories,'tags'=>$tags]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        $avgRating = 0;
        $sumRating = array_sum(array_column($product->productComments->toArray(),'rating'));
        $countRating = count($product->productComments);

        $relatedProducts = Product::where('brand_id',$product->brand_id)
                                    ->orWhere('tag',$product->tag)
                            ->orWhere('category_id',$product->category_id)
                            ->limit(4)->get();

        $product->relatedProducts = $relatedProducts;

        if($countRating !=0){
            $avgRating = $sumRating / $countRating;
        }
        $product->avgRating = $avgRating;
        return view("customer.product.show", compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function category($categoryName,Request $request){
        $tags = Product::pluck('tag')->unique();
        $categories = Category::all();
        $products = Product::where('category_id',Category::where('name',$categoryName)->first()->id)->paginate(9);
        return view("customer.product.index", ['products'=>$products,'categories'=>$categories,'tags'=>$tags]);
    }

    public function tag($tagName,Request $request){
        $categories = Category::all();
        $products = Product::where('tag',$tagName)->paginate(9);
        $tags = Product::pluck('tag')->unique();

        return view("customer.product.index", ['products'=>$products,'categories'=>$categories,'tags'=>$tags]);
    }
}
