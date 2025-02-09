
@extends('customer.layout.master')

@section('title','Login')

@section('content')



    <!-- Breadcrumb Logo Section Begin -->
    <div class ="breacrumb-section">
        <div class = 'container'>
            <div class="row">
                    <div class="col-lg-12">
                        <div class = "breadcrumb-text">
                            <a href = "{{ Route('home') }}"><i class = "fa fa-home"></i>Home</a>
                            <span>Login</span>
                        </div>
                    </div>
            </div>
        </div>
    </div>


    <!-- Login section -->
    <div class ="register-login-section spad">
        <div class=  "container">
            <div class= "row">
                <div class ="col-lg-6 offset-lg-3">
                    <div class ="login-form">
                        <h2>Log in</h2>
                        <form action = "{{ Route('checkLogin') }}" method = "POST">
                            @csrf
                            <div class= "group-input">   
                                <label for="email">Email address *</label>
                                <input type = "text" id = "email" name ="email">
                               
                            </div>
                            <div class ="group-input">
                                <label for = "pass">Password *</label>
                                <input type= "password" id = "pass" name = "password">
                                
                            </div> 
                            <div class= "group-input gi-check">
                                <div class ="gi-more">
                                    <label for = "save-pass">
                                        Save password
                                        <input type= "checkbox" id= "save-pass" name = "remember">
                                        <span class= "checkmark"></span>
                                    </label>
                                    <a href = "#" class ="forget-pass">Forget your password</a>
                                </div>
                            </div> 
                            <button type ="submit" class="site-btn login-btn">Sign in</button>
                        </form>
                        <div class ="switch-login">
                            <a href = "{{ Route('registerView') }}" class= "or-login">Or create an account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
