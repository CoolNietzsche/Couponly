@extends('layouts.app')
@section('title', 'Home')
@section('styles')
<style>
    .single-box {
        min-height: 160px;
        /* same height */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
    }

    .thumb-area {
        max-height: 80px;
        /* control image box size */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .thumb-area img {
        max-height: 60px;
        /* keep icons equal */
        object-fit: contain;
    }
</style>

@endsection
@section('content')
<!-- Banner Section (Position 0) -->
<section class="banner-section index-five mt-6">
    @php
    $bgColors = ['#cfdfdf', '#e1e3ef', '#ead8ce'];
    @endphp
    <div class="swiper banner-carousel">
        <div class="swiper-wrapper">
            @foreach ($coupons as $coupon)
            <div class="swiper-slide">
                <div class="single-item mx-2 item-{{ $loop->index % 3 + 1 }} px-6 px-md-8 py-7 py-md-12 rounded-4"
                    style="background: {{ $bgColors[$loop->index % count($bgColors)] }};">
                    <div class="d-inline-flex rounded-3 n1-bg-color px-3 px-md-4 py-2 mb-3 mb-md-4 gap-1 gap-md-2">
                        <span class="icon-area">
                            <img class="max-un" src="{{ asset('assets/images/shape/fire-icon.png') }}" alt="Trending">
                        </span>
                        <span class="fw-mid fs-seven">Trending</span>
                    </div>
                    <h2 class="fw-mid n18-color w-75 position-relative cus-z1">
                        {{ $coupon->title }}
                    </h2>
                    <div class="btn-area mt-5 mt-md-8">
                        <a href="{{ url('/coupons/' . $coupon->id) }}"
                            class="box-style box-second rounded-pill py-2 py-md-3 px-5 px-md-7 d-center d-inline-flex">
                            <span class="fs-six text-nowrap">Shop Now</span>
                        </a>
                    </div>
                    <div class="abs-area bottom-0 end-0"> 
    <img loading="lazy" class="w-100 h-100"
         src="{{ $coupon->image ? asset('storage/' . $coupon->image) : asset('assets/images/index-3-banner-' . ($loop->index % 3 + 1) . '.png') }}"
         alt="{{ $coupon->title }}">
</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="slider-pagination text-center cus-z1 mt-4 mt-md-6"></div>
    </div>
</section>

<!-- Advertisements at Position 1 -->
@php
$position = 1;
$positionedAds = $advertisements->where('position', $position);
@endphp
@if($positionedAds->count() > 0)
<section class="advertisements-section py-6 py-md-10">
    <div class="container-fluid">
        <div class="row justify-content-center">
            @foreach($positionedAds as $ad)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="ad-item position-relative overflow-hidden rounded-3">
                    <img src="{{ asset('storage/' . $ad->image) }}" alt="Advertisement" class="w-100 h-auto rounded-3">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Categories Section (Position 2) -->
<section class="section-sidebar pt-12 pt-md-20">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12 cus-z1">
                <div class="d-center justify-content-between gap-2 gap-md-3 mb-5 mb-md-8">
                    <h3 class="n17-color">Browse <span class="s1-color">Categories</span></h3>
                    <a href="{{ route('categories') }}" class="d-center gap-2 gap-md-3">
                        <span class="p2-color fw-bold">See All Categories</span>
                        <span class="d-center fs-five p2-color"><i class="ph ph-arrow-right"></i></span>
                    </a>
                </div>

                {{-- Use row-cols-* so bootstrap decides columns per breakpoint --}}
                <div class="row row-cols-4 row-cols-sm-4 row-cols-md-5 row-cols-lg-6 g-2 g-sm-3">
                    @foreach ($categories as $category)
                    <div class="col">
                        <a href="{{ route('coupons.index', ['category' => $category->slug]) }}"
                            class="category-card d-flex flex-column align-items-center justify-content-center text-center p-2 p-sm-3 rounded-2 n1-bg-color cus-border border h-100">
                            <div class="category-thumb d-flex align-items-center justify-content-center mb-1">
                                <img loading="lazy" src="{{ asset($category->icon) }}"
                                    alt="{{ $category->name }}" class="img-fluid category-icon">
                            </div>

                            {{-- small label on phone, slightly larger on bigger screens --}}
                            <div class="category-label w-100">
                                {{-- keep label short; CSS will ellipsize if long --}}
                                <span class="d-block text-truncate">{{ $category->name }}</span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Advertisements at Position 3 -->
@php
$position = 3;
$positionedAds = $advertisements->where('position', $position);
@endphp
@if($positionedAds->count() > 0)
<section class="advertisements-section py-6 py-md-10">
    <div class="container-fluid">
        <div class="row justify-content-center">
            @foreach($positionedAds as $ad)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="ad-item position-relative overflow-hidden rounded-3">
                    <img src="{{ asset('storage/' . $ad->image) }}" alt="Advertisement" class="w-100 h-auto rounded-3">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif





<!-- Popular Offers Start (Position 4) -->
 <section class="top-stores trending-features py-12 py-md-20">
    <div class="container-fluid">
        <div class="row gy-6 gy-lg-0 pb-4 pb-lg-6 justify-content-between align-items-center">
            <div class="col-md-4">
                <div class="head-area">
                    <h3 class="n17-color">Trending <span class="s1-color">Offers</span></h3>
                </div>
            </div>
        </div>
        <div class="row cus-row gy-5 gy-xxl-6 justify-content-center justify-content-md-start">
            @foreach ($popularCoupons as $coupon)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="single-box transition position-relative d-center flex-column text-center gap-4 gap-md-6 n1-bg-color cus-border border b-fourth box-shadow-p2 px-3 px-md-4 py-5 py-md-8 rounded-3">
                    <div class="abs-area position-absolute top-0 start-0 my-2 my-md-3 rounded-pill px-3 px-md-4 py-1 py-md-2 p1-2nd-bg-color cus-border border b-eighth">
                        <span class="f5-color fw-mid">Features</span>
                    </div>
                    <div class="abs-area position-absolute top-0 end-0 my-2 my-md-3 border-dash rounded-pill px-4 px-md-6 py-1 py-md-2 d-center gap-1 gap-md-2 f7-bg-color cus-border border b-sixth">
                        <span class="s1-color fs-five fw-bold d-center"><i class="fas fa-star"></i></span>
                        <span class="n15-color fw-mid">4.7</span>
                    </div>
                    <div class="d-center thumb-area rounded-circle">
                        <img loading="lazy" class="rounded-circle" src="{{ asset($coupon->image) }}" alt="{{ $coupon->title }}">
                    </div>
                    <div class="d-grid gap-2">
                        <span class="n15-color fs-seven fw-semibold">{{ $coupon->store->name }}</span>
                        <h5 class="n15-color fw-bold">{{ $coupon->title }}</h5>
                        <span class="n15-color fs-seven">{{ $coupon->store->coupons_count ?? $coupon->store->coupons->count() }} Coupons Available</span>                    </div>
                    @auth
                    <button
                        class="cmn-btn btn-overlay border-dash rounded-pill px-4 px-md-6 py-2 py-md-3 w-100 position-relative d-center"
                        data-bs-toggle="modal" data-bs-target="#getCouponCodetre{{ $coupon->code }}"
                        data-coupon-code="{{ $coupon->code }}">
                        <span class="f5-color fw-semibold coupon-code w-100 d-center">{{ $coupon->code }}</span>
                        <span class="position-absolute show transition n1-color">Show Coupon</span>
                    </button>
                    @else
                    <button
                        class="cmn-btn btn-overlay border-dash rounded-pill px-4 px-md-6 py-2 py-md-3 w-100 position-relative d-center"
                        data-bs-toggle="modal" data-bs-target="#loginRequiredModal">
                        <span class="f5-color fw-semibold coupon-code w-100 d-center">{{ $coupon->code }}</span>
                        <span class="position-absolute show transition n1-color">Login to Get Coupon</span>
                    </button>
                    @endauth
                    <div class="rounded-3 px-3 px-md-4 py-1 py-md-2 p1-2nd-bg-color d-center gap-1 gap-md-2 cus-border border b-eighth">
                        <span class="d-center fs-four p2-color">
                            <i class="ph ph-clock"></i>
                        </span>
                        <span class="f5-color fw-mid">Ends: {{ $coupon->expire_date->format('d/m/y') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div> 
        <div class="d-flex justify-content-center mt-4">
            {{ $popularCoupons->links() }}
        </div>
    </div>
</section>
<!-- Popular Offers End -->

<!-- Advertisements at Position 5 -->
@php
$position = 5;
$positionedAds = $advertisements->where('position', $position);
@endphp
@if($positionedAds->count() > 0)
<section class="advertisements-section py-6 py-md-10">
    <div class="container-fluid">
        <div class="row justify-content-center">
            @foreach($positionedAds as $ad)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="ad-item position-relative overflow-hidden rounded-3">
                    <img src="{{ asset('storage/' . $ad->image) }}" alt="Advertisement" class="w-100 h-auto rounded-3">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Buy One Get One Offers Start (Position 6) -->
@if($bogoCoupons->count() > 0)
<section class="top-stores trending-features py-12 py-md-20">
    <div class="container-fluid">
        <div class="row gy-6 gy-lg-0 pb-4 pb-lg-6 justify-content-between align-items-center">
            <div class="col-md-4">
                <div class="head-area">
                    <h3 class="n17-color">Buy One Get One <span class="s1-color">Offers</span></h3>
                </div>
            </div>
        </div>
        <div class="row cus-row gy-5 gy-xxl-6 justify-content-center justify-content-md-start">
            @foreach ($bogoCoupons as $coupon)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="single-box transition position-relative d-center flex-column text-center gap-4 gap-md-6 n1-bg-color cus-border border b-fourth box-shadow-p2 px-3 px-md-4 py-5 py-md-8 rounded-3">
                    <div class="abs-area position-absolute top-0 start-0 my-2 my-md-3 rounded-pill px-3 px-md-4 py-1 py-md-2 p1-2nd-bg-color cus-border border b-eighth">
                        <span class="f5-color fw-mid">BOGO</span>
                    </div>
                    <div class="d-center thumb-area rounded-circle">
                        <img loading="lazy" class="rounded-circle" src="{{ asset($coupon->image) }}" alt="{{ $coupon->title }}">
                    </div>
                    <div class="d-grid gap-2">
                        <span class="n15-color fs-seven fw-semibold">{{ $coupon->store->name }}</span>
                        <h5 class="n15-color fw-bold">{{ $coupon->title }}</h5>
                        <span class="n15-color fs-seven">{{ $coupon->store->coupons_count ?? $coupon->store->coupons->count() }} Coupons Available</span>                    </div>
                    @auth
                    <button
                        class="cmn-btn btn-overlay border-dash rounded-pill px-4 px-md-6 py-2 py-md-3 w-100 position-relative d-center"
                        data-bs-toggle="modal" data-bs-target="#getBogoCouponCode{{ $coupon->code }}"
                        data-coupon-code="{{ $coupon->code }}">
                        <span class="f5-color fw-semibold coupon-code w-100 d-center">{{ $coupon->code }}</span>
                        <span class="position-absolute show transition n1-color">Show Coupon</span>
                    </button>
                    @else
                    <button
                        class="cmn-btn btn-overlay border-dash rounded-pill px-4 px-md-6 py-2 py-md-3 w-100 position-relative d-center"
                        data-bs-toggle="modal" data-bs-target="#loginRequiredModal">
                        <span class="f5-color fw-semibold coupon-code w-100 d-center">{{ $coupon->code }}</span>
                        <span class="position-absolute show transition n1-color">Login to Get Coupon</span>
                    </button>
                    @endauth
                    <div class="rounded-3 px-3 px-md-4 py-1 py-md-2 p1-2nd-bg-color d-center gap-1 gap-md-2 cus-border border b-eighth">
                        <span class="d-center fs-four p2-color"><i class="ph ph-clock"></i></span>
                        <span class="f5-color fw-mid">Ends: {{ $coupon->expire_date->format('d/m/y') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $bogoCoupons->links() }}
        </div>
    </div>
</section>
@endif
<!-- Buy One Get One Offers End -->

<!-- Advertisements at Position 7 -->
@php
$position = 7;
$positionedAds = $advertisements->where('position', $position);
@endphp
@if($positionedAds->count() > 0)
<section class="advertisements-section py-6 py-md-10">
    <div class="container-fluid">
        <div class="row justify-content-center">
            @foreach($positionedAds as $ad)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="ad-item position-relative overflow-hidden rounded-3">
                    <img src="{{ asset('storage/' . $ad->image) }}" alt="Advertisement" class="w-100 h-auto rounded-3">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

    <!-- Ending Soon Offers Start (Position 8) -->
    @if($endingSoonCoupons->count() > 0)
<section class="top-stores trending-features py-12 py-md-20">
    <div class="container-fluid">
        <div class="row gy-6 gy-lg-0 pb-4 pb-lg-6 justify-content-between align-items-center">
            <div class="col-md-4">
                <div class="head-area">
                    <h3 class="n17-color">Ending <span class="s1-color">Soon</span></h3>
                </div>
            </div>
        </div>
        <div class="row cus-row gy-5 gy-xxl-6 justify-content-center justify-content-md-start">
            @foreach ($endingSoonCoupons as $coupon)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="single-box transition position-relative d-center flex-column text-center gap-4 gap-md-6 n1-bg-color cus-border border b-fourth box-shadow-p2 px-3 px-md-4 py-5 py-md-8 rounded-3">
                    <div class="abs-area position-absolute top-0 start-0 my-2 my-md-3 rounded-pill px-3 px-md-4 py-1 py-md-2 p1-2nd-bg-color cus-border border b-eighth">
                        <span class="f5-color fw-mid">Limited Time</span>
                    </div>
                    <div class="d-center thumb-area rounded-circle">
                        <img loading="lazy" class="rounded-circle" src="{{ asset($coupon->image) }}" alt="{{ $coupon->title }}">
                    </div>
                    <div class="d-grid gap-2">
                        <span class="n15-color fs-seven fw-semibold">{{ $coupon->store->name }}</span>
                        <h5 class="n15-color fw-bold">{{ $coupon->title }}</h5>
                        <span class="n15-color fs-seven">{{ $coupon->store->coupons_count ?? $coupon->store->coupons->count() }} Coupons Available</span>                    </div>
                    @auth
                    <button class="cmn-btn btn-overlay border-dash rounded-pill px-4 px-md-6 py-2 py-md-3 w-100 position-relative d-center" 
                            data-bs-toggle="modal" 
                            data-bs-target="#getEndingSoonCouponCode{{ $coupon->code }}" 
                            data-coupon-code="{{ $coupon->code }}">
                        <span class="f5-color fw-semibold coupon-code w-100 d-center">{{ $coupon->code }}</span>
                        <span class="position-absolute show transition n1-color">Show Coupon</span>
                    </button>
                    @else
                    <button class="cmn-btn btn-overlay border-dash rounded-pill px-4 px-md-6 py-2 py-md-3 w-100 position-relative d-center"
                            data-bs-toggle="modal" 
                            data-bs-target="#loginRequiredModal">
                        <span class="f5-color fw-semibold coupon-code w-100 d-center">{{ $coupon->code }}</span>
                        <span class="position-absolute show transition n1-color">Login to Get Coupon</span>
                    </button>
                    @endauth
                    <div class="rounded-3 px-3 px-md-4 py-1 py-md-2 p1-2nd-bg-color d-center gap-1 gap-md-2 cus-border border b-eighth">
                        <span class="d-center fs-four p2-color">
                            <i class="ph ph-clock"></i>
                        </span>
                        <span class="f5-color fw-mid">Ends: {{ $coupon->expire_date->format('d/m/y') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $endingSoonCoupons->links() }}
        </div>
    </div>
</section>
@endif
    <!-- Ending Soon Offers End -->

    <!-- Advertisements at Position 9 -->
    @php
        $position = 9;
        $positionedAds = $advertisements->where('position', $position);
    @endphp
    @if($positionedAds->count() > 0)
    <section class="advertisements-section py-6 py-md-10">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @foreach($positionedAds as $ad)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="ad-item position-relative overflow-hidden rounded-3">
                            <img src="{{ asset('storage/' . $ad->image) }}" alt="Advertisement" class="w-100 h-auto rounded-3">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

          <!-- Banner Area start (Position 10) -->
        <section class="banner-area d-flex overflow-visible rounded-3 cus-z1 position-relative">
            <div class="abs-area pe-none d-none d-lg-block d-xl-none d-xxl-block">
                <div class="img-area position-absolute cus-z-1 m-2 m-xxl-6 pe-0 pe-xl-6 pe-xxl-10 end-0 top-0">
                    <img loading="lazy" src="assets/images/product-img-4.png" alt="Image">
                </div>
            </div>
            <div class="container-fluid py-8 py-md-0 d-grid d-md-flex px-2 px-md-8 px-lg-12 d-center justify-content-center justify-content-lg-start align-items-start flex-column flex-md-row d-center flex-column flex-md-row gap-5 gap-xl-12">
                <div class="d-center justify-content-center justify-content-md-start gap-3 gap-md-4 h-100">
                    <div class="d-center">
                        <span class="display-three n17-color">20</span>
                    </div>
                    <div class="d-grid gap-1 gap-md-2">
                        <span class="n15-color fs-four">%</span>
                        <span class="n15-color fs-four">OFF</span>
                    </div>
                </div>
                <span class="v-line f-height fourth h-100 d-center position-relative d-none d-md-flex"></span>
                <div class="d-grid gap-3 gap-md-5 text-center py-0 py-md-9">
                    <h3 class="n17-color fw-bold">SEASONAL WEEKLY SALE 2024</h3>
                    <div class="d-center justify-content-center justify-content-md-start flex-wrap gap-2 gap-md-3">
                        <span class="n15-color fs-five">Use code</span>
                        <div class="d-inline-flex rounded-pill n1-bg-color px-3 px-md-4 py-2 gap-1 gap-md-2">
                            <span class="fw-mid fs-seven">Sale 2024</span>
                        </div>
                        <span class="n15-color fs-five">to get best offer</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- Banner Area end -->

    <!-- Advertisements at Position 11 -->
    @php
        $position = 11;
        $positionedAds = $advertisements->where('position', $position);
    @endphp
    @if($positionedAds->count() > 0)
    <section class="advertisements-section py-6 py-md-10">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @foreach($positionedAds as $ad)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="ad-item position-relative overflow-hidden rounded-3">
                            <img src="{{ asset('storage/' . $ad->image) }}" alt="Advertisement" class="w-100 h-auto rounded-3">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif


         <!-- Top Stores Start (Position 12) -->
    <section class="top-stores second pt-12 pt-md-20">
        <div class="container-fluid">
            <div class="row gy-6 gy-lg-0 pb-4 pb-lg-6 justify-content-between align-items-end">
                <div class="col-sm-7 col-lg-6">
                    <div class="head-area visible-slowly-right">
                        <h3 class="n17-color">Top <span class="s1-color">Stores</span></h3>
                    </div>
                </div>
                <div class="col-sm-5 col-lg-4 col-sm-4 d-center justify-content-start justify-content-sm-end">
                    <a href="{{ url('/stores') }}" class="d-center gap-2 gap-md-3">
                        <span class="p2-color fw-bold">See All Store</span>
                        <span class="d-center fs-five p2-color">
                            <i class="ph ph-arrow-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center justify-content-sm-start cus-row g-3">
                @foreach ($topStores as $store)
                    <div class="col-7 col-sm-6 col-md-6 col-lg-4 col-xxl-3">
                        <div class="single-box transition d-grid gap-4 gap-md-6 n1-bg-color cus-border border b-fourth p-4 p-md-6 rounded-3">
                            <div class="d-center justify-content-between gap-3 gap-md-5">
                                <div class="d-center justify-content-between gap-3 gap-md-4">
                                    <div class="d-center thumb-area rounded-2 w-100">
                                        <img src="{{ asset('storage/' . $store->logo) }}" alt="Image"">
                                    </div>
                                    <div class="d-grid gap-2">
                                        <h5 class="n15-color text-nowrap">{{ $store->name }}</h5>
                                        <div class="d-center justify-content-start gap-1">
                                            <span class="d-center fs-six f5-color">
                                                <i class="ph ph-map-pin-line"></i>
                                            </span>
                                            <span class="n15-color fs-seven">{{ $store->country }}</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="share-btn" data-url="{{ url('/stores/' . $store->slug) }}">
                                    <span class="d-center fs-four f11-color rounded-2 s1-4th-bg-color cus-border border b-sixth icon-area box-two">
                                        <i class="ph ph-share-network"></i>
                                    </span>
                                </button>
                            </div>
                            <div class="bottom-area d-grid gap-3 gap-md-4">
                                <p class="fs-six n17-color fw-mid">{{ $store->coupons->first()->description ?? 'No offers available' }}</p>
                                <div class="d-center justify-content-start gap-2">
                                    <span class="d-center fs-four f5-color">
                                        <i class="ph ph-calendar"></i>
                                    </span>
                                    <span class="n15-color fs-seven fw-mid">{{ $store?->coupons->first()?->expire_date->format('d M, y') ?? 'N/A' }}</span>
                                </div>
                                <div class="rounded-1 p1-2nd-bg-color d-center gap-2 gap-md-3 justify-content-start cus-border border b-ninth p-1">
                                    <div class="d-center fav-icon rounded-2 n1-bg-color box-shadow-p1">
                                        <img class="max-un" src="{{ asset('assets/images/fav.png') }}" alt="Favorite">
                                    </div>
                                    <span class="p2-color fs-eight fw-bold">Up to 58% Voucher</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Top Stores End -->

    <!-- Advertisements at Position 13 -->
    @php
        $position = 13;
        $positionedAds = $advertisements->where('position', $position);
    @endphp
    @if($positionedAds->count() > 0)
    <section class="advertisements-section py-6 py-md-10">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @foreach($positionedAds as $ad)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="ad-item position-relative overflow-hidden rounded-3">
                            <img src="{{ asset('storage/' . $ad->image) }}" alt="Advertisement" class="w-100 h-auto rounded-3">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif


{{--
<!-- Top Collections Start -->
<section class="top-stores top-collection pt-12 pt-md-20">
    <div class="container-fluid">
        <div class="row gy-6 gy-lg-0 pb-4 pb-lg-6 justify-content-between align-items-end">
            <div class="col-sm-7 col-lg-4">
                <div class="head-area visible-slowly-right">
                    <h3 class="n17-color">Top <span class="s1-color">Collections</span></h3>
                </div>
            </div>
            <div class="col-sm-5 col-lg-4 col-sm-4 d-center justify-content-start justify-content-sm-end">
                <a href="{{ url('/stores') }}" class="d-center gap-2 gap-md-3">
                    <span class="p2-color fw-bold">More Collections</span>
                    <span class="d-center fs-five p2-color">
                        <i class="ph ph-arrow-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="row cus-row g-3">
            @if ($featuredStore)
            <div class="col-7 col-sm-6 col-md-5 col-lg-4 col-xl-4 col-xxl-3 order-1 order-lg-0">
                <div
                    class="single-box text-center d-grid gap-2 gap-md-3 n1-bg-color cus-border border b-eighth p-3 p-md-5 rounded-2 d-center flex-column">
                    <span
                        class="f5-color fw-mid rounded-2 p1-2nd-bg-color text-center cus-border border b-tenth px-2 px-md-3 py-1 py-md-2">Featured
                        Store Of The Month</span>
                    <div class="d-center thumb-area rounded-2 w-100 position-relative">
                        <img loading="lazy" class="w-100" src="{{ asset($featuredStore->logo) }}"
                            alt="{{ $featuredStore->name }}">
                        <div
                            class="abs-area d-center s1-bg-color rounded-2 m-3 icon-area box-six position-absolute top-0 end-0">
                            <img loading="lazy" class="max-un" src="{{ asset($category->shape) }}"
                                alt="Crown">
                        </div>
                    </div>
                    <div class="bottom-area d-grid gap-3 gap-md-4 py-2">
                        <p class="fs-four n17-color fw-mid">{{ $featuredStore->name }} Offers</p>
                    </div>
                    <span
                        class="f5-color fw-mid rounded-2 s1-4th-bg-color cus-border border b-sixth px-2 px-md-3 py-1 py-md-2 d-flex justify-content-center gap-1 gap-md-2">
                        <span class="f11-color fs-eight text-nowrap fw-mid">{{ $featuredStore->coupons()->count() }}
                            Coupons</span>
                        <span class="v-line f-height second d-center position-relative"></span>
                        <span class="f11-color fs-eight text-nowrap fw-mid">{{
                            $featuredStore->coupons()->where('expire_date', '>=', now())->count() }} Offers</span>
                    </span>
                </div>
            </div>
            @endif
            <div class="col-md-12 col-lg-8 col-xl-8 col-xxl-9 d-grid gap-3 cus-grid grid-four">
                @foreach ($collectionStores as $store)
                <div
                    class="single-box d-center gap-2 gap-md-3 n1-bg-color cus-border border b-eighth p-2 p-xxl-3 rounded-2 ter position-relative">
                    <div class="d-center thumb-area rounded-2 w-100">
                        <img loading="lazy" class="w-100 h-100" src="{{ asset('storage/' . $store->logo) }}"
                            alt="Image">
                    </div>
                    <a href="{{ url('/stores/' . $store->slug) }}"
                        class="hovered-item transition opacity-0 cus-border border b-fifteen position-absolute n1-bg-color cus-z1 w-100 h-100 text-center d-center flex-column gap-1">
                        <h5 class="f5-color fw-mid">{{ $store->name }}</h5>
                        <span class="n15-color fs-eight text-decoration-underline fw-mid">{{ $store->coupons()->count()
                            }}+ Coupons</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Top Collections End --> --}}


     <!-- Popular Coupons Start (Position 14) -->
    <section class="popular-coupons pt-12 pt-md-20">
        <div class="container-fluid">
            <div class="row gy-6 gy-lg-0 pb-6 pb-lg-8 justify-content-between align-items-end">
                <div class="col-sm-7 col-lg-6">
                    <div class="head-area visible-slowly-right">
                        <h3 class="n17-color">Popular <span class="s1-color">Coupons</span></h3>
                    </div>
                </div>
                <div class="col-sm-5 col-lg-4 col-sm-4 d-center justify-content-start justify-content-sm-end">
                    <a href="{{ url('/coupons') }}" class="d-center gap-2 gap-md-3">
                        <span class="p2-color fw-bold">See All Coupons</span>
                        <span class="d-center fs-five p2-color">
                            <i class="ph ph-arrow-right"></i>
                        </span>
                    </a>
                </div>
            </div>
            <div class="position-relative">
                <div class="swiper popular-coupon-carousel">
                    <div class="swiper-wrapper">
                        @foreach ($popularCarouselCoupons as $coupon)
                            <div class="swiper-slide">
                                <div class="items-single n1-bg-color rounded-4 cus-border border b-fourth p-2 d-center flex-column">
                                    <div class="d-center flex-wrap p-3 p-md-4 w-100 justify-content-between gap-2 gap-md-3">
                                        <span class="f5-color fw-mid rounded-2 p1-2nd-bg-color cus-border border b-tenth px-2 px-md-3 py-1">{{ $coupon->is_exclusive ? 'Exclusive' : 'Featured' }}</span>
                                        <span class="f5-color fw-mid rounded-2 s1-4th-bg-color cus-border border b-sixth px-2 px-md-3 py-1 d-flex gap-2 gap-md-3">
                                            <span class="d-center fs-five f11-color">
                                                <i class="ph ph-calendar"></i>
                                            </span>
                                            <span class="f11-color fw-mid">{{ $coupon->expire_date->format('d M, y') }}</span>
                                        </span>
                                    </div>
                                    <div class="d-center thumb-area s1-2nd-bg-color w-100">
                                        <img loading="lazy" src="{{ $coupon->image ? asset('storage/' . $coupon->image) : asset('assets/images/popular-coupons-' . ($loop->index % 9 + 11) . '.png') }}"
     alt="{{ $coupon->title }}" class="w-100">
                                    </div>
                                    <div class="bottom-area d-grid gap-3 gap-md-4 p-3 p-md-6">
                                        <a href="{{ url('/stores/' . $coupon->store->slug) }}"><h4 class="n17-color fw-bold">{{ $coupon->title }}</h4></a>
                                        <div class="w-100 my-2 cus-border border-top border-bottom b-seventh py-2 py-md-3 d-center justify-content-between">
                                            <div class="d-center justify-content-start gap-1">
                                                <span class="d-center fs-five n15-color">
                                                    <i class="ph ph-lock"></i>
                                                </span>
                                                <span class="n15-color">5462</span>
                                            </div>
                                            <div class="d-center gap-2 gap-md-3">
                                                <a href="#" class="d-center gap-1 comment-btn" data-coupon-id="{{ $coupon->id }}">
                                                    <span class="d-center fs-five n15-color">
                                                        <i class="ph ph-chat-centered-text"></i>
                                                    </span>
                                                    <span class="n15-color">25</span>
                                                </a>
                                                <a href="#" class="d-center gap-1 share-btn" data-url="{{ url('/coupons/' . $coupon->id) }}">
                                                    <span class="d-center fs-five n15-color">
                                                        <i class="ph ph-share-network"></i>
                                                    </span>
                                                    <span class="n15-color">15</span>
                                                </a>
                                            </div>
                                        </div>
                                        @auth
                                        <button class="cmn-btn btn-overlay border-dash rounded-pill px-4 px-md-6 py-2 py-md-3 w-100 position-relative d-center" data-bs-toggle="modal" data-bs-target="#getCouponCodepop{{ $coupon->code }}" data-coupon-code="{{ $coupon->code }}">
                                            <span class="f5-color fw-semibold coupon-code w-100 d-center">{{ $coupon->code }}</span>
                                            <span class="position-absolute show transition n1-color">Show Coupon</span>
                                        </button>
                                       
                                        @else
                                                                   <button 
        class="cmn-btn btn-overlay border-dash rounded-pill px-4 px-md-6 py-2 py-md-3 w-100 position-relative d-center"
        data-bs-toggle="modal" 
        data-bs-target="#loginRequiredModal">
        <span class="f5-color fw-semibold coupon-code w-100 d-center">{{ $coupon->code }}</span>
        <span class="position-absolute show transition n1-color">Login to Get Coupon</span>
    </button>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="slider-btn cus-z1 position-absolute w-100 d-none d-sm-flex gap-2 gap-md-3 d-center justify-content-between">
                    <button type="button" aria-label="Previous slide" class="ara-prev box-shadow-p2 position-relative box-style box-third rounded-circle second-alt d-center slide-button">
                        <span class="fs-five d-center">
                            <i class="ph ph-arrow-left"></i>
                        </span>
                    </button>
                    <button type="button" aria-label="Next slide" class="ara-next box-shadow-p2 position-relative box-style box-third rounded-circle second-alt d-center slide-button">
                        <span class="fs-five d-center">
                            <i class="ph ph-arrow-right"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- Popular Coupons End -->

    <!-- Advertisements at Position 15 -->
    @php
        $position = 15;
        $positionedAds = $advertisements->where('position', $position);
    @endphp
    @if($positionedAds->count() > 0)
    <section class="advertisements-section py-6 py-md-10">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @foreach($positionedAds as $ad)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="ad-item position-relative overflow-hidden rounded-3">
                            <img src="{{ asset('storage/' . $ad->image) }}" alt="Advertisement" class="w-100 h-auto rounded-3">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

{{--
<!-- Customers Feedback Start -->
<section class="customers-feedback pt-12 pt-md-20">
    <div class="container-fluid">
        <div class="row gy-6 gy-lg-0 pb-6 pb-lg-8 justify-content-between align-items-end">
            <div class="col-sm-7 col-lg-6">
                <div class="head-area visible-slowly-right">
                    <h3 class="n17-color">Customers <span class="s1-color">Feedback</span></h3>
                </div>
            </div>
            <div class="col-sm-5 d-center justify-content-start justify-content-sm-end">
                <div class="slider-btn fixed-btn gap-3 gap-md-4 d-center">
                    <button type="button" aria-label="Previous slide"
                        class="ara-prev box-shadow-p2 position-relative box-style box-third rounded-circle second-alt d-center slide-button">
                        <span class="fs-five d-center">
                            <i class="ph ph-arrow-left"></i>
                        </span>
                    </button>
                    <button type="button" aria-label="Next slide"
                        class="ara-next box-shadow-p2 position-relative box-style box-third rounded-circle second-alt d-center slide-button">
                        <span class="fs-five d-center">
                            <i class="ph ph-arrow-right"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="swiper customers-feedback-carousel-fourth">
            <div class="swiper-wrapper">
                @foreach ($feedback as $item)
                <div class="swiper-slide">
                    <div
                        class="single-item transition mx-2 n1-bg-color rounded-4 cus-border border b-ninth py-5 py-md-8 px-3 px-md-8 d-grid gap-3 gap-md-4">
                        <div class="star-area d-flex gap-1 mb-1">
                            @for ($i = 1; $i <= $item->rating; $i++)
                                <a href="javascript:void(0)">
                                    <span class="d-center s1-color transition fs-eight">
                                        <i class="fas fa-star"></i>
                                    </span>
                                </a>
                                @endfor
                        </div>
                        <p class="n17-color fs-five">{{ $item->comment }}</p>
                        <div class="d-center mt-2 justify-content-between flex-wrap gap-3 gap-md-4">
                            <div class="d-center flex-wrap flex-sm-nowrap justify-content-start gap-3 gap-md-4">
                                <div class="img-area">
                                    <img loading="lazy" src="{{ asset($item->image) }}" class="max-un rounded-circle"
                                        alt="{{ $item->name }}">
                                </div>
                                <div class="text-area d-grid gap-2">
                                    <a href="#">
                                        <h5 class="fw-bolder transition n17-color">{{ $item->name }}</h5>
                                    </a>
                                    <span class="fs-seven n17-color transition">{{ $item->title }}</span>
                                </div>
                            </div>
                            <div
                                class="d-center d-none d-sm-flex quote-area flex-wrap flex-sm-nowrap justify-content-start gap-3 gap-md-4">
                                <span class="d-center n5-color transition display-three">
                                    <i class="ph ph-quotes"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Customers Feedback End --> --}}

<!-- Coupon Code Modal -->
{{-- <div class="modal fade" id="getCouponCode" tabindex="-1" aria-labelledby="getCouponCodeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="getCouponCodeLabel">Coupon Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Your coupon code is:</p>
                <h4 class="text-center coupon-code-display"></h4>
                <button class="btn btn-primary w-100 mt-3 copy-coupon-btn">Copy Code</button>
            </div>
        </div>
    </div>
</div> --}}


<!-- Get Coupon Code Modal -->
@foreach ($popularCarouselCoupons as $coupon)
{{-- @dd( $coupon ); --}}
<div class="modal fade" id="getCouponCodepop{{ $coupon->code }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered cmn-modal first-modal">
        <div class="modal-content border-0">
            <div class="modal-header border-0 position-absolute top-0 end-0 cus-z1">
                <button type="button" class="d-center fs-six n15-color btn-close opacity-100" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="d-center icon-area box-six p1-2nd-bg-color cus-border border b-twelfth">
                        <i class="ph ph-x"></i>
                    </span>
                </button>
            </div>
            <div class="modal-body px-0 py-6 py-md-0">
                <div class="d-center flex-column gap-2 gap-md-3 py-3 py-md-5">
                    <h5 class="n17-color fw-mid text-center mb-2 px-8 px-md-0">{{ $coupon->title }}</h5>
                    <div class="row px-2 px-md-0 justify-content-center">
                        <div class="col-xl-10">
                            <div class="cmn-btn btn-overlay border-dash rounded-pill w-100 d-center input-area">
                                <input type="text" value="{{ $coupon->code }}" placeholder="Coupon Code" readonly
                                    class="p1-color fs-seven fw-bold coupon-code w-100 px-6 px-md-12 d-center">
                                <button
                                    class="box-style box-second rounded-pill border-stb-none py-3 py-md-4 px-6 px-md-12 d-center copy-btn">
                                    <span class="d-center fs-seven fw-bold">Copy</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <p class="f11-color fw-mid">Continue to {{ $coupon->store->name }} • <a
                            href="{{ route('coupons.index') }}" class="n15-color fw-mid">Terms</a></p>
                </div>
                <div
                    class="main-content cus-border border-top border-bottom b-seventh d-grid gap-3 gap-md-4 px-3 px-md-6 py-4 py-md-5">
                    <p class="fs-eight"><span class="fw-mid fs-eight">Offer's Details: </span>{{
                        $coupon->description }}</p>
                    <p class="fs-eight"><span class="fw-mid fs-eight">Expires: </span>{{
                        $coupon->expire_date->format('d M, Y') }}</p>
                    @if ($coupon->is_exclusive && $coupon->exclusive_amount)
                    <p class="fs-eight"><span class="fw-mid fs-eight">Exclusive Amount: </span>{{
                        number_format($coupon->exclusive_amount, 2) }}%</p>
                    @endif
                    <div class="terms">
                        <p class="fs-eight"><span class="fw-mid fs-eight">Terms:</span></p>
                        <ul class="d-grid gap-1 ul-dots fs-eight ms-6">
                            <li>Exclusions may apply.</li>
                            <li>Verify the website for further details.</li>
                            <li>The merchant may apply stock limitations for this offer.</li>
                            <li>Discount deals can be limited by the seller at any given time.</li>
                            <li>You can save using this deal only for online purchases.</li>
                        </ul>
                    </div>
                </div>
                <div class="bottom-area d-center gap-1 gap-md-2 flex-wrap py-3 py-md-5">
                    <span class="fw-mid fs-seven me-2">Did it work?</span>
                    <form action="" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="worked" value="1">
                        <button type="submit" class="s2-3rd-bg-color rounded-2 d-center gap-1 px-2 px-md-3 py-1">
                            <span class="d-center fs-six s2-color"><i class="ph ph-thumbs-up"></i></span>
                            <span class="s2-color fw-bold">Yes</span>
                        </button>
                    </form>
                    <form action="" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="worked" value="0">
                        <button type="submit" class="f13-2nd-bg-color rounded-2 d-center gap-1 px-2 px-md-3 py-1">
                            <span class="d-center fs-six f13-color"><i class="ph ph-thumbs-down"></i></span>
                            <span class="f13-color fw-bold">No</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach



<!-- Get Coupon Code Modal -->
@foreach ($popularCoupons as $coupon)
{{-- @dd( $coupon ); --}}
<div class="modal fade" id="getCouponCodetre{{ $coupon->code }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered cmn-modal first-modal">
        <div class="modal-content border-0">
            <div class="modal-header border-0 position-absolute top-0 end-0 cus-z1">
                <button type="button" class="d-center fs-six n15-color btn-close opacity-100" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="d-center icon-area box-six p1-2nd-bg-color cus-border border b-twelfth">
                        <i class="ph ph-x"></i>
                    </span>
                </button>
            </div>
            <div class="modal-body px-0 py-6 py-md-0">
                <div class="d-center flex-column gap-2 gap-md-3 py-3 py-md-5">
                    <h5 class="n17-color fw-mid text-center mb-2 px-8 px-md-0">{{ $coupon->title }}</h5>
                    <div class="row px-2 px-md-0 justify-content-center">
                        <div class="col-xl-10">
                            <div class="cmn-btn btn-overlay border-dash rounded-pill w-100 d-center input-area">
                                <input type="text" value="{{ $coupon->code }}" placeholder="Coupon Code" readonly
                                    class="p1-color fs-seven fw-bold coupon-code w-100 px-6 px-md-12 d-center">
                                <button
                                    class="box-style box-second rounded-pill border-stb-none py-3 py-md-4 px-6 px-md-12 d-center copy-btn">
                                    <span class="d-center fs-seven fw-bold">Copy</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <p class="f11-color fw-mid">Continue to {{ $coupon->store->name }} • <a
                            href="{{ route('coupons.index') }}" class="n15-color fw-mid">Terms</a></p>
                </div>
                <div
                    class="main-content cus-border border-top border-bottom b-seventh d-grid gap-3 gap-md-4 px-3 px-md-6 py-4 py-md-5">
                    <p class="fs-eight"><span class="fw-mid fs-eight">Offer's Details: </span>{{
                        $coupon->description }}</p>
                    <p class="fs-eight"><span class="fw-mid fs-eight">Expires: </span>{{
                        $coupon->expire_date->format('d M, Y') }}</p>
                    @if ($coupon->is_exclusive && $coupon->exclusive_amount)
                    <p class="fs-eight"><span class="fw-mid fs-eight">Exclusive Amount: </span>{{
                        number_format($coupon->exclusive_amount, 2) }}%</p>
                    @endif
                    <div class="terms">
                        <p class="fs-eight"><span class="fw-mid fs-eight">Terms:</span></p>
                        <ul class="d-grid gap-1 ul-dots fs-eight ms-6">
                            <li>Exclusions may apply.</li>
                            <li>Verify the website for further details.</li>
                            <li>The merchant may apply stock limitations for this offer.</li>
                            <li>Discount deals can be limited by the seller at any given time.</li>
                            <li>You can save using this deal only for online purchases.</li>
                        </ul>
                    </div>
                </div>
                <div class="bottom-area d-center gap-1 gap-md-2 flex-wrap py-3 py-md-5">
                    <span class="fw-mid fs-seven me-2">Did it work?</span>
                    <form action="" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="worked" value="1">
                        <button type="submit" class="s2-3rd-bg-color rounded-2 d-center gap-1 px-2 px-md-3 py-1">
                            <span class="d-center fs-six s2-color"><i class="ph ph-thumbs-up"></i></span>
                            <span class="s2-color fw-bold">Yes</span>
                        </button>
                    </form>
                    <form action="" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="worked" value="0">
                        <button type="submit" class="f13-2nd-bg-color rounded-2 d-center gap-1 px-2 px-md-3 py-1">
                            <span class="d-center fs-six f13-color"><i class="ph ph-thumbs-down"></i></span>
                            <span class="f13-color fw-bold">No</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


