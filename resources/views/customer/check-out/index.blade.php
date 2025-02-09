@extends('customer.layout.master')

@section('title','Check Out')

@section('content')



    <!-- Breadcrumb Logo Section Begin -->
    <div class ="breacrumb-section">
        <div class = 'container'>
            <div class="row">
                    <div class="col-lg-12">
                        <div class = "breadcrumb-text">
                            <a href = "{{ Route('home') }}"><i class = "fa fa-home"></i>Home</a>
                            <a href = "{{ Route('products.index') }}">Shop</a>
                            <span>Check out</span>
                        </div>
                    </div>
            </div>
        </div>
    </div>


    <!-- Checkout section -->
    <div class = "checkout-section spad">
        <div class= "container">
            <form action = "{{ Route('order.store') }}" method ="POST" class="checkout-form" >
                @csrf
                <div class="row">
                    <div class ="col-lg-6">
                        <div class= "checkout-content">
                            <a href = "login.html" class="content-btn">Click here to login</a>
                        </div>
                        <h4>Biiling Details</h4>
                        <div class= "row">
                            <div class= "col-lg-6">
                                <label for = "fir">First Name<span>*</span></label>
                                <input type= "text" id ="fir" name='first_name'> 
                                @error('first_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class= "col-lg-6">
                                <label for = "last">Last Name<span>*</span></label>
                                <input type= "text" id ="lastlast" name= "last_name"> 
                                @error('last_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                
                            <div class= "col-lg-12">
                                <label for = "street">Street Address<span>*</span></label>
                                <input type= "text" id ="street" class="street-first" name = "street_address">
                                @error('street_address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
            
                            <div class= "col-lg-12">
                                <label for = "town">City<span>*</span></label>
                                <input type= "text" id ="town" name = "city"> 
                                @error('city')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class= "col-lg-6">
                                <label for = "email">Email Address<span>*</span></label>
                                <input type= "text" id ="email" name = "email"> 
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class= "col-lg-6">
                                <label for = "phone">Phone<span>*</span></label>
                                <input type= "text" id ="phone" name = "phone"> 
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class= 'col-lg-12'>
                                <div class= "create-item">
                                    <label for="acc-create">
                                        Create an account?
                                        <input type=  "checkbox" id = "acc-create">
                                        <span class= "checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class ="col-lg-6">
                        <div class="checkout-content">
                            <input type = "text" placeholder="Enter Your Coupon Code">
                        </div>
                        <div class ="place-order">
                            <h4>
                                Your Order
                            </h4>
                            <div class = "order-total">
                                <ul class = "order-table">
                                    <li>Product<span>Total</span></li>   
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                  
                                    @foreach($productInCarts as $productInCart)
                                        @php
                                            $totalPrice += $productInCart->pivot->quantity * $productInCart->product->price;
                                        @endphp
                                        <li class = "fw-normal">{{ $productInCart->product->name }} x {{ $productInCart->pivot->quantity }} <span>${{ $productInCart->product->price*$productInCart->pivot->quantity }}</span></li>
                                    @endforeach

                                    <li class = "fw-normal">Subtotal<span>${{ $totalPrice }}</span></li>
                                    <li class = "total-price">Total<span>${{ $totalPrice }}</span></li>
                                </ul>
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="pc-check">
                                            Pay later
                                            <input type="radio" id="pc-check" name="payment_method" value="pay_later">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            Pay online
                                            <input type="radio" id="pc-paypal" name="payment_method" value="pay_online">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class ="order-btn">
                                    <button {{ is_null($productInCarts->first()) ? 'disabled' : '' }}  type="submit" class ="site-btn place-btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
