<?php

namespace App\Http\Controllers\customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utilities\VNPay;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
      

        
        return view("customer.my-order", compact("orders"));
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
            "first_name"=> "required|alpha|min:2|max:50",
            "last_name"=> "required|alpha|min:2|max:50",
            "street_address"=>"required|min:5|max:255|regex:/^[a-zA-Z0-9\s]+$/",
            "city"=>"required|min:2|max:100|regex:/^[a-zA-Z0-9\s]+$/",
            "email"=>"required|email|max:255",
            "phone"=> "required|numeric",
            "payment_method"=>"required"

        ],[
            "first_name.required" => "First name is required.",
            "first_name.alpha" => "First name should only contain letters and spaces.",
            "first_name.min" => "First name must be at least 2 characters.",
            "first_name.max" => "First name cannot exceed 50 characters.",

            "last_name.required" => "Last name is required.",
            "last_name.alpha" => "Last name should only contain letters and spaces.",
            "last_name.min" => "Last name must be at least 2 characters.",
            "last_name.max" => "Last name cannot exceed 50 characters.",

            "street_address.required" => "Street address is required.",
            "street_address.regex" => "Street address must be a valid string.",
            "street_address.min" => "Street address must be at least 5 characters.",
            "street_address.max" => "Street address cannot exceed 255 characters.",

            "city.required" => "City is required.",
            "city.regex" => "City must be a valid string.",
            "city.min" => "City name must be at least 2 characters.",
            "city.max" => "City name cannot exceed 100 characters.",

    
            "email.required" => "Email address is required.",
            "email.email" => "Email must be a valid email address.",
            "email.max" => "Email address cannot exceed 255 characters.",

            "phone.required" => "Phone number is required.",
            "phone.numeric" => "Phone number must be between 10 and 15 digits, and may start with a plus (+).",
           
            "payment_method.required"=>"Payment method is required"
        ]);

  
        $order = new Order();
        $order->first_name = $validated["first_name"];
        $order->last_name = $validated["last_name"];
        $order->email = $validated["email"];
        $order->phone = $validated["phone"];
        $order->street_address = $validated["street_address"];
        $order->city = $validated["city"];
        $order->user_id = Auth::user()->id;
        $order->payment_method=$validated['payment_method'];
        $order->save();

        $productInCarts= User::find(Auth::user()->id)->cartProducts;
        foreach($productInCarts as $productInCart){
            OrderDetail::create([
                'user_id'=> Auth::user()->id,
                "quantity"=>$productInCart->pivot->quantity,
                "total"=> $productInCart->product->price * $productInCart->pivot->quantity,
                "order_id"=> $order->id,
                "product_detail_id"=> $productInCart->id,
                "amount"=> $productInCart->product->price * $productInCart->pivot->quantity
            ]);
        }

        Cart::where("user_id",Auth::user()->id)->delete();

        if($request->payment_method =="pay_online"){
            $data_url = VNPAY::vnpay_create_payment([
                'vnp_TxnRef'=> $order->id,
                'vnp_OrderInfo'=>'Mô tả đơn hàng',  
                'vnp_Amount'=> $order->orderDetails()->sum('total'),
            ]);
            
            return redirect()->to($data_url);
        }

        
        return view('customer.checkout-result')->with("success","okee");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        return view("customer.my-order-detail")->with("order", $order);
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
