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

{{-- Myorder section --}}

<div class = "shopping-cart spad">
    <div class = "container">
        <div class= "row">
            <div class= "col-lg-12">
                <div class=  "cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th class = "p-name">ID</th>
                                <th>Product</th>
                                <th>Total</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                                   
                                <tr>
                               
                                    <td  class ="cart-pic first-row"><img src= "{{ asset('storage/' . $order->orderDetails->first()->productDetail->product->productImages->first()->path) }}" alt =""></td>
                                    <td  class ='first-row'>#{{ $order->id }}</td>
                                    <td style ="text-align:center;" class= "cart-title first-row ">
                                        <h5>{{ $order->orderDetails->first()->productDetail->product->name }} 
                                            @if(count($order->orderDetails) >1)
                                            and 
                                            {{ count($order->orderDetails)-1 }}
                                            other products</h5>
                                            @endif
                                             
                                    </td>
                                  
                                   
                                    <td class="total-price first-row">${{array_sum(array_column($order->orderDetails->toArray(),'total'))}}</td>
                                    <td  class ="first-now">
                                        <a class ="btn" href ="{{ Route('order.show',$order->id) }}">Details</a>
                                    </td>

                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>

             
            </div>
        </div>
    </div>
</div>
    
@endsection