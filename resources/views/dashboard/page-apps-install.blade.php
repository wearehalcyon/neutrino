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
        .app-item .app-data{
            padding-top: 10px;
            padding-left: 20px;
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
                    <div class="row">
                        @foreach($apps as $app)
                            <div class="col-12 col-md-12 col-lg-6 col-xl-4 col-xxl-3 mt-3 mb-3">
                                <div class="app-item">
                                    <div class="icon">
                                        <img src="{{  $app->icon }}" alt="{{ $app->name . ' App Icon' }}" width="100" height="100">
                                    </div>
                                    <div class="app-data">
                                        <h6>{{ $app->name }}</h6>
                                        <span>{{ __('Version: ') . $app->version }}</span>
                                    </div>
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
@endsection
