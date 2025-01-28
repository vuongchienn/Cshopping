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

                    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                        <li class="nav-item">
                            <a href="{{ Route('users.edit',$user->id) }}" class="nav-link">
                                <span class="btn-icon-wrapper pr-2 opacity-8">
                                    <i class="fa fa-edit fa-w-20"></i>
                                </span>
                                <span>Edit</span>
                            </a>
                        </li>

                        <li class="nav-item delete">
                    
                                <button class="nav-link btn" type="submit" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-trash fa-w-20"></i>
                                    </span>
                                    <span>Delete</span>
                                </button>


                                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel{{ $user->id }}">Cảnh báo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có muốn xóa cầu thủ <strong>{{ $user->name }}</strong> không ?
                                            </div>
                                            <div class="modal-footer">
                                                <form id="deleteForm{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Có</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                      
                        </li>
                    </ul>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body display_data">
                                    <div class="position-relative row form-group">
                                        <label for="image" class="col-md-3 text-md-right col-form-label">Avatar</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>
                                                <img style="height: 200px;" class="rounded-circle" data-toggle="tooltip"
                                                    title="Avatar" data-placement="bottom"
                                                    src="assets/images/_default-user.png" alt="Avatar">
                                            </p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="name" class="col-md-3 text-md-right col-form-label">
                                            Name
                                        </label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{ $user->name }}</p>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                                        <div class="col-md-9 col-xl-8">
                                            <p>{{ $user->email }}</p>
                                        </div>
                                    </div>


                                    <div class="position-relative row form-group">
                                        <label for="level" class="col-md-3 text-md-right col-form-label">Level</label>
                                        <div class="col-md-9 col-xl-8">
                                            @if($user->role==1)
                                                <p> Amin</p>
                                            @elseif($user->role ==2)
                                                <p>Customer</p>
                                            @endif
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