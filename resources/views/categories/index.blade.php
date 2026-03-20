@extends('layouts.app')

@section('content')
<!-- Banner Section -->
<section class="banner-section index-one overflow-hidden position-relative mx-2 mx-md-4 mx-xl-6 mt-2 mt-md-4 mt-xl-6 s1-2nd-bg-color rounded-3 cus-border border">
    <div class="container position-relative pt-20 mt-10 mt-md-20">
        <div class="row g-9 g-lg-0 align-items-center py-12 py-sm-20">
            <div class="col-lg-6 pe-4 pe-md-10">
                <div class="d-grid gap-4 gap-md-6 position-relative cus-z1">
                    <h2 class="display-four n17-color">Categories</h2>
                    <div class="breadcrumb-area">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb second position-relative m-0 d-center justify-content-start gap-2 gap-md-3">
                                <li class="breadcrumb-item d-flex align-items-center fs-seven"><a href="{{ route('home') }}" class="n17-color">Home</a></li>
                                <li class="breadcrumb-item d-flex align-items-center fs-seven active" aria-current="page"><span class="fw-mid f5-color">Categories</span></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pe-4 pe-md-10 d-none d-md-flex">
                <div class="img-area position-absolute end-0 bottom-0">
                    <img loading="lazy" src="{{ asset('assets/images/banner-illus-16.png') }}" alt="img">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Sidebar start-->
<div class="section-sidebar pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12 cus-z1">
                <div class="row cus-row top-stores trending-features g-3">
                    @foreach ($categories as $category)
                    <div class="col-6 col-sm-4 col-lg-3 col-xxl-2">
                        <a href="{{ route('coupons.index', ['category' => $category->slug]) }}" class="single-box transition d-grid gap-3 gap-md-4 text-center n1-bg-color cus-border border b-seventh px-2 px-xxl-3 py-4 py-xxl-6 rounded-2">
                            <div class="d-center thumb-area rounded-2 w-100">
                                <img loading="lazy" class="max-un" src="{{ asset($category->icon) }}" alt="Image">
                            </div>
                            <div class="text-area">
                                <span class="n17-color fs-five fw-mid">{{ $category->name }}</span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Section Sidebar end -->
@endsection
