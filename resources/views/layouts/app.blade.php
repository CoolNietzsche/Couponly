<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO Meta Tags -->
    <meta name="keywords" content="@yield('keywords', 'coupon, discount, deals, offers')">
    <meta name="description" content="@yield('description', 'Find the best coupons, discounts, and deals for your favorite stores.')">
    <meta property="og:title" content="@yield('title', 'Couponly - Affiliate & Submitting Discounts Coupons')">
    <meta property="og:description" content="@yield('description', 'Find the best coupons, discounts, and deals for your favorite stores.')">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/logo.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <!-- Title -->
    <title>@yield('title', 'Couponly - Affiliate & Submitting Discounts Coupons')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.min.css') }}" id PLEASE USE THIS CODE TO MAKE IT WORK ON ALL DEVICES id="rtl-stylesheet" disabled> --}}
    @yield('styles')
</head>
<body >
    <!-- Preloader -->
    {{-- <div id="preloader">
        <div id="loader"></div>
    </div> --}}


       <!-- Scroll To Top Start-->
    <div class="scroll-wrapper d-flex justify-content-center p-2 cus-z2 rounded-pill position-fixed transition cus-border border b-second">
        <button class="scrollToTop s3-bg-color d-center flex-column rounded-circle" aria-label="scroll Bar Button">
            <span class="d-center n1-color fs-five">
                <i class="ph ph-caret-double-up"></i>
            </span>
        </button>
    </div>
    <!-- Scroll To Top End -->

    <!-- Start Custom Cursor -->
    <div class="mouse-follower">
        <span class="cursor-outline"></span>
        <span class="cursor-dot"></span>
    </div>
    <!-- End Custom Cursor -->
  <!-- Header -->
    @include('partials.header')
  <main class="collapse-section  px-0 px-md-6 pt-18 pt-md-20 mt-2">
    <!-- Main Content -->
    @yield('content')
    @include('partials.footer')
  </main>
    <!-- Footer -->

    <!-- JavaScript Dependencies -->
    <script defer src="{{ asset('assets/js/plugins/plugins.js') }}"></script>
    <script defer src="{{ asset('assets/js/plugins/plugin-custom.js') }}"></script>
    <script defer src="{{ asset('assets/js/main.js') }}"></script>
    @yield('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const copyCouponButtons = document.querySelectorAll('.copy-coupon-btn');

            copyCouponButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const couponCode = this.dataset.couponCode;
                    navigator.clipboard.writeText(couponCode).then(() => {
                        this.querySelector('.show').textContent = 'Copied!';
                        setTimeout(() => {
                            this.querySelector('.show').textContent = 'Copy Coupon';
                        }, 2000);
                    }, () => {
                        alert('Failed to copy coupon code.');
                    });
                });
            });
        });
    </script>
</body>
</html>