<?php

namespace App\Http\Controllers\customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productInCarts= User::find(Auth::user()->id)->cartProducts;
        View::share('productInCarts', $productInCarts);
        return view("customer.shopping-cart",["productInCarts"=>$productInCarts]);
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
        $validated = $request->validate([
            'color' =>"required",
            "size"=>"required"
        ]);
       

        
        $user_id = Auth::user()->id;
        $product_id = $request->product_id;
        $product_detail = ProductDetail::where("product_id",$product_id)->where('color','=',$validated['color'])->where('size','=',$validated['size'])->first();
        
        if(!isset($product_detail)){
            return redirect()->route("products.index")->with("error","This product is ran out of !");
        }
        $quantity = $request->quantity;
        $product = Product::find($product_id);
       
        if($product_detail->quantity-$quantity<0){
            return redirect()->route("products.index")->with("error","Only ".$product_detail->quantity ." items left in ".$product_detail->color." color and ".$product_detail->size. " size! ");
        }
        $product->quantity-=$quantity;
        $product_detail->quantity-= $quantity;
        Cart::create([
            "user_id"=> $user_id,
            "product_detail_id"=> $product_detail->id,
            "quantity"=> $quantity
        ]);

        
        $product->save();
        $product_detail->save();
        return redirect()->route("products.index")->with("success","Product added to cart succcessfully !");
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
    public function destroy(string $id,Request $request)
    {
        $product = Product::find($id);
        $user_id = Auth::user()->id;
        $product_id = $id;
        $product_detail = ProductDetail::where("product_id",$product_id)->where('color','=',$request->color)->where('size','=',$request->size)->first();
        $cart = Cart::where('user_id',$user_id)->where('product_detail_id', $product_detail->id)->first();
        $product_detail->quantity+= $cart->quantity;
        $product->quantity+= $cart->quantity;
        $product->save();
        $product_detail->save();
        $cart->delete();
        return back()->with('success','Product removed from the cart succcessfully !');
    }
}
