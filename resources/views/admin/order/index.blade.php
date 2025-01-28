
@extends('admin.layout.master')

@section('content')
                <!-- Main -->
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                                </div>
                                <div>
                                    Order
                                    <div class="page-title-subheading">
                                        View, create, update, delete and manage.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">

                                <div class="card-header">

                                    <form action = {{ Route('searchOrder') }} method = "POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="search" name="search" id="search"
                                                placeholder="Search everything" class="form-control">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-search"></i>&nbsp;
                                                    Search
                                                </button>
                                            </span>
                                        </div>
                                    </form>

                                   
                                </div>

                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>

                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th>Customer / Products</th>
                                                <th class="text-center">Address</th>
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                            <tr>
                                                <td class="text-center text-muted">#{{ $order->id }}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <div class="widget-content-left">
                                                                    
                                                                    <img style="height: 60px;"
                                                                        data-toggle="tooltip" title="Image"
                                                                        data-placement="bottom"
                                                                        src="{{ asset('storage/' . $order->orderDetails->first()->productDetail->product->productImages->first()->path) }}" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading">{{ $order->first_name. ' '. $order->last_name }}</div>
                                                                <div class="widget-subheading opacity-7">
                                                                    {{ $order->orderDetails->first()->productDetail->product->name }}
                                                                    @if(count($order->orderDetails)>1)
                                                                        (and {{ count($order->orderDetails)-1 }} other products)
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    {{ $order->steet_address }} - {{ $order->city }}
                                                </td>
                                                <td class="text-center">${{ array_sum(array_column($order->orderDetails->toArray(),'total')) }}</td>
                                                <td class="text-center">
                                                    <div class="badge badge-dark">
                                                        @if($order->status ==1)
                                                            Preparing
                                                        @elseif($order->status ==2)
                                                            Shipping
                                                        @else
                                                            Finish
                                                        @endif
                                                        
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ Route('orders.show',$order->id) }}"
                                                        class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                                        Details
                                                    </a>
                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-block card-footer">
                                    {{ $orders->links('pagination::bootstrap-5') }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Main -->
@endsection


@section('sidebar')
<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Menu</li>

            <li class="mm-active">
                <a href="#">
                    <i class="metismenu-icon pe-7s-plugin"></i>Applications
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="{{ Route('users.index') }}" >
                            <i class="metismenu-icon"></i>User
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route('orders.index') }}" class="mm-active">
                            <i class="metismenu-icon"></i>Order
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route('product.index') }}">
                            <i class="metismenu-icon"></i>Product
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route('categories.index') }}" >
                            <i class="metismenu-icon"></i>Category
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route('brands.index')  }}" >
                            <i class="metismenu-icon"></i>Brand
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@endsection