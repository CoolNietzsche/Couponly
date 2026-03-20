@extends('layouts.auth')

@section('content')
<section class="authentication banner-section mx-2 mx-md-4 mx-xl-6 my-2 my-md-4 my-xl-6 s1-2nd-bg-color rounded-3 cus-border border">
    <div class="container-fluid d-block d-lg-grid px-3 px-xl-0 position-relative">
        <div class="row g-9 g-lg-0 align-items-center justify-content-center">
            <div class="col-md-7 col-xl-6 h-100">
                <div class="row justify-content-end h-100">
                    <div class="col-xl-11 col-xxl-9 py-4 pe-2 pe-lg-10">
                        <div class="d-flex flex-column justify-content-between gap-4 gap-md-6 h-100">
                            <div class="logo-area">
                                <a href="/" class="nav-brand align-items-center gap-2">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                                </a>
                            </div>
                            <div class="mid-area py-10 d-grid gap-6 gap-md-10">
                                <div class="btn-area">
                                    <a href="/" class="d-center justify-content-start gap-1 gap-md-2">
                                        <span class="d-center fs-five p2-color">
                                            <i class="ph ph-arrow-left"></i>
                                        </span>
                                        <span class="p2-color fw-bold">Back Now</span>
                                    </a>
                                </div>
                                <div class="head-area d-grid gap-3 gap-md-5">
                                    <h2 class="n17-color">Welcome Back!</h2>
                                    <p class="n17-color fs-six">Sign in to your account and join us</p>
                                </div>
                                <form method="POST" action="{{ route('login') }}" class="row gy-4 gy-md-6">
                                    @csrf
                                    <div class="col-sm-12 d-grid gap-1 gap-md-2">
                                        <label for="phone" class="fw-mid fs-six">Enter Your Phone Number</label>
                                        <div class="input-area w-100 n1-bg-color rounded-pill transition cus-border border">
                                            <input type="text" id="phone" name="phone" placeholder="Your phone number" class="px-4 px-md-6 py-2 py-md-3 w-100 rounded-pill" required autofocus>
                                        </div>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 d-grid gap-1 gap-md-2">
                                        <label for="password" class="fw-mid fs-six">Enter Your Password</label>
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
                                    <div class="col-sm-12 d-grid gap-3 gap-sm-0">
                                        <div class="d-flex justify-content-end">
                                            <a href="#" class="p2-color">Forget password</a>
                                        </div>
                                        <div class="d-grid gap-6 gap-md-10">
                                            <p class="n15-color">Don’t have an account? <a href="{{ route('register') }}" class="p2-color">Sign Up</a></p>
                                            <button type="submit" class="box-style box-second gap-2 gap-md-3 rounded-pill py-5 py-md-6 px-5 px-md-7 d-center">
                                                <span class="position-absolute show transition n1-color fw-mid">Sign In</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="copyright-clone text-center text-sm-start pt-200 d-none d-md-block"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 col-md-5 col-xl-6 d-center justify-content-end mb-3 mb-md-0">
                <div class="img-area position-relative d-center">
                    <img src="{{ asset('assets/images/auth-img-2.png') }}" alt="img">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
