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
                                    Product Images
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
                                <div class="card-body">

                                    <div class="position-relative row form-group">
                                        <label for="name" class="col-md-3 text-md-right col-form-label">Product Name</label>
                                        <div class="col-md-9 col-xl-8">
                                            <input disabled placeholder="Product Name" type="text"
                                                class="form-control" value="{{ $product->name }}">
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="" class="col-md-3 text-md-right col-form-label">Images</label>
                                        <div class="col-md-9 col-xl-8">
                                            <ul class="text-nowrap" id="images">

                                                @foreach($productImages as $productImage)
                                                    <li class="float-left d-inline-block mr-2 mb-2" style="position: relative; width: 32%;">


                                                      
                                                            <button type="submit" 
                                                           
                                                            class="btn btn-sm btn-outline-danger border-0 position-absolute"
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $productImage->id }}">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        
                                                        <div class="modal fade" id="deleteModal{{ $productImage->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $productImage->id }}" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel{{ $productImage->id }}">Cảnh báo</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có muốn xóa ảnh này không ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form id="deleteForm{{ $productImage->id }}" action="./admin/product/{{ $product->id }}/image/{{ $productImage->id}}" method="POST" style="display: inline-block;">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-danger">Có</button>
                                                                        </form>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div style="width: 100%; height: 220px; overflow: hidden;">
                                                            <img  src="{{ asset('storage/' . $productImage->path) }}"
                                                            alt="Image">
                                                        </div>
                                                    </li>
                                                @endforeach

                                                <li class="float-left d-inline-block mr-2 mb-2" style="width: 32%;">
                                                    <form method="POST" action = "admin/product/{{ $product->id }}/image" enctype="multipart/form-data">
                                                        @csrf
                                                        <div style="width: 100%; max-height: 220px; overflow: hidden;">
                                                            <img style="width: 100%; cursor: pointer;" 
                                                                class="thumbnail"
                                                                data-toggle="tooltip" title="Click to add image" data-placement="bottom"
                                                                src="admin/assets/images/add-image-icon.jpg" alt="Add Image">

                                                            <input name="image" type="file" onchange="changeImg(this); this.form.submit()"
                                                                accept="image/x-png,image/gif,image/jpeg"
                                                                class="image form-control-file" style="display: none;">

                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        </div>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group mb-1">
                                        <div class="col-md-9 col-xl-8 offset-md-3">
                                            <a href="#" class="btn-shadow btn-hover-shine btn btn-primary">
                                                <span class="btn-icon-wrapper pr-2 opacity-8">
                                                    <i class="fa fa-check fa-w-20"></i>
                                                </span>
                                                <span>OK</span>
                                            </a>
                                        </div>
                                    </div>

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
                        <a href="{{ Route('orders.index') }}" >
                            <i class="metismenu-icon"></i>Order
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route('product.index') }}" class="mm-active">
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