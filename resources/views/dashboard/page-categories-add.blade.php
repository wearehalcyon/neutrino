@extends('dashboard.layouts.app')

@section('title', __('Create New Category'))

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
            <h3 class="fw-bold mb-3">{{ __('Create New Category') }}</h3>
        </div>
    </div>

    <form class="row" action="{{ route('dash.categories.add.save') }}" method="post">
        @csrf
        <div class="col-md-8 col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Category Information') }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><strong>{{ __('Name') }}</strong></label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="slug"><strong>{{ __('Slug') }}</strong></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">{{ url('/' . str_replace('{category}', '', getOption('category_base'))) . '/' }}</span>
                            <input type="text" class="form-control" id="slug" name="slug">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description"><strong>{{ __('Description') }}</strong></label>
                        <textarea name="description" id="description" cols="30" rows="6" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Actions') }}</div>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-success">{{ __('Create') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer-scripts')
@endsection
