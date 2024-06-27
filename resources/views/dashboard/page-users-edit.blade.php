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
                                    <input type="text" name="name" class="form-control" id="name" placeholder="John" value="{{ $user->name }}" readonly disabled>
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
                                    <label for="display_name"><strong>{{ __('Display Name') }}</strong></label>
                                    <select name="display_name" id="display_name" class="form-select form-control">
                                        <option value="0" @if($user->getUserMeta()->display_name == 0){{ 'selected' }}@endif>{{ $user->name }}</option>
                                        @if($user->getUserMeta()->first_name)
                                            <option value="1" @if($user->getUserMeta()->display_name == 1){{ 'selected' }}@endif>{{ $user->getUserMeta()->first_name }}</option>
                                        @endif
                                        @if($user->getUserMeta()->last_name)
                                            <option value="2" @if($user->getUserMeta()->display_name == 2){{ 'selected' }}@endif>{{ $user->getUserMeta()->first_name . ' ' . $user->getUserMeta()->last_name }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email"><strong>{{ __('Email') }}</strong></label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="example@site.com" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="bio"><strong>{{ __('Bio') }}</strong></label>
                                    <textarea name="description" id="bio" class="form-control" cols="30" rows="6">{{ $user->getUserMeta()->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="birth_date"><strong>{{ __('Birth Date') }}</strong></label>
                                    <input type="date" name="birth_date" class="form-control" id="birth_date" placeholder="John" value="{{ $user->getUserMeta()->birth_date }}">
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
