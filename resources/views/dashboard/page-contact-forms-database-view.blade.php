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
                        @php($location = getGeoIp($message->user_ip))
                        @if($location)
                            <li>
                                <strong class="input-name">{{ __('IP Address') }}</strong>
                                <a href="https://ipaddres.com/ip/{{ $message->user_ip }}" title="{{ __('Get IP Information') }}" target="_blank">{{ $message->user_ip }} <i class="fas fa-external-link-alt"></i></a>
                                <br>
                                @php($countryCode = $location['countryCode'])
                                @foreach($location as $key => $value)
                                    @if($key == 'countryName')
                                        <p style="margin: 5px 0;"><strong>{{ __('Country: ') }}</strong>{{ __($value) . ' (' . $countryCode . ')' }}</p>
                                    @endif
                                    @if($key == 'regionName')
                                        <p style="margin: 5px 0;"><strong>{{ __('Region: ') }}</strong>{{ __($value) }}</p>
                                    @endif
                                    @if($key == 'cityName')
                                        <p style="margin: 5px 0;"><strong>{{ __('City: ') }}</strong>{{ __($value) }}</p>
                                    @endif
                                    @if($key == 'timezone')
                                        <p style="margin: 5px 0;"><strong>{{ __('Time Zone: ') }}</strong>{{ __($value) }}</p>
                                    @endif
                                @endforeach
                            </li>
                        @endif
                        <li>
                            <strong class="input-name">{{ __('User Agent') }}</strong>
                            <p style="margin: 5px 0;"><strong>{{ __('Screen: ') }}</strong>@if(isMobile($message->user_agent)){{ __('Mobile') }}@else{{ __('Desktop') }}@endif</p>
                            <p style="margin: 5px 0;"><strong>{{ __('Device: ') }}</strong>{{ getUserAgent($message->user_agent, 'device') }}</p>
                            <p style="margin: 5px 0;"><strong>{{ __('Platform: ') }}</strong>{{ getUserAgent($message->user_agent, 'platform') }}</p>
                            <p style="margin: 5px 0;"><strong>{{ __('Browser: ') }}</strong>{{ getUserAgent($message->user_agent, 'browser') }}</p>
                        </li>
                    </ul>
                    <a href="{{ route('dash.c-forms-db.delete', [$message->id, $message->form_unique_id]) }}" class="btn btn-danger mt-2 delete">{{ __('Delete') }}</a>
                    <a href="{{ route('dash.c-forms-db.mark-unread', [$message->id, $message->form_unique_id]) }}" class="btn btn-primary mt-2">{{ __('Mark Unread') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        let delBtn = $('.delete');
        delBtn.on('click', function(){
            if (confirm('Do you really want to delete this message?') == true) {
                return true;
            }
            return false;
        });
    </script>
@endsection
