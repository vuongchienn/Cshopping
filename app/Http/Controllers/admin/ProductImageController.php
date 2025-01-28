<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($product_id)
    {
        $product = Product::find($product_id);
        $productImages = $product->productImages;

        return view("admin.product.image.index",["product"=> $product,"productImages"=> $productImages]);
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
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra định dạng file
        ]);
    
        if ($request->hasFile('image')) {
            // Lưu file mới
            $path = $request->file('image')->store('productImages', 'public');
    
            // Lưu dữ liệu vào database
            $productImage = ProductImage::create([
                'product_id' => $request->product_id,
                'path' => $path,
            ]);
        }
    
        return redirect('admin/product/'.$request->product_id.'/image')->with('success','Image added successfully !');
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
    public function destroy($product_id,string $id)
    {
        $productImage = ProductImage::find($id);
        Storage::disk('public')->delete($productImage->path);
        $productImage->delete();
        return redirect('admin/product/'.$product_id.'/image')->with('success','Image deleted successfully !');
    }
}

