<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ getOption('site_name') }}</title>
    {{ getHead() }}
    <link rel="preload" as="font" type="font/woff2" href="https://fonts.gstatic.com/s/inter/v13/UcC73FwrK3iLTeHuS_fvQtMwCp50KnMa2JL7SUc.woff2" crossorigin="anonymous">
    <link rel="preload" as="font" type="font/woff2" href="https://fonts.gstatic.com/s/inter/v13/UcC73FwrK3iLTeHuS_fvQtMwCp50KnMa0ZL7SUc.woff2" crossorigin="anonymous">
    <link rel="preload" as="font" type="font/woff2" href="https://fonts.gstatic.com/s/inter/v13/UcC73FwrK3iLTeHuS_fvQtMwCp50KnMa25L7SUc.woff2" crossorigin="anonymous">
    <link rel="preload" as="font" type="font/woff2" href="https://fonts.gstatic.com/s/inter/v13/UcC73FwrK3iLTeHuS_fvQtMwCp50KnMa1ZL7.woff2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ getThemeAssetsUri('/assets/css/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ getThemeAssetsUri('/assets/css/app.css') }}">
</head>
<body>
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
                    456
                </div>
                <div class="col-6 col-md-6 col-lg-3 col-xl-2">
                    <ul class="top-actions">
                        <li><a href="{{ getPermalink('page', 5) }}" title="Get Consultation">Get Consultation</a></li>
                        <li><a href="{{ route('login') }}" title="Account"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
