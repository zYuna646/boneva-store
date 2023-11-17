@extends('admin.layouts.app')

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
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <h4 class="fw-semibold mb-8">{{ $title ?? '' }}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.category') }}" class="text-muted">{{ $title ?? '' }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('admin.account.store') }}" method="post">
            @csrf
            <div class="card-body">
                <h5 class="mb-3">{{ $subtitle }} </h5>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="control-label mb-1">Role</label>
                            <input type="text" name="role" class="form-control @error('name') is-invalid @enderror"
                                placeholder="John Doe" value="{{ $data->role }}" disabled/>
                            @error('role')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="John Doe" value="{{ $data->name }}" disabled/>
                            @error('name')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="email@example.com" value="{{ $data->email }}" disabled/>
                            @error('email')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".toggle-password").on('click', function(event) {
                event.preventDefault();
                var target = $(this).data("target");
                var input = $("input[name=" + target + "]");
                var icon = $(this).find("i");

                if (input.attr("type") === "text") {
                    input.attr('type', 'password');
                    icon.removeClass("ti-eye").addClass("ti-eye-off");
                } else if (input.attr("type") === "password") {
                    input.attr('type', 'text');
                    icon.removeClass("ti-eye-off").addClass("ti-eye");
                }
            });

        });
    </script>
@endpush
