@extends('dashboard.layouts.app')

@section('title', __('View Contact Form Message'))

@section('header-scripts')
    <style>
        .message-list{
            display: block;
            position: relative;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .message-list li{
            display: block;
            margin: 10px 0;
            font-size: 16px;
            border-bottom: 1px solid rgba(0,0,0,.1);
            padding: 10px;
        }
        .message-list li .input-name{
            display: block;
            font-weight: 700;
            text-transform: uppercase;
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
        <div>
            <h3 class="fw-bold mb-3">{{ __('View Contact Form Message') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-7 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Message Data') }}</div>
                </div>
                <div class="card-body">
                    <ul class="message-list">
                        @foreach($formData as $key => $value)
                            <li>
                                <strong class="input-name">{{ $key }}: </strong>
                                {{ $value }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-5 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Sender Info') }}</div>
                </div>
                <div class="card-body">
                    <ul class="message-list in-sidebar">
                        @foreach($formData as $key => $value)
                            @if(\Illuminate\Support\Str::contains($value, '@') && \Illuminate\Support\Str::contains($value, '.'))
                                <li>
                                    <strong class="input-name">{{ __('Email') }}</strong>
                                    <a href="mailt:{{ $value }}" title="{{ $value }}">{{ $value }}</a>
                                </li>
                            @endif
                        @endforeach
                        <li>
                            <strong class="input-name">{{ __('IP Address') }}</strong>
                            <a href="https://ipaddres.com/ip/{{ $message->user_ip }}" title="{{ __('Get IP Information') }}" target="_blank">{{ $message->user_ip }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
@endsection
