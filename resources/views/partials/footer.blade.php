<div class="collapse-section body-collapse d-grid">
    <!-- Footer Area Start -->
    <footer class="footer-section pt-12 pt-md-20">
        <div class="n1-bg-color">
            <div class="container-fluid">
                <div class="row py-4 py-md-5 gy-5 gy-xl-0 px-0 px-md-4 align-items-center justify-content-between">

                    {{-- Copyright --}}
                    <div class="col-lg-7 col-md-6 order-1 order-md-0">
                        <div class="copyright text-center text-lg-start">
                            <p>
                                Copyright © {{ now()->year }}
                                <a href="{{ route('home') }}" class="p1-color">{{ config('app.name', 'Couponly') }}.</a>
                                All rights reserved.
                            </p>
                        </div>
                    </div>

                    {{-- Social Icons --}}
                    <div class="col-lg-5 col-md-6">
                        <div class="d-flex flex-wrap gap-3 gap-md-5 align-items-center justify-content-center justify-content-xl-end">
                            <ul class="social-area d-center justify-content-end gap-2 gap-md-3">
                                <li>
                                    <a href="https://www.facebook.com/" target="_blank" class="d-center rounded-circle cus-border border b-eleventh">
                                        <span class="d-center p1-color fs-five">
                                            <i class="ph ph-facebook-logo"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/" target="_blank" class="d-center rounded-circle cus-border border b-eleventh">
                                        <span class="d-center p1-color fs-five">
                                            <i class="ph ph-twitter-logo"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.pinterest.com/" target="_blank" class="d-center rounded-circle cus-border border b-eleventh">
                                        <span class="d-center p1-color fs-five">
                                            <i class="ph ph-pinterest-logo"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.twitch.com/" target="_blank" class="d-center rounded-circle cus-border border b-eleventh">
                                        <span class="d-center p1-color fs-five">
                                            <i class="ph ph-twitch-logo"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/" target="_blank" class="d-center rounded-circle cus-border border b-eleventh">
                                        <span class="d-center p1-color fs-five">
                                            <i class="ph ph-linkedin-logo"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{-- End Social --}}
                    
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->
</div>
