@extends('dashboard.layouts.app')

@section('title', __('Applications'))

@section('header-scripts')
    <style>
        .app-icon,
        .app-icon svg{
            width: 42px;
            height: 42px;
        }
    </style>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4" >
        <div>
            <h3 class="fw-bold mb-3">{{ __('All Applications') }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Installed Applications List') }}</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">{{  __('Name') }}</th>
                                    <th scope="col">{{  __('Version') }}</th>
                                    <th scope="col">{{  __('Author') }}</th>
                                    <th scope="col">{{  __('Description') }}</th>
                                    <th scope="col">{{  __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apps as $app)
                                    @php($app = (array)$app)
                                    @if($app['json'])
                                        <tr>
                                            <td class="app-icon">{!! $app['svg'] !!}</td>
                                            <td>{{  $app['json']->name }}</td>
                                            <td>{{  $app['json']->version }}</td>
                                            <td>{{  $app['json']->author }}</td>
                                            <td>{{  $app['json']->description }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
@endsection
