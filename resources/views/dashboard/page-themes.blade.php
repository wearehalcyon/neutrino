@extends('dashboard.layouts.app')

@section('title', __('Themes'))

@section('header-scripts')
    <style>
        .file-uploader{
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: auto;
        }
        .screenshot{
            width: 100%;
            height: 300px;
            object-fit: cover;
            object-position: center top;
        }
        .console{
            background-color: #000;
            color: #fff;
            font-weight: 500;
            font-size: 15px;
            line-height: 18px;
        }
        .theme-info-full{
            display: none;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: rgba(0,0,0,.4);
            z-index: 9999;
        }
        .theme-info-full.show{
            display: flex;
        }
        .theme-info-full .window-content{
            display: flex;
            flex-wrap: wrap;
            background-color: #fff;
            border-radius: 10px;
            width: 1200px;
            max-width: 100%;
        }
        .theme-info-full .window-content .column{
            width: 50%;
            display: block;
            position: relative;
        }
        @media screen and (max-width: 992px) {
            .theme-info-full .window-content .column{
                width: 100%;
            }
        }
        .theme-info-full .window-content .column img{
            width: 100%;
            height: auto;
        }
        .close-window-content{
            border: none;
            width: 32px;
            height: 32px;
            display: inline-flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            line-height: 18px;
            background-color: rgba(0,0,0,.05);
            position: absolute;
            top: 0px;
            right: 0px;
            border-radius: 100px;
            font-weight: 100;
            z-index: 10;
        }
        .close-window-content:hover{
            background-color: rgba(0,0,0,.1);
        }
    </style>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->has('theme_file'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('theme_file') }}
        </div>
    @endif
    @if(session('log'))
        <pre class="console p-3">{{ session('log') }}</pre>
    @endif

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4" >
        <div class="w-100">
            <h3 class="fw-bold mb-3">{{ __('Themes') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All site themes is here!') }}</h6>
            <form class="file-uploader" action="{{ route('dash.themes.upload') }}" method="post" enctype="multipart/form-data" style="display: none;">
                <div>
                    @csrf
                    <div class="mb-3">
                        <label for="theme_file" class="form-label">{{ __('Choose Theme ZIP Archive') }}</label>
                        <div class="d-flex">
                            <input class="form-control" type="file" id="theme_file" name="theme_file">
                            <button class="btn btn-secondary" type="submit" style="margin-left: 10px; height: 39px;">{{ __('Install') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title">{{ __('Themes List') }}</div>
                    <a href="javascript:;" class="d-inline-block btn add-theme nav-link no-filter" type="button">{{ __('Upload Theme') }}</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                            $screenshot = resource_path('views/front/' . optional($themeActive)->option_value . '/screenshot.png');
                            $information = resource_path('views/front/' . optional($themeActive)->option_value . '/info.json');
                            if (File::exists($screenshot)) {
                                $imageData = File::get($screenshot);
                                $base64Image = 'data:' . File::mimeType($screenshot) . ';base64,' . base64_encode($imageData);
                            } else {
                                $base64Image = '';
                            }
                            if (File::exists($information)) {
                                (array)$infoData = json_decode(File::get($information));
                            } else {
                                $infoData = [];
                            }
                        @endphp
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-3 mt-2 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    @if($base64Image != "")
                                        <img class="screenshot" src="{{ $base64Image }}" alt="{{ optional($infoData)->name . ' Screenshot Preview' }}">
                                    @else
                                        <img class="screenshot" src="{{ asset('assets/images/no-thumbnail.jpg') }}" alt="{{ optional($infoData)->name . ' Screenshot Preview' }}">
                                    @endif
                                    <h4 class="mt-3">
                                        <strong>
                                            @if(optional($infoData)->name)
                                                {{ optional($infoData)->name }}
                                            @else
                                                {{ optional($themeActive)->option_value }}
                                            @endif
                                        </strong>
                                    </h4>
                                    @if(!is_array($infoData))
                                        <small class="form-text text-muted"><strong>{{ __('Version: ') }}</strong>{{ optional($infoData)->version }}</small>
                                    @else
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" style="box-shadow: none; background-color: #ffe1e3; font-size: 12px; line-height: 16px;">
                                            {{ __('The information file was not found or was corrupted. The current theme may not work stably. Make sure the theme files are present and not damaged.') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <div class="buttons px-1 py-2">
                                        @if(!is_array($infoData))
                                            <a href="javascript:;" class="btn btn-primary no-filter open-full-info-popup" data-theme="{{ $themeActive->option_value }}">{{ __('Information') }}</a>
                                        @endif
                                        <div id="{{ optional($themeActive)->option_value }}" class="theme-info-full">
                                            <div class="card m-4">
                                                <div class="card-body">
                                                    <div class="window-content">
                                                        <div class="column p-2 p-lg-3">
                                                            @if($base64Image != "")
                                                                <img src="{{ $base64Image }}" alt="{{ optional($infoData)->name . ' Screenshot Full Preview' }}">
                                                            @else
                                                                <img src="{{ asset('assets/images/no-thumbnail.jpg') }}" alt="{{ optional($infoData)->name . ' Screenshot Full Preview' }}">
                                                            @endif
                                                        </div>
                                                        <div class="column p-2 p-lg-3" style="border-left: 1px solid rgba(0,0,0,.1);">
                                                            <button type="button" class="close-window-content page-link">✕</button>
                                                            <h2>{{ optional($infoData)->name }}</h2>
                                                            <hr style="opacity: .15;">
                                                            <p style="margin-bottom: 0;"><strong>{{ __('Author: ') }}</strong><a href="{{ optional($infoData)->authorUri }}" target="_blank">{{ optional($infoData)->author }}</a></p>
                                                            <p style="margin-bottom: 0;"><strong>{{ __('Theme URI: ') }}</strong><a href="{{ optional($infoData)->themeUri }}" target="_blank">{{ optional($infoData)->themeUri }}</a></p>
                                                            <p style="margin-bottom: 0;"><strong>{{ __('Version: ') }}</strong>{{ optional($infoData)->version }}</p>
                                                            <p style="margin-bottom: 0;"><strong>{{ __('Description: ') }}</strong>{{ optional($infoData)->description }}</p>
                                                            <p style="margin-bottom: 0;"><strong>{{ __('License: ') }}</strong>{{ optional($infoData)->license }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($themes as $theme)
                            @php
                                $screenshot = resource_path('views/front/' . $theme . '/screenshot.png');
                                $information = resource_path('views/front/' . $theme . '/info.json');
                                if (File::exists($screenshot)) {
                                    $imageData = File::get($screenshot);
                                    $base64Image = 'data:' . File::mimeType($screenshot) . ';base64,' . base64_encode($imageData);
                                } else {
                                    $base64Image = '';
                                }
                                if (File::exists($information)) {
                                    (array)$infoData = json_decode(File::get($information));
                                } else {
                                    $infoData = [];
                                }
                            @endphp
                            @if($theme != optional($themeActive)->option_value)
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-3 mt-2 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            @if($base64Image != "")
                                                <img class="screenshot" src="{{ $base64Image }}" alt="{{ optional($infoData)->name . ' Screenshot Preview' }}">
                                            @else
                                                <img class="screenshot" src="{{ asset('assets/images/no-thumbnail.jpg') }}" alt="{{ optional($infoData)->name . ' Screenshot Preview' }}">
                                            @endif
                                            <h4 class="mt-3">
                                                <strong>
                                                    @if(optional($infoData)->name)
                                                        {{ optional($infoData)->name }}
                                                    @else
                                                        {{ $theme }}
                                                    @endif
                                                </strong>
                                            </h4>
                                            @if(!is_array($infoData))
                                                <small class="form-text text-muted"><strong>{{ __('Version: ') }}</strong>{{ optional($infoData)->version }}</small>
                                            @else
                                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" style="box-shadow: none; background-color: #ffe1e3; font-size: 12px; line-height: 16px;">
                                                    {{ __('The information file was not found or was corrupted. The current theme may not work stably. Make sure the theme files are present and not damaged.') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-footer">
                                            <div class="buttons px-1 py-2">
                                                @if(!is_array($infoData))
                                                    <a href="javascript:;" class="btn btn-primary no-filter open-full-info-popup" data-theme="{{ $theme }}">{{ __('Information') }}</a>
                                                @endif
                                                @if($theme != optional($themeActive)->option_value)
                                                    <form class="d-inline-block w-auto" action="{{ route('dash.themes.activate', $theme) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success no-filter">{{ __('activate') }}</button>
                                                    </form>
                                                    <form class="d-inline-block w-auto" action="{{ route('dash.themes.delete', $theme) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger no-filter delete">{{ __('Delete') }}</button>
                                                    </form>
                                                @endif
                                                <div id="{{ $theme }}" class="theme-info-full">
                                                    <div class="card m-4">
                                                        <div class="card-body">
                                                            <div class="window-content">
                                                                <div class="column p-2 p-lg-3">
                                                                    @if($base64Image != "")
                                                                        <img src="{{ $base64Image }}" alt="{{ optional($infoData)->name . ' Screenshot Full Preview' }}">
                                                                    @else
                                                                        <img src="{{ asset('assets/images/no-thumbnail.jpg') }}" alt="{{ optional($infoData)->name . ' Screenshot Full Preview' }}">
                                                                    @endif
                                                                </div>
                                                                <div class="column p-2 p-lg-3" style="border-left: 1px solid rgba(0,0,0,.1);">
                                                                    <button type="button" class="close-window-content page-link">✕</button>
                                                                    <h2>{{ optional($infoData)->name }}</h2>
                                                                    <hr style="opacity: .15;">
                                                                    <p style="margin-bottom: 0;"><strong>{{ __('Author: ') }}</strong><a href="{{ optional($infoData)->authorUri }}" target="_blank">{{ optional($infoData)->author }}</a></p>
                                                                    <p style="margin-bottom: 0;"><strong>{{ __('Theme URI: ') }}</strong><a href="{{ optional($infoData)->themeUri }}" target="_blank">{{ optional($infoData)->themeUri }}</a></p>
                                                                    <p style="margin-bottom: 0;"><strong>{{ __('Version: ') }}</strong>{{ optional($infoData)->version }}</p>
                                                                    <p style="margin-bottom: 0;"><strong>{{ __('Description: ') }}</strong>{{ optional($infoData)->description }}</p>
                                                                    <p style="margin-bottom: 0;"><strong>{{ __('License: ') }}</strong>{{ optional($infoData)->license }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer p-3 d-flex justify-content-center">
                                                            <form class="d-inline-block w-auto" action="{{ route('dash.themes.activate', $theme) }}" method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success no-filter mx-1">{{ __('activate') }}</button>
                                                            </form>
                                                            <form class="d-inline-block w-auto" action="{{ route('dash.themes.delete', $theme) }}" method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger no-filter delete mx-1">{{ __('Delete') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        jQuery(document).ready(function($){
            let themeBtn = $('.btn.add-theme');
            themeBtn.on('click', function(event){
                event.preventDefault();

                $('.file-uploader').show();
            });
        });
    </script>
    <script>
        let delBtn = $('.delete');
        delBtn.on('click', function(){
            if (confirm('Do you really want to delete this theme?') == true) {
                return true;
            }
            return false;
        });
    </script>
    <script>
        jQuery(document).ready(function($){
            let openPopup = $('.open-full-info-popup'),
                closePopup = $('.close-window-content');
            openPopup.on('click', function(e){
                e.preventDefault();
                let target = $(this).data('theme');
                $('#'+target).addClass('show');
            });
            closePopup.on('click', function(e){
                e.preventDefault();
                $('.theme-info-full').removeClass('show');
            });
        });
    </script>
@endsection
