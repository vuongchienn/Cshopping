
@extends('customer.layout.master')

@section('title','Shop')

@section('content')

    <!-- Breadcrumb Logo Section Begin -->
    <div class ="breacrumb-section">
        <div class = 'container'>
            <div class="row">
                    <div class="col-lg-12">
                        <div class = "breadcrumb-text">
                            <a href = "#"><i class = "fa fa-home"></i>Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
            </div>
        </div>
    </div>


    <!-- Product Shop section Begin  -->
    <section class = "product-shop spad">
       <div class = "container">
        <div class="row">
            <div class = "col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                <div class = "filter-widget">
                    <h4 class = "fw-title">Categories</h4>
                    <ul class = "filter-catagories">
                        @foreach($categories as $category)
                        <li><a href = "customer/category/{{ $category->name }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

              
                <div class = "filter-widget">
                    <h4 class = "fw-title">Tags</h4>
                    <div class  = "fw-tags">    
                        @foreach($tags as $tag)
                        <a href = "customer/tag/{{ $tag }}">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class = "col-lg-9 order-1 order-lg-2"> 
                <div class = "product-show-option">
                    <div class= "row" >
                        <div class = "col-lg-7 col-md-7">
                            <form action = "{{ Route('products.index') }}">
                                <div class = "select-option">
                                    <select class= "sorting" name = "sort_by" onchange="this.form.submit()">
                                        <option {{ request('sort_by')=='latest'?'selected':'' }} value= "newest">Newest</option>
                                        <option {{ request('sort_by')=='oldest'?'selected':'' }} value=  "oldest">Oldest</option>
                                        <option {{ request('sort_by')=='name-ascending'?'selected':'' }} value=  "name-ascending">Name: A-Z</option>
                                        <option {{ request('sort_by')=='name-descending'?'selected':'' }} value=  "name-descending">Name: Z-A</option>
                                        <option {{ request('sort_by')=='price-ascending'?'selected':'' }} value=  "price-ascending">Price: Ascending</option>
                                        <option {{ request('sort_by')=='price-descending'?'selected':'' }} value=  "price-descending">Price: Decrease</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class = "product-list ">
                    <div class = "row">
                        @foreach ($products as $product)
                        
                        <div class = "col-lg-4 col-sm-6">
                            <div class = "product-item">
                                <div class= "pi-pic">
                                    <img src = "{{ $product->productImages->isNotEmpty() ? asset('storage/' . $product->productImages->first()->path) : asset('./customer/img/products/man-1.jpg') }}" alt="{{ $product->name }}" alt = "">
                                    <div class = "sale pp-sale">Sale</div>
                                    <div class="icon">
                                        <i class = "icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        <li class=  "w-icon active"><a href = "{{ Route('cart.store',$product->id) }}"><i class=  "icon_bag_alt"></i></a></li>
                                        <li class = "quick-view"><a href = "{{ Route('products.show',$product->id) }}">+ Quick view</a></li>
                                        <li class = "w-icon"><a href = ""><i class = "fa fa-random"></i></a></li>
                                    </ul>
                                </div>
                                <div class=  "pi-text">
                                    <div class = "catagory-name">{{$product->category->name}}</div>
                                    <a href=  "#">
                                        <h5>{{ $product->name }}</h5>
                                    </a>
                                    <div class=  "product-price">
                                        ${{ $product->discount }}
                                        <span>${{ $product->price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>
                <div>
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div> 

       </div>
    </section>

@endsection