<!-- Get Coupon Code Modal for BOGO Coupons -->
@foreach ($bogoCoupons as $coupon)
<div class="modal fade" id="getBogoCouponCode{{ $coupon->code }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered cmn-modal first-modal">
        <div class="modal-content border-0">
            <div class="modal-header border-0 position-absolute top-0 end-0 cus-z1">
                <button type="button" class="d-center fs-six n15-color btn-close opacity-100" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="d-center icon-area box-six p1-2nd-bg-color cus-border border b-twelfth">
                        <i class="ph ph-x"></i>
                    </span>
                </button>
            </div>
            <div class="modal-body px-0 py-6 py-md-0">
                <div class="d-center flex-column gap-2 gap-md-3 py-3 py-md-5">
                    <h5 class="n17-color fw-mid text-center mb-2 px-8 px-md-0">{{ $coupon->title }}</h5>
                    <div class="row px-2 px-md-0 justify-content-center">
                        <div class="col-xl-10">
                            <div class="cmn-btn btn-overlay border-dash rounded-pill w-100 d-center input-area">
                                <input type="text" value="{{ $coupon->code }}" placeholder="Coupon Code" readonly
                                    class="p1-color fs-seven fw-bold coupon-code w-100 px-6 px-md-12 d-center">
                                <button
                                    class="box-style box-second rounded-pill border-stb-none py-3 py-md-4 px-6 px-md-12 d-center copy-btn">
                                    <span class="d-center fs-seven fw-bold">Copy</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <p class="f11-color fw-mid">Continue to {{ $coupon->store->name }} • <a
                            href="{{ route('coupons.index') }}" class="n15-color fw-mid">Terms</a></p>
                </div>
                <div
                    class="main-content cus-border border-top border-bottom b-seventh d-grid gap-3 gap-md-4 px-3 px-md-6 py-4 py-md-5">
                    <p class="fs-eight"><span class="fw-mid fs-eight">Offer's Details: </span>{{
                        $coupon->description }}</p>
                    <p class="fs-eight"><span class="fw-mid fs-eight">Expires: </span>{{
                        $coupon->expire_date->format('d M, Y') }}</p>
                    @if ($coupon->is_exclusive && $coupon->exclusive_amount)
                    <p class="fs-eight"><span class="fw-mid fs-eight">Exclusive Amount: </span>{{
                        number_format($coupon->exclusive_amount, 2) }}%</p>
                    @endif
                    <div class="terms">
                        <p class="fs-eight"><span class="fw-mid fs-eight">Terms:</span></p>
                        <ul class="d-grid gap-1 ul-dots fs-eight ms-6">
                            <li>Exclusions may apply.</li>
                            <li>Verify the website for further details.</li>
                            <li>The merchant may apply stock limitations for this offer.</li>
                            <li>Discount deals can be limited by the seller at any given time.</li>
                            <li>You can save using this deal only for online purchases.</li>
                        </ul>
                    </div>
                </div>
                <div class="bottom-area d-center gap-1 gap-md-2 flex-wrap py-3 py-md-5">
                    <span class="fw-mid fs-seven me-2">Did it work?</span>
                    <form action="" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="worked" value="1">
                        <button type="submit" class="s2-3rd-bg-color rounded-2 d-center gap-1 px-2 px-md-3 py-1">
                            <span class="d-center fs-six s2-color"><i class="ph ph-thumbs-up"></i></span>
                            <span class="s2-color fw-bold">Yes</span>
                        </button>
                    </form>
                    <form action="" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="worked" value="0">
                        <button type="submit" class="f13-2nd-bg-color rounded-2 d-center gap-1 px-2 px-md-3 py-1">
                            <span class="d-center fs-six f13-color"><i class="ph ph-thumbs-down"></i></span>
                            <span class="f13-color fw-bold">No</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


