@extends('layouts.app')

@section('content')
<!-- Banner Section -->
<section
    class="banner-section index-one overflow-hidden position-relative mx-2 mx-md-4 mx-xl-6 mt-2 mt-md-4 mt-xl-6 s1-2nd-bg-color rounded-3 cus-border border">
    {{-- <div class="container position-relative pt-2 mt-10 mt-md-20">
        <div class="row g-9 g-lg-0 align-items-center py-6 py-sm-5">
            <div class="col-lg-6 pe-4 pe-md-10">
                <div class="d-grid gap-4 gap-md-6 position-relative cus-z1">
                    <h2 class="display-three n17-color">Coupon Style 02</h2>
                    <div class="breadcrumb-area">
                        <nav aria-label="breadcrumb">
                            <ol
                                class="breadcrumb second position-relative m-0 d-center justify-content-start gap-2 gap-md-3">
                                <li class="breadcrumb-item d-flex align-items-center fs-seven"><a
                                        href="{{ route('coupons.index') }}" class="n17-color">Browse Coupons</a></li>
                                <li class="breadcrumb-item d-flex align-items-center fs-seven active"
                                    aria-current="page"><span class="fw-mid f5-color">Coupon Style 02</span></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pe-4 pe-md-10 d-none d-md-flex">
                <div class="img-area position-absolute end-0 bottom-0">
                    <img src="{{ asset('assets/images/banner-illus-2.png') }}" alt="Coupon Style 02 Banner"
                        class="img-fluid">
                </div>
            </div>
        </div>
    </div> --}}
</section>

