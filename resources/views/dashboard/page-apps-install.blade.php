@extends('dashboard.layouts.app')

@section('title', __('Install App'))

@section('header-scripts')
    <style>
        .app-item{
            display: flex;
            flex-wrap: wrap;
        }
        .app-item .icon{
            width: 100px;
            height: 100px;
        }
        .app-item .icon img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .app-item .icon .actions{
            display: block;
            position: relative;
            margin-top: 10px;
        }
        .app-item .icon .actions .install{
            display: block;
            position: relative;
            width: 100%;
            padding: 3px 10px;
            font-size: 12px;
        }
        .app-item .icon .actions .install .preloader{
            width: 14px;
            height: 14px;
        }
        .app-item .icon .actions .installed{
            display: block;
            position: relative;
            width: 100%;
            padding: 3px 10px;
            font-size: 12px;
            cursor: default;
        }
        .app-item .icon .actions .download{
            display: block;
            position: relative;
            width: 100%;
            padding: 3px 10px;
            font-size: 12px;
            color: #1572e8;
        }
        .app-item .app-data{
            padding-top: 10px;
            padding-left: 20px;
            width: calc(100% - 100px);
        }
        .app-item .app-data h6{
            font-size: 18px;
            font-weight: 600;
            margin-block: 0;
        }
        .app-item .app-data span{
            font-size: 14px;
            color: #999;
        }
        .app-item .app-data p{
            font-size: 13px;
            line-height: 18px;
            margin-bottom: 5px;
        }
        .app-item .app-data .author a{
            font-size: 13px;
            font-weight: 500;
        }
    </style>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4" >
        <div>
            <h3 class="fw-bold mb-3">{{ __('App Market') }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Apps List') }}</div>
                </div>
                <div class="card-body">
                    @if($apps->count() > 0)
                        <div class="row">
                            @foreach($apps as $app)
                                @php($appDB = getApp($app->id))
                                <div class="col-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 mt-3 mb-3">
                                    <div class="app-item">
                                        <div class="icon">
                                            <img src="{{  $app->icon }}" alt="{{ $app->name . ' App Icon' }}" width="100" height="100">
                                            <div class="actions">
                                                @if(!$appDB)
                                                    <a href="{{  route('dash.apps.install.app', $app->id) }}" class="btn btn-primary btn-round install no-filter">{{  __('INSTALL') }}</a>
                                                @else
                                                    <a class="btn installed no-filter">{{  __('Installed') }}</a>
                                                @endif
                                            </div>
                                            @if(!$appDB)
                                                <div class="actions">
                                                    <a href="{{  route('dash.apps.install.download', $app->id) }}" class="btn btn-primary btn-border btn-round download no-filter">{{  __('Download') }}</a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="app-data">
                                            <h6>{{ $app->name }}</h6>
                                            <span>{{ __('Version: ') . $app->version }}</span>
                                            <p>{{ $app->description }}</p>
                                            <div class="author">
                                                <a href="{{ $app->author_url }}" title="{{ $app->author }}" target="_blank">{{ $app->author }}</a>
                                            </div>
                                            <div class="price">
                                                <strong>
                                                    @if($app->price != null)
                                                        {{ __('Price: $') . $app->price }}
                                                    @else
                                                        {{ __('Price: Free') }}
                                                    @endif
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="col-12 mt-3 mb-3">
                            <p style="margin-bottom: 0;">{{  __('OOOOPS! Something went wrong. We couldn\'t connect to the store and get the list of apps. Try again.') }}</p>
                        </div>
                    @endif
                </div>
                <div class="card-footer @if($apps->count() > 0) mt-5 @endif">
                    <span style="color: #999;">{{ __('Actual repository Apps List generated at ') . date('F d, Y | H:i:s') }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        jQuery(document).ready(function($){
            let installBtn = $('.install');
            installBtn.on('click', function(){
                let imgSrc = "{{  asset('assets/images/svg/preloader.svg') }}";
                $(this).html('<img class="preloader" src="' + imgSrc + '" alt="preloader" width="14" height="14">');
            });
        });
    </script>
@endsection
