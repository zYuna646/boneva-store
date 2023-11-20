@extends('front.layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .copy-link-button {
            display: inline-block;
            width: fit-content;
            padding: 6px 10px;
            font-size: 14px;
            background-color: var(--light-color);
            color: var(--dark-color);
            outline: none;
            border: none;
        }

        .toast-success {
            background-color: #000 !important;
            /* Set your custom background color here */
        }
    </style>
@endpush

@section('content')
  
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <section class="main-banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="header-text">
                        <h6>Welcome to Bonev</h6>
                        <h2>Dukung Produk Air Kemasan <em>Lokal!</em></h2>
                        <div class="main-button-gradient">
                            <div class="scroll-to-section"><a href={{ route('register') }}>Join Us Now!</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-image">
                        <img src="assets/images/banner-right-image.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Main Banner Area End ***** -->
    <section class="gallery" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-title" data-aos="fade-down">
                        <div class="text-center">
                            <div class="section-heading">
                                <h6>Our Product</h6>
                                <h4>Provided <em>Product</em></h4>
                            </div>
                        </div>
                    </div>
                    <div class="content-body" data-aos="fade-up">
                        <div class="categories-links">
                            <span class="category-link category-active" data-name="All">All</span>
                            @foreach (App\Models\Category::all() as $category)
                                <span class="category-link" data-name="{{ $category->slug }}">{{ $category->name }}</span>
                            @endforeach

                        </div>

                        <div class="galleries">
                            @foreach (App\Models\Catalog::all() as $gallery)
                                <div class="gallery-img" data-name="{{ $gallery->category->slug ?? '' }}">
                                    <img src="{{ asset('uploads/catalog/image/' . $gallery->image ?? '') }}"
                                        alt="gallery-img">
                                    <div class="gallery-overlay">
                                        <h4 class="mb-0">{{ $gallery->name ?? '' }}</h4>
                                        <span>Category</span>
                                        <div class="gallery-button mt-2">
                                            <a href="{{ route('product.detail', $gallery->slug) }}"><i
                                                    class="fa-solid fa-magnifying-glass"></i></a>
                                            <button type="button" class="copy-link-button"
                                                data-link="{{ route('product.detail', $gallery->slug) }}"><i
                                                    class="fa-solid fa-link"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="simple-cta">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-1">
                    <div class="left-image">
                        <img src="{{ asset('landing/assets/images/cta-left-image.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-5 align-self-center">
                    <h6>Get the sale right now!</h6>
                    <h4>Up to 50% OFF For 1+ courses</h4>
                    <p>Kogi VHS freegan bicycle rights try-hard green juice probably haven't heard of them cliche la
                        croix af chillwave.</p>
                    <div class="white-button">
                        <a href="contact-us.html">View Courses</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h6>Testimonials</h6>
                        <h4>What They <em>Think</em></h4>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="owl-testimonials owl-carousel" style="position: relative; z-index: 5;">
                        <div class="item">
                            <p>“just think about TemplateMo if you need free CSS templates for your website”</p>
                            <h4>Catherine Walk</h4>
                            <span>CEO &amp; Founder</span>
                            <img src="assets/images/quote.png" alt="">
                        </div>
                        <div class="item">
                            <p>“think about our website first when you need free HTML templates for your website”</p>
                            <h4>David Martin</h4>
                            <span>CTO of Tech Company</span>
                            <img src="assets/images/quote.png" alt="">
                        </div>
                        <div class="item">
                            <p>“just think about our website wherever you need free templates for your website”</p>
                            <h4>Sophia Whity</h4>
                            <span>CEO and Co-Founder</span>
                            <img src="assets/images/quote.png" alt="">
                        </div>
                        <div class="item">
                            <p>“Praesent accumsan condimentum arcu, id porttitor est semper nec. Nunc diam lorem.”</p>
                            <h4>Helen Shiny</h4>
                            <span>Tech Officer</span>
                            <img src="assets/images/quote.png" alt="">
                        </div>
                        <div class="item">
                            <p>“Praesent accumsan condimentum arcu, id porttitor est semper nec. Nunc diam lorem.”</p>
                            <h4>George Soft</h4>
                            <span>Gadget Reviewer</span>
                            <img src="assets/images/quote.png" alt="">
                        </div>
                        <div class="item">
                            <p>“Praesent accumsan condimentum arcu, id porttitor est semper nec. Nunc diam lorem.”</p>
                            <h4>Andrew Hall</h4>
                            <span>Marketing Manager</span>
                            <img src="assets/images/quote.png" alt="">
                        </div>
                        <div class="item">
                            <p>“Praesent accumsan condimentum arcu, id porttitor est semper nec. Nunc diam lorem.”</p>
                            <h4>Maxi Power</h4>
                            <span>Fashion Designer</span>
                            <img src="assets/images/quote.png" alt="">
                        </div>
                        <div class="item">
                            <p>“Praesent accumsan condimentum arcu, id porttitor est semper nec. Nunc diam lorem.”</p>
                            <h4>Olivia Too</h4>
                            <span>Creative Designer</span>
                            <img src="assets/images/quote.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-us" id="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div id="map">

                        <!-- You just need to go to Google Maps for your own map point, and copy the embed code from Share -> Embed a map section -->
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7151.84524236698!2d-122.19494600413192!3d47.56605883252286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5490695e625f8965%3A0xf99b055e76477def!2sNewcastle%20Beach%20Park%20Playground%2C%20Bellevue%2C%20WA%2098006%2C%20USA!5e0!3m2!1sen!2sth!4v1644335269264!5m2!1sen!2sth"
                            width="100%" height="420px" frameborder="0"
                            style="border:0; border-radius: 15px; position: relative; z-index: 2;"
                            allowfullscreen=""></iframe>
                        <div class="row">
                            <div class="col-lg-4 offset-lg-1">
                                <div class="contact-info">
                                    <div class="icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <h4>Phone</h4>
                                    <span>010-020-0340</span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="contact-info">
                                    <div class="icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <h4>Mobile</h4>
                                    <span>090-080-0760</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <form id="contact" action="" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-heading">
                                    <h6>Contact us</h6>
                                    <h4>Say <em>Hello</em></h4>
                                    <p>IF you need a working contact form by PHP script, please visit TemplateMo's
                                        contact page for more info.</p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <input type="name" name="name" id="name" placeholder="Full Name"
                                        autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*"
                                        placeholder="Your Email" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <textarea name="message" id="message" placeholder="Your Message"></textarea>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-gradient-button">Send
                                        Message</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12">
                    <ul class="social-icons">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <p class="copyright">Copyright © 2022 EduWell Co., Ltd. All Rights Reserved.

                        <br>Design: <a rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <!-- Include Clipboard.js and SweetAlert libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Clipboard.js
            new ClipboardJS('.copy-link-button', {
                text: function(trigger) {
                    return $(trigger).attr('data-link');
                }
            });

            // Add a success event listener to show a Toastr toast notification
            $('.copy-link-button').on('click', function(e) {
                showCopySuccessNotification();
            });

            function showCopySuccessNotification() {
                // Show a Toastr toast notification
                toastr.success('Link Copied!', null, {
                    timeOut: 1500,
                    positionClass: 'toast-bottom-left',
                    progressBar: true,
                });
            }
        });
    </script>
@endpush
