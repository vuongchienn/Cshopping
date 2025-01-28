
@extends('customer.layout.master')

@section('title','FAQs')

@section('content')



    <!-- Breadcrumb Logo Section Begin -->
    <div class ="breacrumb-section">
        <div class = 'container'>
            <div class="row">
                    <div class="col-lg-12">
                        <div class = "breadcrumb-text">
                            <a href = "#"><i class = "fa fa-home"></i>Home</a>
                            <span>FAQs</span>
                        </div>
                    </div>
            </div>
        </div>
    </div>



    <!-- FAQs section -->
    <div class ="faq-section spad">
        <div class ="container">
            <div class= "row">
                <div class= "col-lg-12">
                    <div class="faq-accordin">
                        <div class="accordion" id ="accordionExample">
                            <div class="card">
                                <div class= "card-heading active">
                                    <a class="active" data-toggle="collapse" data-target="#collapseOne">
                                        Is there Anything I Should Bring?
                                    </a>
                                </div>
                                <div class="collapse show" id ="collapseOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Lorem.....</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class= "card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">
                                        Is there Anything I Should Bring?
                                    </a>
                                </div>
                                <div class="collapse" id ="collapseTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Lorem.....</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class= "card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">
                                        Is there Anything I Should Bring?
                                    </a>
                                </div>
                                <div class="collapse" id ="collapseThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Lorem.....</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection