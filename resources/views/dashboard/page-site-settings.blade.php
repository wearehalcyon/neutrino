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
                                            <option disabled selected></option>
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
                                    <label for="blog_index_id"><strong>{{ __('Set Blog Index Page') }}</strong></label>
                                    <select name="blog_index_id" id="blog_index_id" class="form-select form-control">
                                        @if($pages->isNotEmpty())
                                            <option disabled selected></option>
                                            @foreach($pages as $page)
                                                @if($page->id != getOption('homepage_id'))
                                                    <option value="{{ $page->id }}" @if(getOption('blog_index_id') == $page->id) selected @endif>
                                                        {{ $page->name }}
                                                        @if(getOption('blog_index_id') == $page->id)
                                                            ({{ __('Current Blog Index Page') }})
                                                        @endif
                                                    </option>
                                                @endif
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
                                <div class="form-group">
                                    <label for="blog_base"><strong>{{ __('Blog Base') }}</strong></label>
                                    <input type="text" name="blog_base" class="form-control" id="blog_base" placeholder="blog" value="{{ getOption('blog_base') }}">
                                </div>
                                <div class="form-group">
                                    <label for="category_base"><strong>{{ __('Category Base') }}</strong></label>
                                    <input type="text" name="category_base" class="form-control" id="category_base" placeholder="blog/category" value="{{ getOption('category_base') }}">
                                </div>
                                <div class="form-group">
                                    <label for="tag_base"><strong>{{ __('Tag Base') }}</strong></label>
                                    <input type="text" name="tag_base" class="form-control" id="tag_base" placeholder="blog/tag" value="{{ getOption('tag_base') }}">
                                </div>
                                <div class="form-check form-switch">
                                    <label for="debugbar"><strong>{{ __('Enable Debug Bar') }}</strong></label>
                                    <br>
                                    <input id="debugbar" class="form-check-input" type="checkbox" name="debug_bar" style="cursor: pointer;" @if(getOption('debug_bar') == 1) checked @endif>
                                </div>
                                <br>
                                <div class="form-check form-switch">
                                    <label for="extended_editor"><strong>{{ __('Extend Content Editor') }}</strong></label>
                                    <br>
                                    <input id="extended_editor" class="form-check-input" type="checkbox" name="extended_editor" style="cursor: pointer;" @if(getOption('extended_editor') == 1) checked @endif>
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
