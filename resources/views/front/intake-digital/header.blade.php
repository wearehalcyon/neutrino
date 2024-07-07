<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en">
    @if(getMetaData('page', $homepage->id, 'seo_title'))
        <title>{{ getMetaData('page', $homepage->id, 'seo_title') }}</title>
    @else
        <title>{{ getOption('site_name') }}</title>
    @endif
    @if(getMetaData('page', $homepage->id, 'meta_description'))
        <meta name="description" content="{{ getMetaData('page', $homepage->id, 'meta_description') }}">
    @else
        <meta name="description" content="{{ getOption('site_description') }}">
    @endif
    <meta name="theme-color" content="#000000">
    <meta name="viewport-fit" content="cover">
    @if(getMetaData('page', $homepage->id, 'seo_slug'))
        <link rel="canonical" href="{{ url(getMetaData('page', $homepage->id, 'seo_slug')) }}">
    @endif
    <link rel="stylesheet" href="{{ getThemeAssetsUri('/assets/css/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ getThemeAssetsUri('/assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ getThemeAssetsUri('/assets/css/plugins/swiper-bundle.min.css') }}">
    <link rel="preload" as="font" type="font/woff2" href="https://fonts.gstatic.com/s/inter/v13/UcC73FwrK3iLTeHuS_fvQtMwCp50KnMa2JL7SUc.woff2" crossorigin="anonymous">
    <link rel="preload" as="font" type="font/woff2" href="https://fonts.gstatic.com/s/inter/v13/UcC73FwrK3iLTeHuS_fvQtMwCp50KnMa0ZL7SUc.woff2" crossorigin="anonymous">
    <link rel="preload" as="font" type="font/woff2" href="https://fonts.gstatic.com/s/inter/v13/UcC73FwrK3iLTeHuS_fvQtMwCp50KnMa25L7SUc.woff2" crossorigin="anonymous">
    <link rel="preload" as="font" type="font/woff2" href="https://fonts.gstatic.com/s/inter/v13/UcC73FwrK3iLTeHuS_fvQtMwCp50KnMa1ZL7.woff2" crossorigin="anonymous">

    {{ getHead() }}
</head>
<body class="{{ getBodyClass('custom-body-theme-class') }}">
<div id="app">
    <header class="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-6 col-md-6 col-lg-3 col-xl-2">
                    <div class="logo">
                        <a href="{{ url('/') }}" title="{{ getOption('site_name') }}">
                            <img src="{{ asset('uploads/' . getOption('site_logo')) }}" alt="{{ getOption('site_name') . ' Logo' }}" width="24" height="24">
                        </a>
                    </div>
                </div>
                <div class="d-none d-xl-block col-6 col-md-6 col-lg-6 col-xl-8">
                    {!! getMenu('Main Menu', 'main-nav', 'main-nav', false) !!}
                </div>
                <div class="d-none d-xl-flex col-6 col-md-6 col-lg-3 col-xl-2 justify-content-end">
                    <ul class="top-actions">
                        <li class="cta">
                            <a href="{{ getPermalink('page', 5) }}" title="Get Consultation">Get Consultation</a>
                        </li>
                        <li class="account">
                            <a href="{{ route('login') }}" title="Account">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M15.9266 15.2484C14.6882 13.0209 12.7439 11.4579 10.4848 10.795C11.5831 10.2139 12.4614 9.26468 12.9781 8.10043C13.4947 6.93618 13.6196 5.62475 13.3325 4.3776C13.0454 3.13046 12.3632 2.02029 11.3958 1.2261C10.4283 0.431916 9.23212 0 8 0C6.76788 0 5.57166 0.431916 4.60424 1.2261C3.63682 2.02029 2.95457 3.13046 2.6675 4.3776C2.38044 5.62475 2.50529 6.93618 3.02193 8.10043C3.53857 9.26468 4.41688 10.2139 5.51524 10.795C3.25608 11.4571 1.31182 13.0201 0.0733604 15.2484C0.0393537 15.304 0.0165195 15.3663 0.00623148 15.4314C-0.00405651 15.4965 -0.00158558 15.5631 0.0134954 15.6272C0.0285763 15.6913 0.0559557 15.7515 0.0939865 15.8043C0.132017 15.8571 0.179914 15.9013 0.234794 15.9343C0.289674 15.9674 0.350404 15.9885 0.413331 15.9964C0.476257 16.0044 0.54008 15.999 0.600959 15.9806C0.661837 15.9622 0.718515 15.9312 0.767581 15.8895C0.816647 15.8477 0.857087 15.796 0.886469 15.7376C2.39127 13.0315 5.04993 11.4163 8 11.4163C10.9501 11.4163 13.6087 13.0315 15.1135 15.7376C15.1429 15.796 15.1834 15.8477 15.2324 15.8895C15.2815 15.9312 15.3382 15.9622 15.399 15.9806C15.4599 15.999 15.5237 16.0044 15.5867 15.9964C15.6496 15.9885 15.7103 15.9674 15.7652 15.9343C15.8201 15.9013 15.868 15.8571 15.906 15.8043C15.944 15.7515 15.9714 15.6913 15.9865 15.6272C16.0016 15.5631 16.0041 15.4965 15.9938 15.4314C15.9835 15.3663 15.9606 15.304 15.9266 15.2484ZM3.45662 5.70899C3.45662 4.7737 3.72308 3.85942 4.22231 3.08175C4.72155 2.30408 5.43113 1.69797 6.26132 1.34005C7.09152 0.982127 8.00504 0.888479 8.88637 1.07094C9.7677 1.25341 10.5773 1.7038 11.2127 2.36515C11.8481 3.0265 12.2808 3.86911 12.4561 4.78643C12.6314 5.70375 12.5414 6.65458 12.1975 7.51867C11.8537 8.38277 11.2713 9.12132 10.5242 9.64094C9.77701 10.1606 8.8986 10.4379 8 10.4379C6.79546 10.4364 5.64068 9.93769 4.78895 9.05117C3.93721 8.16466 3.45807 6.96272 3.45662 5.70899Z" fill="white"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
