@extends('dashboard.layouts.app')

@section('title', __('Site Settings'))

@section('header-scripts')
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4" >
        <div>
            <h3 class="fw-bold mb-3">{{ __('Site Settings') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All site settings is here!') }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('dash.site-settings.update') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <div class="card-title">{{ __('Site Data') }}</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="sitename"><strong>{{ __('Site Name') }}</strong></label>
                                    <input type="text" name="site_name" class="form-control" id="sitename" placeholder="My Site Name" value="{{ getOption('site_name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="siteurl"><strong>{{ __('Site URL') }}</strong></label>
                                    <input type="text" name="site_url" class="form-control" id="siteurl" placeholder="https://example.com" value="{{ getOption('site_url') }}">
                                    <small id="siteurl" class="form-text text-muted">{{ __('Please set this value without slash in end.') }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="sitedesc"><strong>{{ __('Site Description') }}</strong></label>
                                    <textarea class="form-control" name="site_description" id="" cols="30" rows="6" placeholder="{{ __('This is my site and this is my short description for SEO settings...') }}">{{ getOption('site_description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="postsperpage"><strong>{{ __('Posts Per Page (Blog)') }}</strong></label>
                                    <input type="number" name="posts_per_page" class="form-control w-auto" id="postsperpage" min="1" max="999" value="{{ getOption('posts_per_page') }}">
                                </div>
                                <div class="form-group">
                                    <label for="homepage_id"><strong>{{ __('Set Homepage') }}</strong></label>
                                    <select name="homepage_id" id="homepage_id" class="form-select form-control">
                                        @if($pages->isNotEmpty())
                                            @foreach($pages as $page)
                                                <option value="{{ $page->id }}" @if(getOption('homepage_id') == $page->id) selected @endif>
                                                    {{ $page->name }}
                                                    @if(getOption('homepage_id') == $page->id)
                                                        ({{ __('Current Homepage') }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        @else
                                            <option disabled>{{ __('No any page created yet') }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="front_theme"><strong>{{ __('Set Front Theme') }}</strong></label>
                                    <select name="front_theme" id="front_theme" class="form-select form-control">
                                        @if($themes)
                                            @foreach($themes as $theme)
                                                <option value="{{ $theme }}" @if(getOption('front_theme') == $theme) selected @endif>
                                                    {{ ucwords(str_replace('-', ' ', $theme)) }}
                                                    @if(getOption('front_theme') == $theme)
                                                        ({{ __('Current Theme') }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        @else
                                            <option disabled selected>{{ __('There is no any theme installed') }}</option>
                                        @endif
                                    </select>
                                </div>
{{--                                <div class="form-check form-switch">--}}
{{--                                    <label for="debugbar"><strong>{{ __('Enable Debug Bar') }}</strong></label>--}}
{{--                                    <br>--}}
{{--                                    <input id="debugbar" class="form-check-input" type="checkbox" name="debug_bar" style="cursor: pointer;" @if(getOption('debug_bar') == 1) checked @endif>--}}
{{--                                </div>--}}
{{--                                <div class="form-group mt-4">--}}
{{--                                    <label for="mailer_type"><strong>{{ __('Mailer Type') }}</strong></label>--}}
{{--                                    <select name="mailer_type" id="mailer_type" class="form-select form-control">--}}
{{--                                        <option value="smtp" @if(getOption('mailer_type') == 'smtp'){{ 'selected' }}@endif>SMTP</option>--}}
{{--                                        <option value="sendmail" disabled @if(getOption('mailer_type') == 'sendmail'){{ 'selected' }}@endif>SENDMAIL</option>--}}
{{--                                        <option value="mta" disabled @if(getOption('mailer_type') == 'mta'){{ 'selected' }}@endif>MTA</option>--}}
{{--                                        <option value="mda" disabled @if(getOption('mailer_type') == 'mda'){{ 'selected' }}@endif>MDA</option>--}}
{{--                                        <option value="lmtp" disabled @if(getOption('mailer_type') == 'lmtp'){{ 'selected' }}@endif>LMTP</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="mailer_host"><strong>{{ __('Mailer Host') }}</strong></label>--}}
{{--                                    <input type="text" name="mailer_host" class="form-control" id="mailer_host" placeholder="mail.example.com" value="{{ getOption('mailer_host') }}">--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="mailer_port"><strong>{{ __('Mailer Port') }}</strong></label>--}}
{{--                                    <input type="text" name="mailer_port" class="form-control" id="mailer_port" placeholder="2525" value="{{ getOption('mailer_port') }}">--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="mailer_username"><strong>{{ __('Mailer Username') }}</strong></label>--}}
{{--                                    <input type="text" name="mailer_username" class="form-control" id="mailer_username" placeholder="mailer@example.com" value="{{ getOption('mailer_username') }}">--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="mailer_password"><strong>{{ __('Mailer Password') }}</strong></label>--}}
{{--                                    <input type="password" name="mailer_password" class="form-control" id="mailer_password" value="{{ getOption('mailer_password') }}">--}}
{{--                                </div>--}}
{{--                                <div class="form-check form-switch">--}}
{{--                                    <label for="mailer_encryption"><strong>{{ __('Mailer Encryption') }}</strong></label>--}}
{{--                                    <br>--}}
{{--                                    <input id="mailer_encryption" class="form-check-input" type="checkbox" name="mailer_encryption" style="cursor: pointer;" @if(getOption('mailer_encryption') == 1) checked @endif>--}}
{{--                                </div>--}}
{{--                                <div class="form-group mt-4">--}}
{{--                                    <label for="mailer_sender_address"><strong>{{ __('Mailer Sender Email') }}</strong></label>--}}
{{--                                    <input type="email" name="mailer_sender_address" class="form-control" id="mailer_sender_address" placeholder="noreply@example.com" value="{{ getOption('mailer_sender_address') }}">--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="mailer_title"><strong>{{ __('Mailer Message Title') }}</strong></label>--}}
{{--                                    <input type="text" name="mailer_title" class="form-control" id="mailer_title" placeholder="This is author of email..." value="{{ getOption('mailer_title') }}">--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">{{ __('Update Settings') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
@endsection
