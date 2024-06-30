@extends('dashboard.layouts.app')

@section('title', __('Add New User'))

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
            <h3 class="fw-bold mb-3">{{ __('Add New User') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('dash.users.add.save') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <div class="card-title">{{ __('User Data') }}</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label for="name"><strong>{{ __('Nickname') }}</strong></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="John" required>
                                </div>
                                <div class="form-group">
                                    <label for="first_name"><strong>{{ __('First Name') }}</strong></label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="John">
                                </div>
                                <div class="form-group">
                                    <label for="first_name"><strong>{{ __('Last Name') }}</strong></label>
                                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Doe">
                                </div>
                                <div class="form-group">
                                    <label for="email"><strong>{{ __('Email') }}</strong></label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="example@site.com" required>
                                </div>
                                <div class="form-group">
                                    <label for="bio"><strong>{{ __('Bio') }}</strong></label>
                                    <textarea name="description" id="bio" class="form-control" cols="30" rows="6"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="birth_date"><strong>{{ __('Birth Date') }}</strong></label>
                                    <input type="date" name="birth_date" class="form-control" id="birth_date" placeholder="John">
                                </div>
                                <div class="form-group">
                                    <label for="role_id"><strong>{{ __('Role') }}</strong></label>
                                    <select name="role_id" id="role_id" class="form-select form-control" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="password"><strong>{{ __('New Password') }}</strong></label>
                                    <input type="password" name="password" class="form-control" id="password" required>
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
