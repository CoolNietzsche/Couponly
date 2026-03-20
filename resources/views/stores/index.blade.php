@extends('layouts.app')

@section('content')
<!-- Banner Section -->
<section class="banner-section index-one overflow-hidden position-relative mx-2 mx-md-4 mx-xl-6 mt-2 mt-md-4 mt-xl-6 s1-2nd-bg-color rounded-3 cus-border border">
    <div class="container position-relative pt-20 mt-10 mt-md-20">
        <div class="row g-9 g-lg-0 align-items-center py-12 py-sm-20">
            <div class="col-lg-6 pe-4 pe-md-10">
                <div class="d-grid gap-4 gap-md-6 position-relative cus-z1">
                    <h2 class="display-three n17-color">Stores</h2>
                    <div class="breadcrumb-area">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb second position-relative m-0 d-center justify-content-start gap-2 gap-md-3">
                                <li class="breadcrumb-item d-flex align-items-center fs-seven"><a href="{{ route('home') }}" class="n17-color">Home</a></li>
                                <li class="breadcrumb-item d-flex align-items-center fs-seven active" aria-current="page"><span class="fw-mid f5-color">Stores</span></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pe-4 pe-md-10 d-none d-md-flex">
                <div class="img-area position-absolute end-0 bottom-0">
                    <img loading="lazy" src="{{ asset('assets/images/banner-illus-4.png') }}" alt="img">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Sidebar start-->
<section class="section-sidebar pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12 cus-z1">
                <div class="top-stores">
                    <div class="row cus-row g-3">
                        @foreach ($stores as $store)
                        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                            <div class="single-box gap-2 gap-md-3 p1-2nd-bg-color cus-border border b-eighth p-2 p-xxl-3 rounded-2 d-center flex-column">
                                <div class="d-center thumb-area rounded-2 w-100">
                                    <img loading="lazy" class="w-100" src="{{ asset($store->logo) }}" alt="Image">
                                </div>
                                <div class="bottom-area w-100 d-grid gap-2 gap-md-3">
                                    <div class="rounded-1 n1-bg-color d-center gap-2 gap-md-3 justify-content-start cus-border border b-tenth p-1">
                                        <div class="d-center fav-icon rounded-2 n1-bg-color box-shadow-p1">
                                            <img loading="lazy" class="max-un" src="{{ asset('assets/images/fav.png') }}" alt="Image">
                                        </div>
                                        <span class="p1-color fs-eight fw-bold">{{ $store->coupons_count }} Coupons</span>
                                    </div>
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
<!-- Section Sidebar end -->
@endsection
