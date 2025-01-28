
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
                                    User
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
                                    <form method="POST" action = "{{ Route('users.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="position-relative row form-group">
                                            <label for="image"
                                                class="col-md-3 text-md-right col-form-label">Avatar</label>
                                            <div class="col-md-9 col-xl-8">
                                                <img style="height: 200px; cursor: pointer;"
                                                    class="thumbnail rounded-circle" data-toggle="tooltip"
                                                    title="Click to change the image" data-placement="bottom"
                                                    src="assets/images/add-image-icon.jpg" alt="Avatar">
                                                <input name="image" type="file" onchange="changeImg(this)"
                                                    class="image form-control-file" style="display: none;" value="">
                                                <input type="hidden" name="image_old" value="">
                                                <small class="form-text text-muted">
                                                    Click on the image to change (required)
                                                </small>
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="name" class="col-md-3 text-md-right col-form-label">Name</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input name="name" id="name" placeholder="Name" type="text"
                                                    class="form-control" >
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="email"
                                                class="col-md-3 text-md-right col-form-label">Email</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input  name="email" id="email" placeholder="Email" type="email"
                                                    class="form-control" >
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="password"
                                                class="col-md-3 text-md-right col-form-label">Password</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input name="password" id="password" placeholder="Password" type="password"
                                                    class="form-control" >
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="con-password"
                                                class="col-md-3 text-md-right col-form-label">Confirm Password</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input name="con-password" id="con-password" placeholder="Confirm Password" type="password"
                                                    class="form-control">
                                            </div>
                                        </div>


                                        <div class="position-relative row form-group">
                                            <label for="role"
                                                class="col-md-3 text-md-right col-form-label">Role</label>
                                            <div class="col-md-9 col-xl-8">
                                                <select required name="role" id="role" class="form-control">
                                                    <option value="">-- Role --</option>
                                                    <option value=1>
                                                        Admin
                                                    </option>
                                                    <option value=2>
                                                        Customer
                                                    </option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="position-relative row form-group mb-1">
                                            <div class="col-md-9 col-xl-8 offset-md-2">
                                                <a href="javascript:history.back()" class="border-0 btn btn-outline-danger mr-1">
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
                        <a href="{{ Route('users.index') }}" class="mm-active">
                            <i class="metismenu-icon"></i>User
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route('orders.index') }}" >
                            <i class="metismenu-icon"></i>Order
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route('product.index') }}" >
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