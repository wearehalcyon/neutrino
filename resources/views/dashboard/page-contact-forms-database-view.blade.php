@extends('dashboard.layouts.app')

@section('title', __('View Contact Form Message'))

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

                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-5 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Sender Info') }}</div>
                </div>
                <div class="card-body">
                    123
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
@endsection