<!-- Get Coupon Code Modal for Ending Soon Coupons -->
@foreach ($endingSoonCoupons as $coupon)
<div class="modal fade" id="getEndingSoonCouponCode{{ $coupon->code }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered cmn-modal first-modal">
        <div class="modal-content border-0">
            <div class="modal-header border-0 position-absolute top-0 end-0 cus-z1">
                <button type="button" class="d-center fs-six n15-color btn-close opacity-100" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span class="d-center icon-area box-six p1-2nd-bg-color cus-border border b-twelfth">
                        <i class="ph ph-x"></i>
                    </span>
                </button>
            </div>
            <div class="modal-body px-0 py-6 py-md-0">
                <div class="d-center flex-column gap-2 gap-md-3 py-3 py-md-5">
                    <h5 class="n17-color fw-mid text-center mb-2 px-8 px-md-0">{{ $coupon->title }}</h5>
                    <div class="row px-2 px-md-0 justify-content-center">
                        <div class="col-xl-10">
                            <div class="cmn-btn btn-overlay border-dash rounded-pill w-100 d-center input-area">
                                <input type="text" value="{{ $coupon->code }}" placeholder="Coupon Code" readonly
                                    class="p1-color fs-seven fw-bold coupon-code w-100 px-6 px-md-12 d-center">
                                <button
                                    class="box-style box-second rounded-pill border-stb-none py-3 py-md-4 px-6 px-md-12 d-center copy-btn">
                                    <span class="d-center fs-seven fw-bold">Copy</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <p class="f11-color fw-mid">Continue to {{ $coupon->store->name }} • <a
                            href="{{ route('coupons.index') }}" class="n15-color fw-mid">Terms</a></p>
                </div>
                <div
                    class="main-content cus-border border-top border-bottom b-seventh d-grid gap-3 gap-md-4 px-3 px-md-6 py-4 py-md-5">
                    <p class="fs-eight"><span class="fw-mid fs-eight">Offer's Details: </span>{{
                        $coupon->description }}</p>
                    <p class="fs-eight"><span class="fw-mid fs-eight">Expires: </span>{{
                        $coupon->expire_date->format('d M, Y') }}</p>
                    @if ($coupon->is_exclusive && $coupon->exclusive_amount)
                    <p class="fs-eight"><span class="fw-mid fs-eight">Exclusive Amount: </span>{{
                        number_format($coupon->exclusive_amount, 2) }}%</p>
                    @endif
                    <div class="terms">
                        <p class="fs-eight"><span class="fw-mid fs-eight">Terms:</span></p>
                        <ul class="d-grid gap-1 ul-dots fs-eight ms-6">
                            <li>Exclusions may apply.</li>
                            <li>Verify the website for further details.</li>
                            <li>The merchant may apply stock limitations for this offer.</li>
                            <li>Discount deals can be limited by the seller at any given time.</li>
                            <li>You can save using this deal only for online purchases.</li>
                        </ul>
                    </div>
                </div>
                <div class="bottom-area d-center gap-1 gap-md-2 flex-wrap py-3 py-md-5">
                    <span class="fw-mid fs-seven me-2">Did it work?</span>
                    <form action="" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="worked" value="1">
                        <button type="submit" class="s2-3rd-bg-color rounded-2 d-center gap-1 px-2 px-md-3 py-1">
                            <span class="d-center fs-six s2-color"><i class="ph ph-thumbs-up"></i></span>
                            <span class="s2-color fw-bold">Yes</span>
                        </button>
                    </form>
                    <form action="" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="worked" value="0">
                        <button type="submit" class="f13-2nd-bg-color rounded-2 d-center gap-1 px-2 px-md-3 py-1">
                            <span class="d-center fs-six f13-color"><i class="ph ph-thumbs-down"></i></span>
                            <span class="f13-color fw-bold">No</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


<!-- Login Required Modal -->
<div class="modal fade" id="loginRequiredModal" tabindex="-1" aria-labelledby="loginRequiredLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <!-- Header with gradient -->
            <div class="modal-header border-0 text-white"
                style="background: linear-gradient(135deg, #0d6efd, #6610f2);">
                <h5 class="modal-title fw-bold" id="loginRequiredLabel">🔒 Login Required</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-person-lock fs-1 text-primary"></i>
                </div>
                <h5 class="fw-semibold mb-2">Access Restricted</h5>
                <p class="text-muted mb-4">You need to <strong>login</strong> or <strong>create an account</strong> to
                    unlock this coupon.</p>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary px-4 py-2 rounded-pill">
                        <i class="bi bi-person-plus me-1"></i> Sign Up
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer border-0 justify-content-center bg-light">
                <small class="text-muted">Don’t have an account? Join us today!</small>
            </div>
        </div>
    </div>
</div>


@endsection

{{--
@section('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.banner-carousel', {
                loop: true,
                pagination: {
                    el: '.slider-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 5000,
                },
                spaceBetween: 16,
                slidesPerView: 1,
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1200: {
                        slidesPerView: 3,
                    },
                },
            });
        });
</script> --}}
{{-- @endsection --}}