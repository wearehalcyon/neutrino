<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ getOption('site_name') }}</title>
    <link rel="stylesheet" href="{{ getThemeAssetsUri('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ getThemeAssetsUri('/css/style.css') }}">
    {{ getHead() }}
</head>
<body class="{{ getBodyClass('moon-base-theme') }}">
<main class="main">
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}" title="{{ getOption('site_name') }}">{{ getOption('site_name') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        {!! getMenu('Main Menu', '', 'navbar-nav', false) !!}
                    </ul>
                </div>
            </div>
        </nav>
    </header>
