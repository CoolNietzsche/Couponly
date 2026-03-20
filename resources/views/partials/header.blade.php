<header class="header-section n1-bg-color collapse-header transition">
    <div class="overlay">
        <div class="container-fluid px-4">
            <div class="row me-0 py-2 py-md-4 d-flex justify-content-between header-area">
                <div class="col-2 col-sm-6 col-xxl-5 px-0 mx-5 d-center justify-content-start gap-3 gap-md-4">
                    <button class="sidebar-icon">
                        <span class="d-center fs-four">
                            <i class="ph ph-list"></i>
                        </span>
                    </button>
                    <div
                        class="input-area w-100 rounded-pill ps-2 ps-md-6 p-2 transition p1-2nd-bg-color cus-border border b-eighth d-none d-sm-block">
                        <form action="{{ route('search') }}" method="GET" class="d-center justify-content-between">
                            @csrf
                            <select name="category" class="select-two">
                                <option value="">Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="v-line px-4 px-md-6 position-relative d-center"></span>
                            <div class="d-center w-100 justify-content-between">
                                <div class="input-single w-100">
                                    <input type="text" name="query" placeholder="Search here..."
                                        class="pe-3 pe-md-4 w-100">
                                </div>
                                <button
                                    class="box-style box-second second-alt rounded-pill py-2 py-md-2 px-5 px-md-7 d-center">
                                    <span class="d-center fs-seven d-none d-lg-flex">Search</span>
                                    <span class="d-center fs-seven d-flex d-lg-none">
                                        <i class="ph ph-magnifying-glass"></i>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div
                        class="input-area w-100 n1-bg-color rounded-pill p-2 transition cus-border border d-noned-sm-block d-none">
                        <form action="{{ route('search') }}" method="GET" class="row">
                            @csrf
                            <div class="col-sm-12 d-center justify-content-between">
                                <div class="input-single w-100">
                                    <input type="text" name="query" placeholder="Search hare..."
                                        class="px-3 px-md-4 w-100">
                                </div>
                                <button class="box-style box-third rounded-circle">
                                    <span class="d-center fs-seven">
                                        <i class="ph ph-magnifying-glass"></i>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-6 col-sm-3 col-xxl-4 px-0 mx-4 d-center justify-content-end gap-3 gap-md-4">
                    <div class="right-area d-flex gap-4">
                        @guest
                        <a href="{{ route('login') }}" class="d-center d-none d-md-flex">
                            <span class="fs-six text-nowrap">Sign in</span>
                        </a>
                        <a href="{{ route('register') }}"
                            class="box-style box-second gap-2 gap-md-3 rounded-pill py-2 py-md-3 px-5 px-md-7 d-center">
                            <span class="fs-six text-nowrap">Sign up</span>
                            <span class="d-center fs-five">
                                <i class="ph ph-arrow-right"></i>
                            </span>
                        </a>
                        @else
                      
                        <a href="{{ route('profile') }}"
                            class="d-center box-style box-third third-alt cus-border border rounded-circle">
                            <span class="d-center fs-four">
                                <i class="ph ph-user-circle"></i>
                            </span>
                        </a>
                        {{-- <a href="{{ route('profile') }}" class="d-center d-none d-md-flex">
                            <span class="fs-six text-nowrap">Profile</span>
                        </a> --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="box-style box-second gap-2 gap-md-3 rounded-pill py-2 py-md-3 px-5 px-md-7 d-center">
                                <span class="fs-six text-nowrap">Logout</span>
                            </button>
                        </form>
                        @endguest
                        {{-- <button class="d-center box-style box-third third-alt cus-border border rounded-circle"
                            data-bs-toggle="modal" data-bs-target="#submitCoupon">
                            <span class="d-center fs-four">
                                <i class="ph ph-tag"></i>
                            </span>
                        </button>
                        <div class="position-relative">
                            <button class="d-center box-style box-third third-alt cus-border border rounded-circle">
                                <span class="d-center fs-four">
                                    <i class="ph ph-heart-straight"></i>
                                </span>
                            </button>
                            <span
                                class="position-absolute d-center icon-area box-five top-0 end-0 fw-bold fs-eight rounded-circle p1-bg-color n1-color">2</span>
                        </div>
                        <button class="d-center box-style box-third third-alt cus-border border rounded-circle">
                            <span class="d-center fs-four">
                                <i class="ph ph-user-circle"></i>
                            </span>
                        </button> --}}
                    </div>
                </div>
                <div
                    class="sidebar-wrapper p-5 p-md-8 box-shadow-p2 position-absolute top-0 n1-bg-color transition main-navbar">
                    <button class="close-btn d-block d-xl-none position-absolute end-0 top-0">
                        <span class="d-center s1-color fs-four m-4">
                            <i class="fa-solid fa-xmark"></i>
                        </span>
                    </button>
                    <div class="sidebar-logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"></a>
                    </div>
                    <span class="d-flex my-4 my-md-6 dashed-border"></span>
                    <H6 class="fs-seven n17-color mb-2">Navigation</H6>
                    <ul class="custom-nav fourth d-flex flex-column justify-content-start gap-1 pe-2">
                        <li class="menu-item position-relative">
                            <button onclick="window.location.href='{{ url('/') }}'"
                                class="d-center justify-content-start gap-1 gap-md-2 py-2 py-md-3 px-4 px-md-6 rounded-4 position-relative w-100 {{ request()->is('/') ? 'active' : '' }}">
                                <span class="d-center d-inline-flex fs-four">
                                    <i class="ph ph-house"></i>
                                </span>
                                <span>Home</span>
                            </button>

                        </li>
                        <li class="menu-item position-relative">
                            <button onclick="window.location.href='{{ url('/coupons') }}'"
                                class="d-center justify-content-start gap-1 gap-md-2 py-2 py-md-3 px-4 px-md-6 rounded-4 position-relative w-100 {{ request()->is('coupons') ? 'active' : '' }}">
                                <span class="d-center d-inline-flex fs-four">
                                    <i class="ph ph-tag"></i>
                                </span>
                                <span>Browse Coupons</span>
                            </button>
                        </li>

                        <li class="menu-item position-relative">
                            <button onclick="window.location.href='{{ url('/stores') }}'"
                                class="d-center justify-content-start gap-1 gap-md-2 py-2 py-md-3 px-4 px-md-6 rounded-4 position-relative w-100 {{ request()->is('stores') ? 'active' : '' }}">
                                <span class="d-center d-inline-flex fs-four">
                                    <i class="ph ph-folder"></i>
                                </span>
                                <span>Stores</span>
                            </button>
                        </li>


                        <li class="menu-item position-relative">
                            <button onclick="window.location.href='{{ url('/categories') }}'"
                                class="d-center justify-content-start gap-1 gap-md-2 py-2 py-md-3 px-4 px-md-6 rounded-4 position-relative w-100 {{ request()->is('categories') ? 'active' : '' }}">
                                <span class="d-center d-inline-flex fs-four">
                                    <i class="ph ph-squares-four"></i>
                                </span>
                                <span>Categories</span>
                            </button>
                        </li>



                    </ul>
                    <div class="pt-12 pt-md-20">
                        <div class="browse-coupons text-center d-grid gap-4 gap-md-6">
                            <div class="img-area">
                                <img src="{{ asset('assets/images/browse-coupons.png') }}" alt="Image">
                            </div>
                            <p>Save up to 20%+ on all Coupons and Browse Coupons</p>
                            <div class="btn-area">
                                <a href="{{ route('coupons.index') }}"
                                    class="box-style box-second gap-2 gap-md-3 w-100 rounded-pill py-2 py-md-3 px-5 px-md-7 d-center d-inline-flex">
                                    <span class="fs-six text-nowrap">Browse Coupons</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>