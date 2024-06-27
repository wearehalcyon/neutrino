@extends('dashboard.layouts.app')

@section('title', __('Site Settings'))

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
            <h3 class="fw-bold mb-3">{{ __('Edit User') }}</h3>
            <h6 class="op-7 mb-2">{{ $user->name }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('dash.users.edit.update', $user->id) }}" method="post">
                    @csrf
                    <div class="card-header">
                        <div class="card-title">{{ __('User Data') }}</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="name"><strong>{{ __('Nickname') }}</strong></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="John" value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="first_name"><strong>{{ __('First Name') }}</strong></label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="John" value="{{ $user->getUserMeta()->first_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="first_name"><strong>{{ __('Last Name') }}</strong></label>
                                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Doe" value="{{ $user->getUserMeta()->last_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email"><strong>{{ __('Email') }}</strong></label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="example@site.com" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="bio"><strong>{{ __('Bio') }}</strong></label>
                                    <textarea name="description" id="bio" class="form-control" cols="30" rows="6">{{ $user->getUserMeta()->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
@endsection
