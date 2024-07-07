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

                    </div>
                </div>
            </div>
        </footer>
    </div>
    {{ getFooter() }}
</body>
</html>
