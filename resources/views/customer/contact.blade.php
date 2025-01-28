
@extends('customer.layout.master')

@section('title','Contact')

@section('content')

    <!-- Breadcrumb Logo Section Begin -->
    <div class ="breacrumb-section">
        <div class = 'container'>
            <div class="row">
                    <div class="col-lg-12">
                        <div class = "breadcrumb-text">
                            <a href = "#"><i class = "fa fa-home"></i>Home</a>
                            <span>Contact</span>
                        </div>
                    </div>
            </div>
        </div>
    </div>


    <!-- Map section -->
    <div class= "map-spad">
        <div class= "container">
            <div class ="map-inner">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29793.98845886396!2d105.81636411800973!3d21.02273835998302!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab9bd9861ca1%3A0xe7887f7b72ca17a9!2zSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1737602655357!5m2!1svi!2s" 
                width="600" height="610" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>

                <div class ="icon">
                    <i class ="fa fa-map-marker"></i>
                </div>
            </div>
        </div>
    </div>


    <!-- Contact section -->
    <section class= "contact-section spad">
        <section class ="container">
            <div class= "row">
                <div class= "col-lg-5">
                    <div class= "contact-title">
                        <h4>Contacts Us</h4>
                        <p>ewrwerwefsfadfwefwfwefwfwyretgrgr</p>
                    </div>
                    <div class="contact-widget">
                        <div class ="cw-item">
                            <div class ="ci-icon">
                                <i class ="ti-location-pin"></i>
                            </div>
                            <div class ="ci-text">
                                <span>Address:</span>
                                <p>Ha Noi</p>
                            </div>
                        </div>

                        <div class ="cw-item">
                            <div class ="ci-icon">
                                <i class ="ti-mobile"></i>
                            </div>
                            <div class ="ci-text">
                                <span>Phone:</span>
                                <p>0123456789</p>
                            </div>
                        </div>

                        <div class ="cw-item">
                            <div class ="ci-icon">
                                <i class ="ti-email"></i>
                            </div>
                            <div class ="ci-text">
                                <span>Email:</span>
                                <p>dfas@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class= "col-lg-6 offset-lg-1">
                    <div class="contact-form">
                        <div class ="leave-comment">
                            <h4>Leave A Comment</h4>
                            <p>Our Staff will call back later and answer your questions</p>
                            <form action = "#" class="comment-form">
                                <div class= "row">
                                    <div class= "col-lg-6">
                                        <input type ="text" placeholder="Your name">
                                    </div>
                                    <div class= "col-lg-6">
                                        <input type ="text" placeholder="Your email">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea placeholder="Your message"></textarea>
                                        <button type= "submit" class="site-btn">Send message</button>
                                    </div>
                                </div>
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>


@endsection
