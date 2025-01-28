@extends('customer.layout.master')

@section('title','Shopping Cart')

@section('content')
       
        <div class ="register-login-section spad">
            <div class=  "container">
                <div class= "row">
                    <div class ="col-lg-6 offset-lg-3">
                        <div class ="register-form">
                            <h2>Register</h2>
                            <form action = "{{ Route('avatar.store') }}" method = "POST" enctype="multipart/form-data">
                               
                                @csrf
                                <input type="file" name="image" accept="image/*" required>
                                <br>
                                <button type="submit" class="site-btn register-btn">Upload</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
@endsection