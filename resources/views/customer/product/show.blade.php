@extends('customer.layout.master')

@section('title','Product')

@section('content')

    <!-- Breadcrumb Logo Section Begin -->
    <div class ="breacrumb-section">
        <div class = 'container'>
            <div class="row">
                    <div class="col-lg-12">
                        <div class = "breadcrumb-text">
                            <a href = "{{ Route('home') }}"><i class = "fa fa-home"></i>Home</a>
                            <a href = "{{ Route('products.index') }}">Shop</a>
                            <span>Details</span>
                        </div>
                    </div>
            </div>
        </div>
    </div>



    {{-- Product Shop Section Begin --}}
    <section class= "product-shop spad page-details">
        <div class ="container">
            <div class = "row">
                <div class= "col-lg-12">
                    <div class= "row">
                        <div class = "col-lg-6">
                            <div class = "product-pic-zoom">
                                <img src=  "{{ $product->productImages->isNotEmpty() ? asset('storage/' . $product->productImages->first()->path) : asset('./customer/img/products/man-1.jpg') }}" alt="{{ $product->name }}" class = "product-big-img" alt = "">
                                <div class = "zoom-icon">
                                    <i class = "fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class = "product-thumbs">
                                <div class ="product-thumbs-track ps-slider owl-carousel">
                                    @foreach($product->productImages as $image)
                                        <div class ="pt active" data-imgbigurl ="{{ asset('storage/' . $image->path) }}">
                                            <img src= "{{ $product->productImages->isNotEmpty() ? asset('storage/' . $image->path) : asset('./customer/img/products/man-1.jpg') }}" alt="{{ $product->name }}" alt ="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class = "col-lg-6">
                            <div class= "product-details">
                                <div class = "pd-title">
                                    <span>{{ $product->tag }}</span>
                                    <h3>{{ $product->name }}</h3>
                                    <a href=  "#" class ="heart-icon"><i class = "icon_heart_alt"></i></a>
                                </div>

                                <div class = "pd-rating">
                                    @for($i=1;$i<=5;$i++)
                                        @if($i<=$product->avgRating)
                                            <i class = "fa fa-star"></i>
                                        @elseif($i-$product->avgRating<1)
                                            <i class = "fa fa-star-half"></i>
                                        @else
                                            <i class = "fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                    <span>{{ $product->avgRating }}</span>
                                    <span>({{ count($product->productComments) }})</span>
                                </div>

                                <div class = "pd-desc">
                                    <p>{{ $product->content }}</p>
                                    <h4>${{ $product->discount }}<span>${{ $product->price }}</span></h4>
                                </div>
                                <form action = "{{ Route('cart.store')}}" method = "POST"> 
                                    @csrf
                                <div class= "pd-color">
                                    <h6>Color</h6>
                                    <div class="pd-color-choose">
                                        @foreach(collect($product->productDetails)->pluck('color')->unique() as $color)
                                        <div class= "cc-item">
                                            <input type= "radio" id ="cc-{{ strtolower($color) }}" value = {{ $color }} name = "color"> 
                                            <label for = "cc-{{ strtolower($color) }}" class = "cc-{{ strtolower($color) }}"></label>
                                        </div>
                                        @endforeach
                                        @if ($errors->has('color'))
                                        <div class="text-danger">
                                            {{ $errors->first('color') }}
                                        </div>
                                    @endif
                                    </div>
                                </div>

                                <div class="pd-size-choose">
                                    @foreach(collect($product->productDetails)->pluck('size')->unique() as $size)
                                    <div class = "sc-item">
                                        <input type = "radio" id = "sm-{{ $size }}" value = "{{ $size }}" name = "size">
                                        <label for = "sm-{{ $size }}">{{ $size }}</label>
                                    </div>
                                    @endforeach
                                    @if ($errors->has('size'))
                                    <div class="text-danger">
                                        {{ $errors->first('size') }}
                                    </div>
                                @endif
                                </div>

                                <div class= "quantity">
                                      
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class= "quantity">
                                                <div class="pro-qty">
                                                    <input type= "text" name = 'quantity' value = "1">
                                                </div>
                                                <button type ="submit" class= "primary-btn pd-cart"><a>Add To Cart</a></button>
                                            </div>
                                </div>
                            </form>
                                <ul class= "pd-tags">
                                    <li>    
                                        <span>CATEGORIES</span>: {{ $product->category->name }}
                                    </li>
                                    <li>
                                        <span>TAGS</span>: {{ $product->tag }}
                                    </li>
                                    <li>
                                        <span>BRAND</span>: {{ $product->brand->name }}
                                    </li>
                                </ul>

                                <div class="pd-share">
                                    <div class=  "pd-social">
                                        <a href="#"><i class=  "ti-facebook"></i></a>
                                        <a href="#"><i class ="ti-twitter-alt"></i></a>
                                        <a href="#"><i class= "ti-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class= "product-tab">
                        <div class= "tab-item">
                            <ul class = "nav" role ="tablist">
                                <li><a class ="active" href="#tab-1" data-toggle="tab" role = "tab">DESCRIPTION</a></li>
                                <li><a href="#tab-2" data-toggle="tab" role = "tab">SPECIFICATION</a></li>
                                <li><a href="#tab-3" data-toggle="tab" role = "tab">Customer Reviews ({{ count($product->productComments) }})</a></li>
                            </ul>
                        </div>  
                        <div class ="tab-item-content">
                            <div class= "tab-content">
                                <div class = "tab-pane fade-in active" id= "tab-1" role = tabpanel>
                                    <div class ="product-content">
                                        <div class = "row">
                                            <div class= "col-lg-7">
                                                <p>{{ $product->description }}</p>
                                            </div>
                                            <div class ="col-lg-5">
                                                <img src = "customer/img/product-single/tab-desc.jpg" alt ="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class ="tab-pane fade" id = "tab-2" role=  "tabpanel">
                                    <div class ="specification-table">
                                        <table>
                                            <tr>
                                                <td class ="p-catagory">Customer Rating</td>
                                                <td>
                                                    
                                                    <div class = "pd-rating">
                                                        @for($i=1;$i<=5;$i++)
                                                            @if($i<=$product->avgRating)
                                                                <i class= "fa fa-star"></i>
                                                            @elseif($i-$product->avgRating<1)
                                                                <i class = "fa fa-star-half"></i>
                                                            @else
                                                                <i class= "fa fa-star-o"></i>
                                                            @endif
                                                        @endfor
                                                        <span>({{ count($product->productComments) }})</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class = "p-catagory">Price</td>
                                                <td> 
                                                    <div class = "p-price">
                                                        ${{ $product->price }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class= "p-catagory">Add To Cart</td>
                                                <td>
                                                    <div class ="cart-add">
                                                        +Add To Cart
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class= "p-catagory">Availability</td>
                                                <td>
                                                    <div class = "p-stock">
                                                        {{ $product->quantity }} in stock
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class ="p-catagory">Weight</td>
                                                <td>
                                                    <div class ="p-weight">
                                                        {{ $product->weight }}kg
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class ="p-catagory">Size</td>
                                                <td>
                                                    <div class ="p-size">
                                                        @foreach(collect($product->productDetails)->pluck('size')->unique() as $size)
                                                        {{ $size}}
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class = "p-catagory">Color</td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <div class="filter-widget" style="display: flex; justify-content: center;">
                                                        <div class="fw-color-choose" style="display: flex; gap: 10px; justify-content: center;">
                                                            <div class="cs-item" style="display: flex; gap: 10px;">
                                                                @foreach(collect($product->productDetails)->pluck('color')->unique() as $color)
                                                                    <label class="cs-{{ strtolower($color) }}" style="display: inline-block; width: 18px; height: 18px; border-radius: 50%;"></label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class ="tab-pane fade" id = "tab-3" role = "tabpanel">
                                    <div class= "customer-review-option">
                                        @if(count($product->productComments)>1)
                                        <h4>{{ count($product->productComments) }} Comments</h4>
                                        @else
                                        <h4>{{ count($product->productComments) }} Comment</h4>
                                        @endif
                                        <div class ="comment-option">
                                            @foreach($product->productComments as $pComment)
                                            <div class ="co-item">
                                                <div class = "avatar-pic">
                                                   
                                                        <img src = "{{ asset(path: 'storage/'. $pComment->user->avatar)}}" alt = "">
                                                   
                                                </div>
                                                <div class = "avatar-text">
                                                    <div class= "at-rating">
                                                        @for($i=1;$i<=5;$i++)
                                                            @if($i<=$pComment->rating)
                                                                <i class ="fa fa-star"></i>
                                                            @else
                                                                <i class ="fa fa-star-o"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <h5>{{ $pComment->user->name }}<span>{{ $pComment->created_at }}</span></h5>
                                                    <div class= "at-reply">{{ $pComment->message }}</div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                       
                                        <div class ="leave-comment">
                                            <h4>Leave A Commet</h4>
                                            <form action = "{{ Route("comments.store") }}" method = "POST" class = comment-form>
                                                @csrf
                                                <div class = "row">
                                                    <div class ="col-lg-12">
                                                        <input type = "hidden" value = "{{ $product->id }}" name= "product_id">
                                                        <textarea placeholder = "Messages" name = "message"></textarea>
                                                        <div class = "personal-rating">
                                                                <div class="rate">
                                                                    <input type="radio" id="star5" name="rating" value="5" />
                                                                    <label for="star5" title="text">5 stars</label>
                                                                    <input type="radio" id="star4" name="rating" value="4" />
                                                                    <label for="star4" title="text">4 stars</label>
                                                                    <input type="radio" id="star3" name="rating" value="3" />
                                                                    <label for="star3" title="text">3 stars</label>
                                                                    <input type="radio" id="star2" name="rating" value="2" />
                                                                    <label for="star2" title="text">2 stars</label>
                                                                    <input type="radio" id="star1" name="rating" value="1" />
                                                                    <label for="star1" title="text">1 star</label>
                                                                </div>
                                                        </div>
                                                        <button type=  "submit" class = "site-btn">Send message</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
        

    {{-- Related product section --}}
    <div class = "related-products spad">
        <div class = "container">
            <div class ="row">
                <div class ="col-lg-12">
                    <div class= "section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class ="row">
                @foreach($product->relatedProducts as $relatedProduct)
                <div class ="col-lg-3 col-sm-6">
                    <div class = "product-item">
                        <div class= "pi-pic">
                            <img src = "{{ asset('storage/'.$relatedProduct->productImages->first()->path) }}" alt = "">
                            @if($relatedProduct->discount != 0)
                                <div class = "sale pp-sale">Sale</div>
                            @endif
                            <div class="icon">
                                <i class = "icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class=  "w-icon active"><a href = "#"><i class=  "icon_bag_alt"></i></a></li>
                                <li class = "quick-view"><a href = "{{ Route('products.show',$relatedProduct->id) }}">+ Quick view</a></li>
                                <li class = "w-icon"><a href = ""><i class = "fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class=  "pi-text">
                            <div class = "catagory-name">{{ $relatedProduct->category->name }}</div>
                            <a href=  "#">
                                <h5>{{ $relatedProduct->name }}</h5>
                            </a>
                            <div class=  "product-price">
                                ${{ $relatedProduct->discount }}
                                <span>${{ $relatedProduct->price }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
   
@endsection
