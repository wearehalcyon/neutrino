<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>{{ getOption('site_name') . ' | ' }}@yield('title')</title>
        <meta
            content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
            name="viewport"
        />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        {{ getHead() }}
        <link
            rel="icon"
            href="{{ asset('assets/favicon/favicon.ico') }}"
            type="image/x-icon"
        />

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

        @yield('header-scripts')
        <style>
            .sidebar .nav>.nav-item a[data-toggle=collapse][aria-expanded=true]:before, .sidebar .nav>.nav-item.active:hover>a:before, .sidebar .nav>.nav-item.active>a:before, .sidebar[data-background-color=white] .nav>.nav-item a[data-toggle=collapse][aria-expanded=true]:before, .sidebar[data-background-color=white] .nav>.nav-item.active:hover>a:before, .sidebar[data-background-color=white] .nav>.nav-item.active>a:before{
                width: 6px;
            }
            .form-check.form-switch input[type="checkbox"]{
                width: 34px;
                height: 20px;
            }
            a{
                font-size: 15px;
                font-weight: 600;
            }
            a:hover{
                filter: brightness(1.5);
            }
            a.no-filter{
                background-color: rgba(0,0,0,.05);
            }
            a.no-filter:hover{
                filter: brightness(1);
                background-color: rgba(0,0,0,.2);
            }
            a.no-bg{
                background-color: transparent;
            }
            .sidebar .logo-header{
                padding-top: 55px;
            }
            .seo-limiter{
                display: block;
                position: relative;
                margin-top: 5px;
            }
            .seo-limiter .limiter{
                display: block;
                position: relative;
                width: 100%;
                height: 6px;
                background-color: #e8e8e8;
                overflow: hidden;
                border-radius: 100px;
            }
            .seo-limiter .limiter .level{
                display: block;
                position: absolute;
                width: 0%;
                height: 100%;
                top: 0;
                left: 0;
                background-color: #f00;
                transition: all .3s;
                border-radius: 100px;
                z-index: 1;
            }
            .seo-limiter .limiter-desc{
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
            }
            body .wrapper .sidebar .nav.nav-secondary>.nav-item .nav-collapse li.active>a{
                color: #fff !important;
                font-weight: 400;
            }
            @media screen and (max-width: 1200px) {
                .main-header{
                    top: 30px;
                }
                .sidebar .nav{
                    margin-top: 50px;
                }
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar -->
            @include('dashboard.partials.sidebar')
            <!-- End Sidebar -->

            <div class="main-panel">
                <div class="main-header">
                    @include('dashboard.partials.top-header')
                </div>
                <div class="container">
                    <div class="page-inner">
                        @yield('content')
                    </div>
                </div>
                <footer class="footer">
                    @include('dashboard.partials.footer')
                </footer>
            </div>
        </div>
        <!--   Core JS Files   -->
        <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

        <!-- jQuery Scrollbar -->
        <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

        <!-- Chart JS -->
        <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

        <!-- jQuery Sparkline -->
        <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

        <!-- Chart Circle -->
        <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

        <!-- Datatables -->
        <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

        <!-- Bootstrap Notify -->
        <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

        <!-- jQuery Vector Maps -->
        <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>

        <!-- Sweet Alert -->
        <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

        <!-- Kaiadmin JS -->
        <script src="{{ asset('assets/js/kaiadmin.js') }}"></script>

        @yield('footer-scripts')
    </body>
</html>
