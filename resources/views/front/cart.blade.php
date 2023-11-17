@extends('front.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBjEFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        .toast-success {
            background-color: #000 !important;
            /* Set your custom background color here */
        }

        .product-detail {
            margin: 40px 0;
        }

        .product-detail .card .card-body {
            padding: 60px !important;
        }

        .carousel-item img {
            width: 100%;
            height: 400px !important;
            object-fit: cover;
        }

        .header-slider .carousel .carousel-item .carousel-caption {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            text-align: left;
            color: white;
            padding: 20px;
        }

        .header-slider .carousel .carousel-item .carousel-caption h1 {
            font-size: 40px;
            font-weight: 700;
        }

        .header-slider .carousel .carousel-item .carousel-caption p {
            font-size: 14px;
            font-weight: 300;
            margin-bottom: 20px;
            text-wrap: wrap;
            width: 60%;
        }

        .btn-custom-transparent {
            background-color: transparent;
            color: var(--light-color);
            border: none;
            border-radius: 0;
            padding: 6px 20px;
            font-size: 14px;
            font-weight: 500;
            border: 2px solid var(--light-color);
            transition: all 0.3s;
        }

        .btn-custom-transparent:hover {
            background-color: var(--light-color);
            border: 2px solid var(--light-color);
            color: var(--dark-color);
        }

        @media (max-width: 991.98px) {
            .carousel-item img {
                height: 350px !important;
            }
        }

        @media (max-width: 767.98px) {
            .carousel-item img {
                width: 100%;
                height: 250px !important;
                object-fit: cover;
            }
        }

        #sync1 .btn-nav-dark {
            width: 20px;
            height: 20px;
            padding: 2px;
            background-color: rgba(0, 0, 0, .6);
            color: #fff;
            font-size: 12px;
        }

        #sync1 .owl-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translateY(-50%);
        }

        #sync1 .item {
            border-radius: 0 !important;
        }

        #sync1 .item img {
            height: fit-content;
            object-fit: cover;
        }

        table tr td {
            padding: 5px;
        }

        .category span {
            font-size: 14px !important;
        }

        .btn-copy {
            background-color: transparent;
            color: var(--dark-color);
            border: none;
            border-radius: 0;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            border: 2px solid var(--dark-color);
            transition: all 0.3s;
        }

        .btn-copy:hover {
            background-color: var(--dark-color);
            border: 2px solid var(--dark-color);
            color: var(--light-color);
        }

        .btn-shop {
            background-color: var(--dark-color);
            color: var(--light-color);
            border: none;
            border-radius: 0;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            border: 2px solid var(--dark-color);
            transition: all 0.3s;
        }

        .btn-shop:hover {
            background-color: var(--light-color);
            border: 2px solid var(--dark-color);
            color: var(--dark-color);
        }

        .related-product {
            margin-bottom: 50px;
        }

        .btn-see-more {
            text-decoration: none;
            color: var(--dark-color);
            font-size: 14px;
        }

        .btn-see-more:hover {
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')
    <!-- Start Header Slider-->
    <header class="header-slider">
        <div class="container">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($mainSliders as $key => $mainSlider)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('uploads/main-slider/' . $mainSlider->image) }}" class="d-block w-100"
                                alt="Slider Image">
                            <div class="carousel-caption">
                                <h1>{{ $mainSlider->title ?? '' }}</h1>
                                <p class="text-wrap slider-subtitle">{{ $mainSlider->sub_title ?? '' }}</p>
                                <a href="{{ $mainSlider->link ?? '' }}" class="btn btn-custom-transparent">Shop Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </header>
    <!-- End Header Slider -->

    <section class="product-detail">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-xl-3">
                            <div id="table_config_filter" class="position-relative">
                                <input type="search" id="search-box" class="form-control ps-5" aria-controls="table_config"
                                    placeholder="Search Product..." />
                                <i
                                    class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                            </div>
                        </div>
                        <div
                            class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                            <a class="btn btn-nav-link" href="{{ route('cart') }}">
                                <i class="fas fa-shopping-cart"></i>&nbsp;
                                Keranjang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @if (count($product) > 0)
                <div class="card bg-transparent border-0 rounded-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_config" class="table align-middle text-nowrap">
                                    <thead class="header-item">
                                        <tr>
                                            <th>No</th>
                                            <th>Name Product</th>
                                            <th>Unit</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $key => $result)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ App\Models\Catalog::find($key)->name }}</td>
                                                <td>{{ App\Models\Catalog::find($key)->fabric }}</td>
                                                <td>{{ App\Models\Catalog::find($key)->category->name }}</td>
                                                <td>
                                                    <form action="{{ route('cart.add', App\Models\Catalog::find($key)->id) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-{{ $result->verified ? 'success' : 'danger' }}"
                                                            onclick="return confirm('Are you sure?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    {{ $result }}
                                                    <form action="{{ route('cart.minus',  App\Models\Catalog::find($key)->id) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-{{ $result->verified ? 'success' : 'danger' }}"
                                                            onclick="return confirm('Are you sure?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>{{ App\Models\Catalog::find($key)->price * $result }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/catalog/image/' . App\Models\Catalog::find($key)->image) }}"
                                                        alt="{{ App\Models\Catalog::find($key)->name }}" class="img-fluid rounded" width="100"
                                                        height="100">
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <form action="#" method="post" target="_blank">
                                @csrf
                                <button type="submit" class="btn btn-shop">
                                    <i class="fa fa-shop"></i> Order Now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // product detail
        $(function() {
            var sync1 = $("#sync1");

            sync1.owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: true,
                autoplay: false,
                dots: false,
                loop: true,
                responsiveRefreshRate: 200,
                navText: [
                    '<span class="position-absolute top-50 start-0 ms-2 translate-middle-y btn-nav-dark rounded-circle"><i class="fa fa-chevron-left"></i></span>',
                    '<span class="position-absolute top-50 end-0 me-2 translate-middle-y btn-nav-dark rounded-circle"><i class="fa fa-chevron-right"></i></span>'
                ],
            });

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
        })
    </script>
@endpush
