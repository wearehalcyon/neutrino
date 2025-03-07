@extends('dashboard.layouts.app')

@section('title', __('Menu Items'))

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
            <h3 class="fw-bold mb-3">{{ __('All Menu Items') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All site menu items is here!') }}</h6>
        </div>
    </div>
    @if($menus->isNotEmpty())
        <div class="card-action mb-4">
            <a href="{{ route('dash.menu.items.add') }}" class="btn btn-primary">{{ __('Create New Menu Item') }}</a>
        </div>
    @else
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ __('Before create menu items you should create menu where it will be placed.') }} <a href="{{ route('dash.menus.add') }}">{{ __('Create menu') }}.</a>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Menus Items List') }}</div>
                </div>
                <div class="card-body">
                    @if($items->isNotEmpty())
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 100px;">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Parent</th>
                                <th scope="col">Order</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Author</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><a href="{{ route('dash.menu.items.edit', $item->id) }}" title="{{ $item->name }}">{{ $item->name }}</a></td>
                                        <td>{{ $item->getMenu()->name }}</td>
                                        <td>{{ optional($item->getParent())->name }}</td>
                                        <td>{{ $item->order }}</td>
                                        <td>{{ date('M d, Y', strtotime($item->created_at)) }}</td>
                                        <td><a href="{{ route('dash.users.edit', $item->getAuthor()->id) }}" title="{{ $item->getAuthor()->name }}">{{ $item->getAuthor()->name }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($items->links())
                            <div class="pagination w-100 d-block">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="basic-datatables_info" role="status" aria-live="polite">
                                            {{ __('Showing ' . $items->count() . ' of ' . $items->total() . ' entries') }}
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="d-flex dataTables_paginate paging_simple_numbers justify-content-end">
                                            {{ $items->links('dashboard.partials.pagination', ['posts' => $items]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <p>{{ __('No any menu items created yet.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
@endsection
