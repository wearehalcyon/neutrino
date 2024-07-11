@extends('dashboard.layouts.app')

@section('title', __('Contact Forms Database'))

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
            <h3 class="fw-bold mb-3">{{ __('Contact Forms Database') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All site contact forms messages is here!') }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Forms List') }}</div>
                </div>
                <div class="card-body">
                    @if($messages->isNotEmpty())
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 100px;">ID</th>
                                <th scope="col">{{ __('Form Name') }}</th>
                                <th scope="col">{{ __('Unique ID') }}</th>
                                <th scope="col">{{ __('IP') }}</th>
                                <th scope="col">{{ __('User Agent') }}</th>
                                <th scope="col">{{ __('Received') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                    <tr>
                                        <td>{{ $message->id }}</td>
                                        <td><a href="{{ route('dash.c-forms-db.view', [$message->id, $message->form_unique_id]) }}" title="{{ $message->form_name }}">{{ $message->form_name }}</a></td>
                                        <td>{{ $message->form_unique_id }}</td>
                                        <td>
                                            @if($message->user_ip)
                                                {{ $message->user_ip }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>
                                            @if($message->user_agent)
                                                {{ $message->user_agent }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>{{ date('M d, Y', strtotime($message->created_at)) . ' at ' . date('H:i:s', strtotime($message->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($messages->links())
                            <div class="pagination w-100 d-block">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="basic-datatables_info" role="status" aria-live="polite">
                                            {{ __('Showing ' . $messages->count() . ' of ' . $messages->total() . ' entries') }}
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="d-flex dataTables_paginate paging_simple_numbers justify-content-end">
                                            {{ $messages->links('dashboard.partials.pagination', ['posts' => $messages]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <p>{{ __('No any forms messages received yet.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endsection
