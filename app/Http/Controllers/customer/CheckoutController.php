<?php

namespace App\Http\Controllers\customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productInCarts= User::find(Auth::user()->id)->cartProducts;
        return view("customer.check-out",["productInCarts"=>$productInCarts]);
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

    public function vnPayCheck(Request $request){
        $vnp_ResponseCode=$request->get("vnp_ResponseCode");
        $vnp_TxnRef = $request->get("vnp_TxnRef");
        $vnp_Amount=  $request->get("vnp_Amount");



        if($vnp_ResponseCode !=null){
            if($vnp_ResponseCode ==00){
                return view('customer.checkout-result')->with("success","okee");
            }
            else{
                return view('customer.checkout-result')->with("success","fail");
            }
        }
        
    }
}
