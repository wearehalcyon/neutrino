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
            h:a
        }
    </style>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4" >
        <div class="w-100">
            <h3 class="fw-bold mb-3">{{ __('Themes') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All site themes is here!') }}</h6>
            <form class="file-uploader" action="" method="post" enctype="multipart/form-data" style="display: none;">
                <div>
                    @csrf
                    <div class="mb-3">
                        <label for="theme_file" class="form-label">{{ __('Choose Theme ZIP Archive') }}</label>
                        <input class="form-control" type="file" id="theme_file" name="theme_file">
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
                        @foreach($themes as $theme)
                            @php
                                $screenshot = resource_path('views\\front\\' . $theme . '\\screenshot.png');
                                if (File::exists($screenshot)) {
                                    $imageData = File::get($screenshot);
                                    $base64Image = 'data:' . File::mimeType($screenshot) . ';base64,' . base64_encode($screenshot);
                                } else {
                                    $base64Image = '';
                                }
                            @endphp
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 col-xxl-2 mt-3">
                                <div class="card">
                                    <img src="{{ $base64Image }}" alt="">
                                </div>
                            </div>
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
@endsection
