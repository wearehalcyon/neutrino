@extends('dashboard.layouts.app')

@section('title', __('Categories'))

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
            <h3 class="fw-bold mb-3">{{ __('All Categories') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All site categories is here!') }}</h6>
        </div>
    </div>

    <div class="card-action mb-4">
        <a href="{{ route('dash.categories.add') }}" class="btn btn-primary">{{ __('Create New Category') }}</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Categories List') }}</div>
                </div>
                <div class="card-body">
                    @if($categories->isNotEmpty())
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 100px;">ID</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Slug') }}</th>
                                <th scope="col">{{ __('Created At') }}</th>
                                <th scope="col">{{ __('Author') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td><a href="{{ route('dash.categories.edit', $category->id) }}" title="{{ $category->name }}">{{ $category->name }}</a></td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ date('M d, Y', strtotime($category->created_at)) . ' at ' . date('H:i:s', strtotime($category->created_at)) }}</td>
                                    <td>{{ $category->getAuthor()->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>{{ __('No any categories created yet.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
@endsection
