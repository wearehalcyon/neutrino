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
            display: flex;
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
        .theme-info-full .window-content{
            display: none;
            flex-wrap: wrap;
            background-color: #fff;
            border-radius: 10px;
        }
        .theme-info-full .window-content.show{
            display: flex;
        }
        .theme-info-full .window-content .column{
            width: 50%;
            display: block;
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
                            $screenshot = resource_path('views\\front\\' . $themeActive->option_value . '\\screenshot.png');
                            $information = resource_path('views\\front\\' . $themeActive->option_value . '\\info.json');
                            if (File::exists($screenshot)) {
                                $imageData = File::get($screenshot);
                                $base64Image = 'data:' . File::mimeType($screenshot) . ';base64,' . base64_encode($imageData);
                            } else {
                                $base64Image = '';
                            }
                            if (File::exists($information)) {
                                (array)$infoData = json_decode(File::get($information));
                            } else {
                                $infoData = '';
                            }
                        @endphp
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-3 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <img class="screenshot" src="{{ $base64Image }}" alt="{{ $infoData->name . ' Screenshot Preview' }}">
                                    <h4 class="mt-3"><strong>{{ $infoData->name }}</strong></h4>
                                    <small class="form-text text-muted"><strong>{{ __('Version: ') }}</strong>{{ $infoData->version }}</small>
                                </div>
                                <div class="card-footer">
                                    <div class="buttons px-1 py-2">
                                        <a href="javascript:;" class="btn btn-primary no-filter">{{ __('Information') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($themes as $theme)
                            @php
                                $screenshot = resource_path('views\\front\\' . $theme . '\\screenshot.png');
                                $information = resource_path('views\\front\\' . $theme . '\\info.json');
                                if (File::exists($screenshot)) {
                                    $imageData = File::get($screenshot);
                                    $base64Image = 'data:' . File::mimeType($screenshot) . ';base64,' . base64_encode($imageData);
                                } else {
                                    $base64Image = '';
                                }
                                if (File::exists($information)) {
                                    (array)$infoData = json_decode(File::get($information));
                                } else {
                                    $infoData = '';
                                }
                            @endphp
                            @if($theme != $themeActive->option_value)
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-3 mt-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <img class="screenshot" src="{{ $base64Image }}" alt="{{ $infoData->name . ' Screenshot Preview' }}">
                                            <h4 class="mt-3"><strong>{{ $infoData->name }}</strong></h4>
                                            <small class="form-text text-muted"><strong>{{ __('Version: ') }}</strong>{{ $infoData->version }}</small>
                                        </div>
                                        <div class="card-footer">
                                            <div class="buttons px-1 py-2">
                                                <a href="javascript:;" class="btn btn-primary no-filter" data-theme="{{ $theme }}">{{ __('Information') }}</a>
                                                @if($theme != $themeActive->option_value)
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
                                                                    <img src="{{ $base64Image }}" alt="">
                                                                </div>
                                                                <div class="column p-2 p-lg-3" style="border-left: 1px solid rgba(0,0,0,.1);">
                                                                    <h2>{{ $infoData->name }}</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="d-flex justify-content-center buttons px-1 py-2">
                                                                @if($theme != $themeActive->option_value)
                                                                    <form class="d-inline-block w-auto" action="{{ route('dash.themes.activate', $theme) }}" method="post">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-success no-filter mx-1">{{ __('activate') }}</button>
                                                                    </form>
                                                                    <form class="d-inline-block w-auto" action="{{ route('dash.themes.delete', $theme) }}" method="post">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-danger no-filter delete mx-1">{{ __('Delete') }}</button>
                                                                    </form>
                                                                @endif
                                                            </div>
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
@endsection
