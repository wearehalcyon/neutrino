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
                                    <input type="text" name="site_name" class="form-control" id="sitename" placeholder="My Site Name" value="{{ getOption('sitename') }}">
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
                                    <input type="number" name="posts_per_page" class="form-control" id="postsperpage" min="1" max="999" value="{{ getOption('posts_per_page') }}">
                                </div>
                                <div class="form-check form-switch">
                                    <label for="debugbar"><strong>{{ __('Enable Debug Bar') }}</strong></label>
                                    <br>
                                    <input id="debugbar" class="form-check-input" type="checkbox" name="debug_bar" style="cursor: pointer;" @if(getOption('debug_bar') == 1) checked @endif>
                                </div>
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
