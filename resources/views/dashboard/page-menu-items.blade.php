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

    <div class="card-action mb-4">
        <a href="{{ route('dash.menu.items.add') }}" class="btn btn-primary">{{ __('Create New Menu Item') }}</a>
    </div>

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
                                        <td>{{ date('M d, Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ 1 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
