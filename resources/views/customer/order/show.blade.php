@extends('customer.layout.master')

@section('title','Shopping Cart')

@section('content')


    <!-- Breadcrumb Logo Section Begin -->
    <div class ="breacrumb-section">
        <div class = 'container'>
            <div class="row">
                    <div class="col-lg-12">
                        <div class = "breadcrumb-text">
                            <a href = "#"><i class = "fa fa-home"></i>Home</a>
                            <span>My order</span>
                        </div>
                    </div>
            </div>
        </div>
    </div>


    <div class = "checkout-section spad">
    <div class= "container">
        <form action = "{{ Route('order.store') }}" method ="POST" class="checkout-form" >
            @csrf
            <div class="row">
                <div class ="col-lg-6">
                    <div class= "checkout-content">
                        
                        <div class="content-btn">
                            ID:
                            <b>#{{ $order->id }}</b>
                        </div>
                    </div>
                    <h4>Biiling Details</h4>
                    <div class= "row">
                        <div class= "col-lg-6">
                            <label for = "fir">First Name</label>
                            <input disabled type= "text" id ="fir" name='first_name' value ="{{ $order->first_name }}"> 
                        </div>
                        <div class= "col-lg-6">
                            <label for = "last">Last Name</label>
                            <input disabled type= "text" id ="lastlast" name= "last_name" value = "{{ $order->last_name }}" > 
                        </div>
            
                        <div class= "col-lg-12">
                            <label for = "street">Street Address</label>
                            <input disabled type= "text" id ="street" class="street-first" name = "street_address" value = "{{ $order->street_address }}">
                        </div>
        
                        <div class= "col-lg-12">
                            <label for = "town">City<span>*</span></label>
                            <input disabled type= "text" id ="town" name = "city" value = "{{ $order->city }}"> 
                        </div>
                        <div class= "col-lg-6">
                            <label for = "email">Email Address<span>*</span></label>
                            <input disabled type= "text" id ="email" name = "email" value ="{{ $order->email }}"> 
                        </div>
                        <div class= "col-lg-6">
                            <label for = "phone">Phone<span>*</span></label>
                            <input disabled type= "text" id ="phone" name = "phone" value = "{{ $order->phone }}"> 
                        </div>
                    </div>
                </div>
                <div class ="col-lg-6">
                    <div class="checkout-content">
                        <a href = "#" class = "content-btn">
                            Status:
                            <b>
                                @if($order->status == 1)
                                    Preparing the order
                                @elseif($order->status == 2)
                                    Shipping the order
                                @else
                                    Order delivered successfully
                                @endif
                            </b>
                        </a>
                    </div>
                    <div class ="place-order">
                        <h4>
                            Your Order
                        </h4>
                        <div class = "order-total">
                            <ul class = "order-table">
                                <li>Product<span>Total</span></li>   
                                @foreach($order->orderDetails as $orderDetail)
                                    <li class = "fw-normal">{{ $orderDetail->productDetail->product->name }} x {{ $orderDetail->quantity }} <span>${{ $orderDetail->total }}</span></li>
                                @endforeach

                              
                                <li class = "total-price">Total<span>${{ array_sum(array_column($order->orderDetails->toArray(),'total'))}}</span></li>
                            </ul>
                            <div class="payment-check">
                                <div class="pc-item">
                                    <label for="pc-check">
                                        Pay later
                                        <input disable type="radio" id="pc-check" name="payment_method" value="pay_later" {{ $order->payment_method == 'pay_later'?'checked':'' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="pc-item">
                                    <label for="pc-paypal">
                                        Pay online
                                        <input disable type="radio" id="pc-paypal" name="payment_method" value="pay_online" {{ $order->payment_method == 'pay_online'?'checked':'' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection