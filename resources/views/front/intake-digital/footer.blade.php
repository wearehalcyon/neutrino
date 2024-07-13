        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 col-xl-9">
                        <div class="footer-nav">
                            {!! getMenu('Footer Main Menu', null, 'first-nav', false) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 col-xl-3">
                        <ul class="social-links">
                            <li>
                                <a href="https://facebook.com/intakedigital/" title="Facebook" target="_blank">
                                    <img src="{{ getThemeAssetsUri('/assets/images/svg/facebook.svg') }}" alt="Facebook Icon" width="20" height="20">
                                </a>
                            </li>
                            <li>
                                <a href="https://x.com/IntakeDigital/" title="X (Twitter)" target="_blank">
                                    <img src="{{ getThemeAssetsUri('/assets/images/svg/x.svg') }}" alt="X (Twitter) Icon" width="20" height="20">
                                </a>
                            </li>
                            <li>
                                <a href="https://instagram.com/intakedigital/" title="Instagram" target="_blank">
                                    <img src="{{ getThemeAssetsUri('/assets/images/svg/instagram.svg') }}" alt="Instagram Icon" width="20" height="20">
                                </a>
                            </li>
                            <li>
                                <a href="https://youtube.com/channel/UCoMFPXO3JFldBNxOuyXBmGw/" title="YouTube" target="_blank">
                                    <img src="{{ getThemeAssetsUri('/assets/images/svg/youtube.svg') }}" alt="YouTube Icon" width="20" height="20">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 col-xl-9">
                        <div class="footer-nav">
                            {!! getMenu('Footer Legal Menu', null, 'second-nav', false) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 col-xl-3">
                        <div class="copy">Copyright by {{ getOption('site_name') }} © {{ date('Y') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 col-xl-9">
                        <div class="footer-logo">
                            <a href="{{ url('/') }}" title="{{ getOption('site_name') }}">
                                <img src="{{ asset('uploads/' . getOption('header_image')) }}" alt="{{ getOption('site_name') . ' Footer Logo' }}" width="128" height="24">
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 col-xl-3">
                        <div class="powered">Powered by <a href="{{ getPermalink('page', 13) }}" title="Get ID Engine CMS">ID Engine</a>.</div>
                    </div>
                </div>
            </div>
        </footer>
        @if(session('cf-success'))
            <div class="success-popup d-flex align-items-center justify-content-center">
                <div class="popup-window">
                    <h2>Thank You!</h2>
                    <p>Your message was sent! We will contact you very soon. Be patient please :)</p>
                    <a href="javascript:;" class="close-popup">OK</a>
                </div>
            </div>
        @endif
        @if(session('cf-error'))
            <div class="success-popup d-flex align-items-center justify-content-center">
                <div class="popup-window">
                    <h2>OOOPS!</h2>
                    <p>Something went wrong and message was not sent. Please try again later.</p>
                    <a href="javascript:;" class="close-popup">OK</a>
                </div>
            </div>
        @endif
    </div>
    {{ getFooter() }}
    <script src="{{ getThemeAssetsUri('/assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ getThemeAssetsUri('/assets/js/app.js') }}"></script>
</body>
</html>
