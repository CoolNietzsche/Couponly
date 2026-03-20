<!doctype html>
<html lang="en">

<head>
    <!-- required meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- #keywords -->
    <meta name="keywords" content="boot, Bootstrap, Couponly - Affiliate & Submitting Discounts Coupons HTML Template">
    <!-- #description -->
    <meta name="description" content="Couponly - Affiliate & Submitting Discounts Coupons HTML Template">
    <!-- #title -->
    <title>Couponly - Affiliate & Submitting Discounts Coupons HTML Template</title>
    <!-- #favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon">
    <!-- ==== css dependencies start ==== -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">

</head>

<body>

    <!-- start preloader -->
    <div id="preloader">
        <div id="loader"></div>
    </div>
    <!-- end preloader -->

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

    <!-- Authentication start-->
    @yield('content')
    <!-- Authentication end -->

    <!-- Footer Area Start -->
    <footer class="footer-section">
        <div class="container">
            <div class="col-lg-5 d-block d-md-none py-6">
                <div class="copyright text-center">
                    <p class="n17-color">Copyright ©<span class="currentYear">2024</span> <a href="index.html" class="s1-color fw-mid">Couponly.</a> All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

    <!-- ==== js dependencies start ==== -->
    <script src="{{ asset('assets/js/plugins/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/plugin-custom.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
