@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="owl-carousel counter-carousel owl-theme">
        <div class="item">
            <div class="card border-0 zoom-in bg-light-primary shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box mb-3 text-primary"
                            width="50" height="50" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5"></path>
                            <path d="M12 12l8 -4.5"></path>
                            <path d="M12 12l0 9"></path>
                            <path d="M12 12l-8 -4.5"></path>
                        </svg>
                        <p class="fw-semibold fs-3 text-primary mb-1"> Product </p>
                        <h5 class="fw-semibold text-primary mb-0">{{ $count_catalog ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-warning shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-category-2 mb-3 text-warning" width="50" height="50"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 4h6v6h-6z"></path>
                            <path d="M4 14h6v6h-6z"></path>
                            <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        </svg>
                        <p class="fw-semibold fs-3 text-warning mb-1"> Category </p>
                        <h5 class="fw-semibold text-warning mb-0">{{ $count_category ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-danger shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-brand-youtube mb-3 text-danger" width="50"
                            height="50" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M2 8a4 4 0 0 1 4 -4h12a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-12a4 4 0 0 1 -4 -4v-8z"></path>
                            <path d="M10 9l5 3l-5 3z"></path>
                        </svg>
                        <p class="fw-semibold fs-3 text-danger mb-1"> Video </p>
                        <h5 class="fw-semibold text-danger mb-0">{{ $count_video ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-secondary shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-news mb-3 text-secondary" width="50" height="50"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11">
                            </path>
                            <path d="M8 8l4 0"></path>
                            <path d="M8 12l4 0"></path>
                            <path d="M8 16l4 0"></path>
                        </svg>
                        <p class="fw-semibold fs-3 text-secondary mb-1"> Information </p>
                        <h5 class="fw-semibold text-secondary mb-0">{{ $count_information ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="item">
            <div class="card border-0 zoom-in bg-light-success shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-users-group mb-3 text-success" width="50" height="50"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                        </svg>
                        <p class="fw-semibold fs-3 text-success mb-1"> Visitor </p>
                        <h5 class="fw-semibold text-success mb-0">0</h5>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>


    <div class="row">
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body">
                    {!! $bahanChart->container() !!}
                </div>
            </div>
        </div>
    
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body">
                    {!! $productChart->container() !!}
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body">
                    {!! $ProduksiProduct->container() !!}
                </div>
            </div>
        </div>
    
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body">
                    {!! $produksiBahan->container() !!}
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body">
                    {!! $orderChart->container() !!}
                </div>
            </div>
        </div>
    
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body">
                    {!! $jumlahOrder->container() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body">
                    {!! $lineProduksi->container() !!}
                </div>
            </div>
        </div>
    
        <div class="col-12 col-lg-6 d-flex align-items-stretch">
            <div class="card">
                <div class="card-body">
                    {!! $lineBahan->container() !!}
                </div>
            </div>
        </div>
    </div>
    
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function() {
            $(".counter-carousel").owlCarousel({
                loop: true,
                margin: 30,
                mouseDrag: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplaySpeed: 2000,
                nav: false,
                responsive: {
                    0: {
                        items: 2,
                    },
                    576: {
                        items: 2,
                    },
                    768: {
                        items: 3,
                    },
                    1200: {
                        items: 4,
                    }
                },
            });
        });
    </script>
    <script src="{{ $bahanChart->cdn() }}"></script>
    <script src="{{ $productChart->cdn() }}"></script>
    <script src="{{ $ProduksiProduct->cdn() }}"></script>
    <script src="{{ $produksiBahan->cdn() }}"></script>
    <script src="{{ $orderChart->cdn() }}"></script>
    <script src="{{ $jumlahOrder->cdn() }}"></script>
    <script src="{{ $lineProduksi->cdn() }}"></script>
    <script src="{{ $lineBahan->cdn() }}"></script>



    {{ $bahanChart->script() }}
    {{ $productChart->script() }}
    {{ $ProduksiProduct->script() }}
    {{ $produksiBahan->script() }}
    {{ $orderChart->script() }}
    {{ $jumlahOrder->script() }}
    {{ $lineProduksi->script() }}
    {{ $lineBahan->script() }}


@endpush
