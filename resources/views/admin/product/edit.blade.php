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
                                    Product
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
                                    <form method="POST" action = "{{ Route('product.update',$product->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="position-relative row form-group">
                                            <label for="brand_id"
                                                class="col-md-3 text-md-right col-form-label">Brand</label>
                                            <div class="col-md-9 col-xl-8">
                                                <select  name="brand_id" id="brand_id" class="form-control">
                                                    <option value="{{ $product->brand->id }}">{{ $product->brand->name }}</option>
                                                    @foreach($brands as $brand)
                                                        @if($brand->id != $product->brand->id)
                                                            <option value={{ $brand->id }}>
                                                                {{ $brand->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                    @if ($errors->has('brand_id'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('brand_id') }}
                                                        </div>
                                                    @endif
                                            </div>
                                        </div>
                                       

                                        <div class="position-relative row form-group">
                                            <label for="category_id"
                                                class="col-md-3 text-md-right col-form-label">Category</label>
                                            <div class="col-md-9 col-xl-8">
                                                <select  name="category_id" id="category_id" class="form-control">
                                                    <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
                                                    @foreach($categories as $category)
                                                        @if($category->id!=$product->category->id)
                                                            <option value={{ $category->id }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('category_id'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('category_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    
                                        <div class="position-relative row form-group">
                                            <label for="name" class="col-md-3 text-md-right col-form-label">Name</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input  name="name" id="name" placeholder="Name" type="text"
                                                    class="form-control" value="{{ $product->name }}">
                                                    @if ($errors->has('name'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('name') }}
                                                        </div>
                                                    @endif
                                            </div>
                                           
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="content"
                                                class="col-md-3 text-md-right col-form-label">Content</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input  name="content" id="content"
                                                    placeholder="Content" type="text" class="form-control" value="{{ $product->content }}">
                                                    @if ($errors->has('content'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('content') }}
                                                        </div>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="price"
                                                class="col-md-3 text-md-right col-form-label">Price</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input  name="price" id="price"
                                                    placeholder="Price" type="text" class="form-control" value="{{ $product->price }}">
                                                    @if ($errors->has('price'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('price') }}
                                                        </div>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="discount"
                                                class="col-md-3 text-md-right col-form-label">Discount</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input  name="discount" id="discount"
                                                    placeholder="Discount" type="text" class="form-control" value="{{ $product->discount }}">
                                                    @if ($errors->has('discount'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('discount') }}
                                                        </div>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="weight"
                                                class="col-md-3 text-md-right col-form-label">Weight</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input  name="weight" id="weight"
                                                    placeholder="Weight" type="text" class="form-control" value="{{ $product->weight }}">
                                                    @if ($errors->has('weight'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('weight') }}
                                                        </div>
                                                    @endif
                                            </div>
                                        </div>


                                        <div class="position-relative row form-group">
                                            <label for="tag"
                                                class="col-md-3 text-md-right col-form-label">Tag</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input  name="tag" id="tag"
                                                    placeholder="Tag" type="text" class="form-control" value="{{ $product->tag }}">
                                                    @if ($errors->has('tag'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('tag') }}
                                                        </div>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="featured"
                                                class="col-md-3 text-md-right col-form-label">Featured</label>
                                            <div class="col-md-9 col-xl-8">
                                                <div class="position-relative form-check pt-sm-2">
                                                    <input name="featured" id="featured" type="checkbox" value="1" class="form-check-input" {{ $product->featured ==1?'checked':'' }}>
                                                    <label for="featured" class="form-check-label">Featured</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="position-relative row form-group">
                                            <label for="description"
                                                class="col-md-3 text-md-right col-form-label">Description</label>
                                            <div class="col-md-9 col-xl-8">
                                                <textarea class="form-control" name="description" id="description" placeholder="Description" >{{ $product->description }}</textarea>
                                                @if ($errors->has('description'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('description') }}
                                                        </div>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group mb-1">
                                            <div class="col-md-9 col-xl-8 offset-md-2">
                                                <a href="{{ Route('product.index') }}" class="border-0 btn btn-outline-danger mr-1">
                                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                                        <i class="fa fa-times fa-w-20"></i>
                                                    </span>
                                                    <span>Cancel</span>
                                                </a>

                                                <button type="submit"
                                                    class="btn-shadow btn-hover-shine btn btn-primary">
                                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                                        <i class="fa fa-download fa-w-20"></i>
                                                    </span>
                                                    <span>Save</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
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