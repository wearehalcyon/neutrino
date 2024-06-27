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
                <form action="#" method="post">
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