<!-- Submit Coupon Modal -->


    <!-- Get Coupon Code Modal -->
    @foreach ($coupons as $coupon)
    {{-- @dd( $coupon ); --}}
    <div class="modal fade" id="getCouponCode{{ $coupon->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered cmn-modal first-modal">
            <div class="modal-content border-0">
                <div class="modal-header border-0 position-absolute top-0 end-0 cus-z1">
                    <button type="button" class="d-center fs-six n15-color btn-close opacity-100"
                        data-bs-dismiss="modal" aria-label="Close">
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

    <!-- Right Sidebar -->
    <div class="right-sidebar target-item transition position-relative">
        <div class="cus-scrollbar transition side-wrapper position-fixed top-0 end-0 rounded-4">
            <div class="sidebar-wrapper d-flex flex-column gap-6 rounded-4 n1-bg-color cus-border border b-ninth">
                <div class="sidebar-area py-4 py-md-8 px-5 px-md-8">
                    <div class="d-grid gap-3 gap-md-4 position-relative">
                        <button>
                            <span class="close-btn fs-four d-center position-absolute end-0 top-0">
                                <i class="ph ph-x"></i>
                            </span>
                        </button>
                        <h4 class="n17-color">Filter</h4>
                        <div class="single-bar">
                            <span class="v-line w-100 position-relative d-center f-width pt-3 pb-3 pb-md-6"></span>
                            <form action="{{ route('coupons.index') }}" method="GET" class="row gy-3 gy-md-5">
                                <div class="col-md-12">
                                    <div class="input-area rounded-pill cus-border border b-seventh transition">
                                        <div
                                            class="single-select third w-100 position-relative px-4 px-md-6 py-3 py-md-4">
                                            <span
                                                class="label position-absolute fs-nine n15-color n1-bg-color start-0 px-1 px-md-2 mx-3 mx-md-4">Keyword</span>
                                            <input type="text" name="keyword" placeholder="Type keyword..."
                                                class="w-100" value="{{ request('keyword') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-area rounded-pill cus-border border b-seventh transition">
                                        <div
                                            class="single-select rtl-init third w-100 position-relative px-4 px-md-6 py-3 py-md-4">
                                            <span
                                                class="label position-absolute fs-nine n15-color n1-bg-color start-0 px-1 px-md-2 mx-3 mx-md-4">Store</span>
                                            <select class="select-two" name="store">
                                                <option value="">Select Store</option>
                                                @foreach ($stores as $store)
                                                <option value="{{ $store->slug }}" {{ request('store')==$store->slug ?
                                                    'selected' : '' }}>{{ $store->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-area rounded-pill cus-border border b-seventh transition">
                                        <div
                                            class="single-select rtl-init third w-100 position-relative px-4 px-md-6 py-3 py-md-4">
                                            <span
                                                class="label position-absolute fs-nine n15-color n1-bg-color start-0 px-1 px-md-2 mx-3 mx-md-4">Category</span>
                                            <select class="select-two" name="category">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->slug }}" {{
                                                    request('category')==$category->slug ? 'selected' : '' }}>{{
                                                    $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-area rounded-pill cus-border border b-seventh transition">
                                        <div
                                            class="single-select third w-100 position-relative px-4 px-md-6 py-3 py-md-4">
                                            <span
                                                class="label position-absolute fs-nine n15-color n1-bg-color start-0 px-1 px-md-2 mx-3 mx-md-4">Expire
                                                Date</span>
                                            <input type="text" name="expire_date" class="datepicker w-100"
                                                placeholder="Select Date" value="{{ request('expire_date') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="box-style box-second first-alt gap-2 gap-md-2 rounded-pill py-2 py-md-3 px-5 px-md-7 d-center w-100 bg-transparent">
                                        <span class="fs-six text-nowrap fw-mid transition">Apply Filters</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="single-bar">
                            <span class="v-line w-100 position-relative d-center f-width pt-3 pb-3 pb-md-6"></span>
                            <h5 class="n17-color mb-4 mb-md-6">Suggested Categories</h5>
                            <form action="{{ route('coupons.index') }}" method="GET" class="d-grid gap-3 gap-md-5">
                                @foreach ($categories as $category)
                                <label class="single-checkbox position-relative justify-content-between">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        class="d-none" {{ in_array($category->id, request('categories', [])) ? 'checked'
                                    : '' }}>
                                    <span
                                        class="checkmark fs-six rounded-2 transition d-center position-absolute start-0"></span>
                                    <span class="d-center ms-9 justify-content-between">
                                        <span class="title-area">{{ $category->name }}</span>
                                        <span class="title-area">{{ $category->coupons_count }}</span>
                                    </span>
                                </label>
                                @endforeach
                                <div class="btn-area mt-4 mt-md-6">
                                    <a href="{{ route('coupons.index') }}"
                                        class="d-center justify-content-start gap-2 gap-md-3">
                                        <span class="p2-color fw-bold">See All</span>
                                        <span class="d-center fs-five p2-color"><i class="ph ph-arrow-right"></i></span>
                                    </a>
                                </div>
                            </form>
                        </div> --}}
                        <div class="single-bar">
                            <span class="v-line w-100 position-relative d-center f-width pt-3 pb-3 pb-md-6"></span>
                            <h5 class="n17-color mb-4 mb-md-6">Popular Tags</h5>
                            <ul class="d-flex flex-wrap gap-3 gap-md-4">
                                @foreach (['Coupons', 'Flash Sale', 'Exclusive', 'Best offer', 'Trending', 'Discount',
                                '2024', 'Hot Deal'] as $tag)
                                <li>
                                    <a href="{{ route('coupons.index', ['tag' => $tag]) }}"
                                        class="box-style box-second third-alt rounded-pill py-2 py-md-2 px-3 px-md-5 d-center d-inline-flex">
                                        <span class="fs-six text-nowrap transition">{{ $tag }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="btn-area mt-4 mt-md-6">
                                <a href="{{ route('coupons.index') }}"
                                    class="d-center justify-content-start gap-2 gap-md-3">
                                    <span class="p2-color fw-bold">More Tag</span>
                                    <span class="d-center fs-five p2-color"><i class="ph ph-arrow-right"></i></span>
                                </a>
                            </div>
                        </div>
                        <div class="single-bar">
                            <span class="v-line w-100 position-relative d-center f-width pt-3 pb-3 pb-md-6"></span>
                            <div class="btn-area">
                                <a href="{{ route('coupons.index') }}"
                                    class="box-style box-second first-alt gap-2 gap-md-2 rounded-pill py-2 py-md-3 px-5 px-md-7 d-center w-100 bg-transparent">
                                    <span class="d-center fs-five"><i class="ph ph-arrow-clockwise"></i></span>
                                    <span class="fs-six text-nowrap fw-mid transition">Reset Filters</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Advertisements Section -->
        @if($advertisements->count() > 0)
        <section class="advertisements-section py-6 py-md-10">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach($advertisements as $ad)
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <div class="ad-item position-relative overflow-hidden rounded-3">
                                <img src="{{ asset($ad->image) }}" alt="Advertisement" class="w-100 h-auto rounded-3">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
        <!-- Advertisements Section -->

        <!-- Coupon Listings Section -->
        <section class="section-sidebar pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12 cus-z1">
                        <div
                            class="d-center justify-content-between gap-3 flex-wrap mb-5 mb-md-8 n1-bg-color cus-border border b-ninth px-4 px-md-6 py-3 py-md-4 rounded-4">
                            <p class="n15-color fs-seven">Showing {{ $coupons->firstItem() }}–{{ $coupons->lastItem() }}
                                of {{ $coupons->total() }} Results</p>
                            <div class="end-area d-center gap-4 gap-md-7">
                                <div class="filter-btn">
                                    <button
                                        class="box-style box-second first-alt right-sidebar-btn gap-2 gap-md-2 rounded-pill py-2 py-md-3 px-3 px-md-5 d-center w-100 bg-transparent">
                                        <span class="d-center fs-five n17-color"><i
                                                class="ph ph-faders-horizontal"></i></span>
                                        <span class="fs-six text-nowrap fw-mid transition">Filter</span>
                                    </button>
                                </div>
                                <div class="sort-by d-center gap-2 gap-md-3">
                                    <span class="n15-color d-none d-sm-flex">Sort By :</span>
                                    <div
                                        class="input-area n1-bg-color rounded-pill cus-border border b-seventh transition">
                                        <div
                                            class="w-auto single-select w-100 position-relative px-4 px-md-6 py-3 py-md-3">
                                            <select class="select-two" name="sort" onchange="this.form.submit()">
                                                <option value="newest" {{ request('sort')=='newest' ? 'selected' : ''
                                                    }}>Newest</option>
                                                <option value="oldest" {{ request('sort')=='oldest' ? 'selected' : ''
                                                    }}>Oldest</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="grid-list-btn d-center d-none d-lg-flex gap-1 cus-border border b-eighth rounded-pill p1-2nd-bg-color p-1">
                                    <button
                                        class="icon-area box-seven transition n1-bg-color rounded-circle d-center grid-active active">
                                        <span class="d-center fs-five"><i class="ph ph-squares-four"></i></span>
                                    </button>
                                    <button
                                        class="icon-area box-seven transition n1-bg-color rounded-circle d-center list-active">
                                        <span class="d-center fs-five"><i class="ph ph-list"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div
                            class="top-stores coupon-style d-grid gap-3 gap-md-4 grid-list-template justify-content-center justify-content-xl-start mx-0 g-3">
                            @foreach ($coupons as $coupon)
                            <div
                                class="single-box transition rounded-2 n1-bg-color cus-border border b-fourth p-2 d-center d-grid">
                                <div class="top-area">
                                    <div
                                        class="d-center justify-content-between gap-2 gap-md-3 m-3 m-md-4 exclusive transition">
                                        @if ($coupon->is_exclusive)
                                        <span
                                            class="f5-color fw-mid rounded-2 p1-2nd-bg-color cus-border border b-fifth px-2 px-md-3 py-1">Exclusive</span>
                                        @endif
                                        <span
                                            class="f5-color fw-mid rounded-2 s1-4th-bg-color cus-border border b-sixth px-2 px-md-3 py-1 d-flex gap-2 gap-md-3">
                                            <span class="d-center fs-five f11-color"><i
                                                    class="ph ph-calendar"></i></span>
                                            <span class="f11-color fw-mid">{{ $coupon->expire_date->format('d M, y')
                                                }}</span>
                                        </span>
                                    </div>
                                    <div class="d-center thumb-area s1-2nd-bg-color w-100">
                                        <img loading="lazy" src="{{ $coupon->image ? asset('storage/' . $coupon->image) : asset('assets/images/popular-coupons-' . ($loop->index % 9 + 11) . '.png') }}"
     alt="{{ $coupon->title }}" class="w-100 rounded-2">
                                    </div>
                                </div>
                                <div
                                    class="end-area d-grid h-100 gap-3 gap-md-4 p-3 p-md-6 justify-content-between transition">
                                    <div class="d-grid gap-3 gap-md-4 transition">
                                        <div class="d-center justify-content-start gap-2 gap-md-3 exclusive-second">
                                            @if ($coupon->is_exclusive)
                                            <span
                                                class="f5-color fw-mid rounded-2 p1-2nd-bg-color cus-border border b-fifth px-2 px-md-3 py-1">Exclusive</span>
                                            @endif
                                            <span
                                                class="f5-color fw-mid rounded-2 s1-4th-bg-color cus-border border b-sixth px-2 px-md-3 py-1 d-flex gap-2 gap-md-3">
                                                <span class="d-center fs-five f11-color"><i
                                                        class="ph ph-calendar"></i></span>
                                                <span class="f11-color fw-mid">{{ $coupon->expire_date->format('d M, y')
                                                    }}</span>
                                            </span>
                                        </div>
                                        <a href="{{ route('coupons.index') }}">
                                            <h4 class="n17-color fw-bold">{{ $coupon->title }}</h4>
                                        </a>
                                        <div
                                            class="my-2 cus-border border-top border-bottom b-seventh py-2 py-md-3 d-center justify-content-between">
                                            <div class="d-center justify-content-start gap-1">
                                                <span class="d-center fs-five n15-color"><i
                                                        class="ph ph-lock"></i></span>
                                                <span class="n15-color">{{ $coupon->expire_date->format('d M, y')
                                                    }}</span>
                                            </div>
                                            <div class="d-center gap-2 gap-md-3">
                                                <a href="#" class="d-center gap-1">
                                                    <span class="d-center fs-five n15-color"><i
                                                            class="ph ph-chat-centered-text"></i></span>
                                                    <span class="n15-color">{{ $coupon->usages()->count() }}</span>
                                                </a>
                                                <a href="#" class="d-center gap-1">
                                                    <span class="d-center fs-five n15-color"><i
                                                            class="ph ph-share-network"></i></span>
                                                    <span class="n15-color">{{ $coupon->usages()->count() }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="v-line f-height position-relative h-100"></span>
                                    <div
                                        class="right-item text-center d-flex flex-column justify-content-center gap-2 gap-md-3">
                                        <span class="n15-color fs-seven">
                                            @if ($coupon->is_exclusive && $coupon->exclusive_amount)
                                            Save up to {{ number_format($coupon->exclusive_amount, 2) }}% on {{
                                            $coupon->store->name }} Coupons
                                            @else
                                            Save on {{ $coupon->store->name }} Coupons
                                            @endif
                                        </span>
                                        <div class="btn-area">
                                            @auth
                                            <button class="cmn-btn btn-overlay border-dash rounded-pill px-4 px-md-6 py-2 py-md-3 w-100 position-relative d-center copy-coupon-btn" data-coupon-code="{{ $coupon->code }}">
                                                <span class="f5-color fw-semibold coupon-code w-100 d-center">{{ $coupon->code }}</span>
                                                <span class="position-absolute show transition n1-color">Copy Coupon</span>
                                            </button>
                                            @else
                                            <a href="{{ route('login') }}" class="cmn-btn btn-overlay border-dash rounded-pill px-4 px-md-6 py-2 py-md-3 w-100 position-relative d-center">
                                                <span class="f5-color fw-semibold coupon-code w-100 d-center">Login to see coupon</span>
                                            </a>
                                            @endauth
                                        </div>
                                        <a href="{{ route('coupons.index', ['store' => $coupon->store->slug]) }}"
                                            class="d-center gap-1 gap-md-2">
                                            <span class="p2-color fw-bold">More Coupons</span>
                                            <span class="d-center fs-five p2-color"><i
                                                    class="ph ph-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-12">
                            <nav aria-label="Page navigation" class="d-flex justify-content-center mt-4 mt-md-8">
                             {{ $coupons->links('pagination.custom') }}

                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endsection