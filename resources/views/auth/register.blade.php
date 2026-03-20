@extends('layouts.auth')

@section('content')
<!-- Authentication start-->
<section class="authentication banner-section mx-2 mx-md-4 mx-xl-6 my-2 my-md-4 my-xl-6 s1-2nd-bg-color rounded-3 cus-border border">
    <div class="container-fluid d-block d-lg-grid px-3 px-xl-0 position-relative">
        <div class="row g-9 g-lg-0 align-items-center justify-content-center">
            <div class="col-md-7 col-xl-6 h-100">
                <div class="row justify-content-end h-100">
                    <div class="col-xl-11 col-xxl-9 py-4 pe-2 pe-lg-10">
                        <div class="d-flex flex-column justify-content-between gap-4 gap-md-6 h-100">

                            <!-- Logo -->
                            <div class="logo-area">
                                <a href="{{ url('/') }}" class="nav-brand align-items-center gap-2">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                                </a>
                            </div>

                            <!-- Content -->
                            <div class="mid-area py-8 d-grid gap-6 gap-md-10">
                                <!-- Back -->
                                <div class="btn-area">
                                    <a href="{{ url('/') }}" class="d-center justify-content-start gap-1 gap-md-2">
                                        <span class="d-center fs-five p2-color">
                                            <i class="ph ph-arrow-left"></i>
                                        </span>
                                        <span class="p2-color fw-bold">Back Now</span>
                                    </a>
                                </div>

                                <!-- Head -->
                                <div class="head-area d-grid gap-3 gap-md-5">
                                    <h2 class="n17-color">Let’s Get Started!</h2>
                                    <p class="n17-color fs-six">Please enter your details to create an account</p>
                                </div>

                                <!-- Register Form -->
                                <form method="POST" action="{{ route('register') }}" class="row gy-4 gy-md-6">
                                    @csrf

                                    <!-- Full Name -->
                                    <div class="col-sm-12 d-grid gap-1 gap-md-2">
                                        <label for="name" class="fw-mid fs-six">Full Name</label>
                                        <div class="input-area w-100 n1-bg-color rounded-pill transition cus-border border">
                                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" class="px-4 px-md-6 py-2 py-md-3 w-100" required>
                                        </div>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Phone Number -->
                                    <div class="col-sm-12 d-grid gap-1 gap-md-2">
                                        <label for="phone" class="fw-mid fs-six">Phone Number</label>
                                        <div class="input-area w-100 n1-bg-color rounded-pill transition cus-border border">
                                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+251900000000" class="px-4 px-md-6 py-2 py-md-3 w-100" required>
                                        </div>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="col-sm-12 d-grid gap-1 gap-md-2">
                                        <label for="password" class="fw-mid fs-six">Password</label>
                                        <div class="input-area w-100 n1-bg-color rounded-pill transition cus-border border position-relative d-center gap-3">
                                            <input type="password" id="password" name="password" placeholder="Enter Password" class="px-4 px-md-6 py-2 py-md-3 w-100 rounded-pill" required>
                                            <span class="d-center show-hide-pass fs-six pe-6">
                                                <i class="ph ph-eye"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-sm-12 d-grid gap-1 gap-md-2">
                                        <label for="password_confirmation" class="fw-mid fs-six">Confirm Password</label>
                                        <div class="input-area w-100 n1-bg-color rounded-pill transition cus-border border">
                                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password" class="px-4 px-md-6 py-2 py-md-3 w-100 rounded-pill" required>
                                        </div>
                                    </div>

                                    <!-- User Type -->
                                    <div class="col-sm-12 d-grid gap-1 gap-md-2">
                                        <label class="fw-mid fs-six">Account Type</label>
                                        <div class="input-area w-100 n1-bg-color rounded-pill transition cus-border border d-flex">
                                            <div class="form-check me-4">
                                                <input class="form-check-input" type="radio" name="user_type" id="user_type_client" value="client" checked>
                                                <label class="form-check-label" for="user_type_client">Customer</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="user_type" id="user_type_merchant" value="merchant">
                                                <label class="form-check-label" for="user_type_merchant">Business Owner</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-sm-12 d-grid gap-6 gap-md-10">
                                        <p class="n15-color">Have an account? 
                                            <a href="{{ route('login') }}" class="p2-color">Sign In</a>
                                        </p>
                                        <button type="submit" class="box-style box-second gap-2 gap-md-3 rounded-pill py-5 py-md-6 px-5 px-md-7 d-center">
                                            <span class="position-absolute show transition n1-color fw-mid">Sign Up</span>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="copyright-clone text-center text-sm-start pt-200 d-none d-md-block"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Image -->
            <div class="col-sm-7 col-md-5 col-xl-6 d-center justify-content-end mb-3 mb-md-0">
                <div class="img-area position-relative d-center">
                    <img src="{{ asset('assets/images/auth-img-1.png') }}" alt="img">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Authentication end-->
@endsection
