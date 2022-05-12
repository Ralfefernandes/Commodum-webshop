@extends('layouts.frontend')
@section('styles')
@endsection
@section('content')


<!--====== DISCOUNT PRODUCT PART ENDS ======-->

<!--====== PRODUCT PART START ======-->

<section id="product" class="product-area pt-100 pb-130">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-furniture" role="tabpanel" aria-labelledby="v-pills-furniture-tab">
                        <div class="product-items mt-30">
                            <div class="row product-items-active">
                                @if (isset($products))
                                @foreach ($products as $product1)                                        
                                <div class="col-md-4">
                                    <div class="single-product-items">
                                        <div class="product-item-image">
                                            <a href="#"><img src="{{$product1->image_name}}" alt="Product"></a>
                                            <div class="product-discount-tag">
                                                <p>-60%</p>
                                            </div>
                                        </div>
                                        <div class="product-item-content text-center mt-30">
                                            <h5 class="product-title"><a href="#">{{$product1->name}}</a></h5>
                                            <ul class="rating">
                                                <li><i class="lni-star-filled"></i></li>
                                                <li><i class="lni-star-filled"></i></li>
                                                <li><i class="lni-star-filled"></i></li>
                                                <li><i class="lni-star-filled"></i></li>
                                            </ul>
                                            <span class="regular-price">{{$product1->sale_price}}</span>
                                            <span class="discount-price">{{$product1->price}}</span>                                            
                                            <add-to-cart-button product-id="{{$product1->id}}"
                                                user-id="{{auth()->user()->id ?? '0'}}"/>
                                        </div>
                                    </div> <!-- single product items -->
                                </div>
                                @endforeach
                                @endif
                            </div> 
                            <!-- row -->
                            <br>
                            {{-- new row --}}
                            <div class="row product-items-active">
                                @if (isset($products))
                                @foreach ($products as $product2)                                        
                                <div class="col-md-4">
                                    <div class="single-product-items">
                                        <div class="product-item-image">
                                            <a href="#"><img src="{{$product2->image_name}}" alt="Product"></a>
                                            <div class="product-discount-tag">
                                                <p>-60%</p>
                                            </div>
                                        </div>
                                        <div class="product-item-content text-center mt-30">
                                            <h5 class="product-title"><a href="#">{{$product2->name}}</a></h5>
                                            <ul class="rating">
                                                <li><i class="lni-star-filled"></i></li>
                                                <li><i class="lni-star-filled"></i></li>
                                                <li><i class="lni-star-filled"></i></li>
                                                <li><i class="lni-star-filled"></i></li>
                                            </ul>
                                            <span class="regular-price">{{$product2->sale_price}}</span>
                                            <span class="discount-price">{{$product2->price}}</span>                                            
                                            <add-to-cart-button product-id="{{$product2->id}}"
                                                user-id="{{auth()->user()->id ?? '0'}}"/>
                                        </div>
                                    </div> <!-- single product items -->
                                </div>

                                @endforeach
                                @endif
                                
                            </div> <!-- row -->
                            {{-- end rows --}}
                        </div> <!-- product items -->
                    </div> <!-- tab pane -->


                </div> <!-- tab content --> 
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== PRODUCT PART ENDS ======-->

<!--====== SERVICES PART START ======-->

<!--====== SERVICES PART ENDS ======-->

<!--====== SHOWCASE PART START ======-->


<!--====== SHOWCASE PART ENDS ======-->




<!--======  BLOG PART ENDS ======-->

<!--====== CONTACT PART START ======-->

