@extends('customer.layout.master')

@section('title','Shopping Cart')

@section('content')


    <!-- Breadcrumb Logo Section Begin -->
    <div class ="breacrumb-section">
        <div class = 'container'>
            <div class="row">
                    <div class="col-lg-12">
                        <div class = "breadcrumb-text">
                            <a href = "{{ Route('home') }}"><i class = "fa fa-home"></i>Home</a>
                            <a href = "{{ Route('products.index') }}">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Shopping Cart Section -->
    <div class = "shopping-cart spad">
        <div class = "container">
            <div class= "row">
                <div class= "col-lg-12">
                    <div class=  "cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class = "p-name">Product Name</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalPrice = 0
                                @endphp
                                @foreach($productInCarts as $productInCart)
                                                        @php
                                                        $totalPrice += $productInCart->pivot->quantity * $productInCart->product->price;
                                                        @endphp
                                    <tr>
                                        <td class ="cart-pic first-row"><img src= "{{ asset('storage/' . $productInCart->product->productImages->first()->path) }}" alt =""></td>
                                        <td class= "cart-title first-row">
                                            <h5>{{ $productInCart->product->name }}</h5>
                                        </td>
                                        <td class= "cart-title first-row">
                                            <h6>{{ $productInCart->color}}</h5>
                                        </td>
                                        <td class= "cart-title first-row">
                                            <h6>{{ $productInCart->size}}</h5>
                                        </td>
                                        <td class="p-price first-row" data-price="{{ $productInCart->product->price }}">${{ $productInCart->product->price }}</td>
                                        <td class="qua-col first-row">
                                            <div class="quantity">
                                                <div >
                                                    <input type="text" class="styled-input"  value="{{ $productInCart->pivot->quantity }}" readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="total-price first-row">${{ ($productInCart->pivot->quantity * $productInCart->product->price) }}</td>

                                        <form action = {{ Route('cart.destroy',$productInCart->product->id) }} method = "POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type= "hidden" value = "{{ $productInCart->color }}" name = "color">
                                            <input type= "hidden" value = "{{ $productInCart->size }}" name = "size">
                                            <td class= "close-td first-row"><button style = "border:none;background:white;" type = "submit"><i class= "ti-close"></i></button></td>
                                        </form>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>

                    <div class = "row">
                        <div class = "col-lg-4">
                            <div class= "cart-buttons">
                                <a href = "{{ Route('products.index') }}" class= "primary-btn continue-shop">Continue shopping</a>
                            
                            </div>
                            <div class = "discount-coupon">
                                <h6>Discount Codes</h6>
                                <form action = "#" class ="coupon-form">
                                    <input type = "text" placeholder= "Enter your codes">
                                    <button type= "submit" class= "site-btn coupon-btn">Apply</button>
                                </form>
                            </div>
                        </div>
                        <div class= "col-lg-4 offset-lg-4">
                            <div class = "proceed-checkout">
                                <ul>
                                    <li class = "subtotal">Subtotal<span>${{ $totalPrice }}</span></li>
                                    <li class = "cart-total">Total<span>${{ $totalPrice }}</span></li>
                                </ul>
                                <a href=  "{{ Route('check-out.index') }}" class = "proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
@endsection