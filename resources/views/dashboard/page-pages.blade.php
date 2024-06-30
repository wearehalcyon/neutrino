@extends('dashboard.layouts.app')

@section('title', __('Pages'))

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
            <h3 class="fw-bold mb-3">{{ __('All Pages') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All site pages is here!') }}</h6>
        </div>
    </div>

    <div class="card-action mb-4">
        <a href="{{ route('dash.pages.add') }}" class="btn btn-primary">{{ __('Create New Page') }}</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Pages List') }}
                        @if($pages->isNotEmpty())
                            <strong>({{ $pages->total() }})</strong>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if($pages->isNotEmpty())
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 100px;">ID</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Created At') }}</th>
                                <th scope="col">{{ __('Author') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->id }}</td>
                                    <td>
                                        <a href="{{ route('dash.pages.edit', $page->id) }}" title="{{ $page->name }}">
                                            {{ $page->name }}
                                            @if(getOption('homepage_id') == $page->id)
                                                <span class="badge badge-black d-inline-block mx-2">{{ __('Homepage') }}</span>
                                            @endif
                                        </a>
                                    </td>
                                    <td>{{ date('M d, Y', strtotime($page->created_at)) . ' at ' . date('H:i:s', strtotime($page->created_at)) }}</td>
                                    <td>{{ $page->getAuthor()->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if($pages->links())
                            <div class="pagination w-100 d-block">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="basic-datatables_info" role="status" aria-live="polite">
                                            {{ __('Showing ' . $pages->count() . ' of ' . $pages->total() . ' entries') }}
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="d-flex dataTables_paginate paging_simple_numbers justify-content-end">
                                            {{ $pages->links('dashboard.partials.pagination', ['posts' => $pages]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <p>{{ __('No any pages created yet.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
@endsection