<section id="contact" class="contact-area pt-115">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="contact-title text-center">
                    <h2 class="title">Get In Touch</h2>
                </div> <!-- contact title -->
            </div>
        </div> <!-- row -->
        <div class="contact-box mt-70">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-info pt-25">
                        <h4 class="info-title">Contact Info</h4>
                        <ul>
                            <li>
                                <div class="single-info mt-30">
                                    <div class="info-icon">
                                        <i class="lni-phone-handset"></i>
                                    </div>
                                    <div class="info-content">
                                        <p>+88 1234 56789</p>
                                    </div>
                                </div> <!-- single info -->
                            </li>
                            <li>
                                <div class="single-info mt-30">
                                    <div class="info-icon">
                                        <i class="lni-envelope"></i>
                                    </div>
                                    <div class="info-content">
                                        <p>contact@yourmail.com</p>
                                    </div>
                                </div> <!-- single info -->
                            </li>
                            <li>
                                <div class="single-info mt-30">
                                    <div class="info-icon">
                                        <i class="lni-home"></i>
                                    </div>
                                    <div class="info-content">
                                        <p>203, Envato Labs, Behind Alis Steet,Australia</p>
                                    </div>
                                </div> <!-- single info -->
                            </li>
                        </ul>
                    </div> <!-- contact info -->
                </div> 
                <div class="col-lg-8">
                    <div class="contact-form">
                        <form id="contact-form" action="assets/contact.php" method="post" data-toggle="validator">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-form form-group">
                                        <input type="text" name="name" placeholder="Enter Your Name" data-error="Name is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-form form-group">
                                        <input type="email" name="email" placeholder="Enter Your Email"  data-error="Valid email is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-lg-12">
                                    <div class="single-form form-group">
                                        <textarea name="message" placeholder="Enter Your Message" data-error="Please,leave us a message." required="required"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <p class="form-message"></p>
                                <div class="col-lg-12">
                                    <div class="single-form form-group">
                                        <button class="main-btn" type="submit">CONTACT NOW</button>
                                    </div> <!-- single form -->
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div> <!-- row -->
                </div> 
            </div> <!-- row -->
        </div> <!-- contact box -->
    </div> <!-- container -->
</section>

<!--====== CONTACT PART ENDS ======-->

<!--====== FOOTER PART START ======-->

<section id="footer" class="footer-area">
    <div class="container">
        <div class="footer-widget pt-75 pb-120">
            <div class="row">
                <div class="col-lg-3 col-md-5 col-sm-7">
                    <div class="footer-logo mt-40">
                        <a href="#">
                            <img src="assets/images/logo.png" alt="Logo">
                        </a>
                        <p class="mt-10">Gravida nibh vel velit auctor aliquetn quibibendum auci elit cons equat ipsutis sem nibh id elit.</p>
                        <ul class="footer-social mt-25">
                            <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                            <li><a href="#"><i class="lni-twitter-original"></i></a></li>
                            <li><a href="#"><i class="lni-instagram"></i></a></li>
                        </ul>
                    </div> <!-- footer logo -->
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <div class="footer-link mt-50">
                        <h5 class="f-title">Services</h5>
                        <ul>
                            <li><a href="#">Architechture Design</a></li>
                            <li><a href="#">Interior Design</a></li>
                            <li><a href="#">Autocad Services</a></li>
                            <li><a href="#">Lighting Design</a></li>
                            <li><a href="#">Poster Design</a></li>
                        </ul>
                    </div> <!-- footer link -->
                </div>
                <div class="col-lg-2 col-md-3 col-sm-5">
                    <div class="footer-link mt-50">
                        <h5 class="f-title">Help</h5>
                        <ul>
                            <li><a href="#">Forum</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Help Center</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div> <!-- footer link -->
                </div>
                <div class="col-lg-4 col-md-5 col-sm-7">
                    <div class="footer-info mt-50">
                        <h5 class="f-title">Contact Info</h5>
                        <ul>
                            <li>
                                <div class="single-footer-info mt-20">
                                    <span>Phone :</span>
                                    <div class="footer-info-content">
                                        <p>+88123 4567 890</p>
                                        <p>+88123 4567 890</p>
                                    </div>
                                </div> <!-- single footer info -->
                            </li>
                            <li>
                                <div class="single-footer-info mt-20">
                                    <span>Email :</span>
                                    <div class="footer-info-content">
                                        <p>contact@yourmail.com</p>
                                        <p>support@yourmail.com</p>
                                    </div>
                                </div> <!-- single footer info -->
                            </li>
                            <li>
                                <div class="single-footer-info mt-20">
                                    <span>Address :</span>
                                    <div class="footer-info-content">
                                        <p>5078 Jensen Key, Port Kaya, WV 73505</p>
                                    </div>
                                </div> <!-- single footer info -->
                            </li>
                        </ul>
                    </div> <!-- footer link -->
                </div>
            </div> <!-- row -->
        </div> <!-- footer widget -->
        <div class="footer-copyright pt-15 pb-15">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright text-center">
                        <p>Crafted by <a href="https://uideck.com" rel="nofollow">UIdeck</a></p>
                    </div> <!-- copyright -->
                </div>
            </div> <!-- row -->
        </div> <!--  footer copyright -->
    </div> <!-- container -->
</section>

<!--====== FOOTER PART ENDS ======-->

<!--====== BACK TO TOP PART START ======-->

<a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

<!--====== BACK TO TOP PART ENDS ======-->
   @endsection
  
   @section('scripts')
   @endsection


