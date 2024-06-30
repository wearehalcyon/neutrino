@extends('dashboard.layouts.app')

@section('title', __('All Users'))

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
            <h3 class="fw-bold mb-3">{{ __('All Users') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All site users is here!') }}</h6>
        </div>
    </div>

    <div class="card-action mb-4">
        <a href="{{ route('dash.users.add') }}" class="btn btn-primary">{{ __('Add User') }}</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Users List') }}</div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><a href="{{ route('dash.users.edit', $user->id) }}" title="{{ $user->name }}">{{ $user->name }}</a></td>
                                    <td><a href="{{ 'mailto:' . $user->email }}" title="{{ $user->email }}">{{ $user->email }}</a></td>
                                    <td>{{ $user->getRole()->name }}</td>
                                    <td>{{ date('M d, Y', strtotime($user->created_at)) }} at {{ date('H:i', strtotime($user->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
@endsection
