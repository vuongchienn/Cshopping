<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menCategory = Category::where('name','Men')->first();
        $menRelatedProducts = Product::where('category_id',$menCategory->id)->where('featured',true)->limit(10)->get();


        $womenCategory = Category::where('name','Women')->first();
        $womenRelatedProducts = Product::where('category_id',$womenCategory->id)->where('featured',true)->limit(10)->get();

        return view('customer.index',['menRelatedProducts'=>$menRelatedProducts,'womenRelatedProducts'=>$womenRelatedProducts]);
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
        //
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
}
