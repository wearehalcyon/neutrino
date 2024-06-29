@extends('dashboard.layouts.app')

@section('title', __('Media Files'))

@section('header-scripts')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.1.11.2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4" >
        <div>
            <h3 class="fw-bold mb-3">{{ __('Media Files') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All site files is here!') }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('File Manager') }}</div>
                </div>
                <div class="card-body">
                    <div id="fm" style="height: 700px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endsection
