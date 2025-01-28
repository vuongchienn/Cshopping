<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy("created_at","desc")->paginate(10);
        return view("admin.brand.index",["brands"=> $brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        return view("admin.brand.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name"=> "required",
        ]);
        $brand= Brand::create($validated);
        return redirect()->route('brands.index')->with("success","Brand dded successfully!");

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
        $brand = Brand::find($id);
        return view("admin.brand.edit", compact("brand"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            "name"=> "required",
            ]);
            $brand = Brand::find($id);
            $brand->update($validated);
            return redirect()->route("brands.index")->with("success","Brand updated successfully !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->Route('brands.index')->with("success","Brand deleted successfully !");
    }

    public function search(Request $request){

        $brands = Brand::where('name',$request->search)->orderBy("name","asc")->paginate(10);
        return view("admin.brand.index", compact("brands"));
    }
}
