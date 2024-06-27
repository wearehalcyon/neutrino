@extends('dashboard.layouts.app')

@section('title', __('Dashboard'))

@section('header-scripts')
@endsection

@section('content')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4" >
        <div>
            <h3 class="fw-bold mb-3">{{ __('Dashboard') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All important data is here!') }}</h6>
        </div>
    </div>
@endsection

@section('footer-scripts')
@endsection
