@extends('auth.layouts.app')

@push('styles')
    <style>
        .shbtn-group {
            position: relative;
            overflow: hidden;
        }

        .shbtn {
            cursor: pointer;
            position: absolute;
            right: 0;
            top: 0;
            transform: translate(-50%, 50%);
            background: transparent;
            padding: 0 5px;
            z-index: 99;
            border: none;
        }

        .shbtn i {
            font-size: 18px;
            color: #333;
        }
    </style>
@endpush

@section('content')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed"
        data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block mb-5 w-100">
                                    <img src="{{ asset('assets/front/img/logo.jpg') }}"
                                        width="180" alt="">
                                </a>
                                <div class="position-relative text-center my-4">
                                    <p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative">
                                        Register</p>
                                    <span
                                        class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                                </div>
                                <form action="{{ route('register.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputName" class="form-label">Name</label>
                                        <input type="text" name="name" 
                                            class="form-control 
                                            @error('name')
                                                is-invalid
                                            @enderror" 
                                            id="exampleInputName"
                                            placeholder="John Doe">
                                        @error('name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" name="email" 
                                            class="form-control 
                                            @error('email')
                                                is-invalid
                                            @enderror" 
                                            id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="example@email.com">
                                        @error('email')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <!-- Show Hide Password -->
                                        <div class="mb-3" id="show_hide_password">
                                            <label for="exampleInputPassword1" class="form-label">Password</label>
                                            <div class="shbtn-group">
                                                <input type="password" name="password" 
                                                class="form-control 
                                                @error('password')
                                                    is-invalid
                                                @enderror"
                                                    id="exampleInputPassword1" 
                                                    placeholder="Enter password">
                                                <span class="shbtn">
                                                    <i class="ti ti-eye-off"></i>
                                                </span>
                                            </div>
                                            @error('password')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <!-- Show Hide Password -->
                                        <div class="mb-3" id="show_hide_password_confirm">
                                            <label for="exampleInputPasswordConfirmation" class="form-label">Konfirmasi Password</label>
                                            <div class="shbtn-group">
                                                <input type="password" name="password_confirmation" 
                                                    class="form-control 
                                                    @error('password_confirmation')
                                                        is-invalid
                                                    @enderror"
                                                    id="exampleInputPasswordConfirmation" 
                                                    placeholder="Konfirmasi password">
                                                <span class="shbtn">
                                                    <i class="ti ti-eye-off"></i>
                                                </span>
                                            </div>
                                            @error('password_confirmation')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-dark w-100 py-8 rounded-2" disabled id="submitBtn">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#show_hide_password, #show_hide_password_confirm").on('click', 'span', function(event) {
                event.preventDefault();
                var input = $(this).siblings('input');
                if (input.attr("type") == "text") {
                    input.attr('type', 'password');
                    $(this).find('i').addClass("ti-eye-off");
                    $(this).find('i').removeClass("ti-eye");
                } else if (input.attr("type") == "password") {
                    input.attr('type', 'text');
                    $(this).find('i').removeClass("ti-eye-off");
                    $(this).find('i').addClass("ti-eye");
                }
            });

            $('input[name="password"], input[name="password_confirmation"]').on('keyup', function () {
                var password = $('input[name="password"]').val();
                var confirmPassword = $('input[name="password_confirmation"]').val();

                if (password === confirmPassword) {
                    $('#submitBtn').prop('disabled', false);
                } else {
                    $('#submitBtn').prop('disabled', true);
                }
            });
        });
    </script>
@endpush
