@extends('dashboard.layouts.app')

@section('title', __('Create New Menu Item'))

@section('header-scripts')
    <style>
        .form-group.type .form-check label,
        .form-group.type .form-check input{
            cursor: pointer;
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
            <h3 class="fw-bold mb-3">{{ __('Create New Menu Item') }}</h3>
        </div>
    </div>

    <form class="row" action="{{ route('dash.menu.items.add.save') }}" method="post">
        @csrf
        <div class="col-md-8 col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Menu Item Information') }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="menu_id"><strong>{{ __('Menu') }}</strong></label>
                        <select name="menu_id" id="menu_id" class="form-select form-control">
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name"><strong>{{ __('Name') }}</strong></label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="form-group type">
                        <label><strong>{{ __('Type') }}</strong></label><br>
                        <div class="selectgroup w-auto">
                            <label class="selectgroup-item">
                                <input id="page" type="radio" name="type" value="1" class="selectgroup-input" checked>
                                <span class="selectgroup-button">{{ __('Page') }}</span>
                            </label>
                            <label class="selectgroup-item">
                                <input id="custom" type="radio" name="type" value="2" class="selectgroup-input">
                                <span class="selectgroup-button">{{ __('Custom Link') }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group page">
                        <label for="slug"><strong>{{ __('Slug') }}</strong></label>
                        <input type="text" name="slug" class="form-control" id="slug">
                        <small id="slug" class="form-text text-muted">{{ __('Will be automatically generated from Name field.') }}</small>
                    </div>
                    <div class="form-group custom">
                        <label for="url"><strong>{{ __('Custom URL') }}</strong></label>
                        <input type="text" name="url" class="form-control" id="url">
                    </div>
                    <div class="form-group">
                        <label for="parent"><strong>{{ __('Parent Menu Item') }}</strong></label>
                        <select name="parent" id="parent" class="form-select form-control">
                            <option disabled selected></option>
                            @foreach($menuItems as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="custom_class"><strong>{{ __('Custom Class') }}</strong></label>
                        <input type="text" name="custom_class" class="form-control" id="custom_class">
                    </div>
                    <div class="form-group">
                        <label for="order"><strong>{{ __('Item Order') }}</strong></label>
                        <input type="number" name="order" min="0" class="form-control" id="order" value="0">
                    </div>
                    <div class="form-check form-switch">
                        <label for="target"><strong>{{ __('Open In New Tab') }}</strong></label>
                        <br>
                        <input id="target" class="form-check-input" type="checkbox" name="target" style="cursor: pointer;">
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
    <script>
        $(document).ready(function() {
            $('input[name="type"]').change(function() {
                if ($('#page').is(':checked')) {
                    $('.form-group.page').show();
                    $('.form-group.custom').hide();
                } else if ($('#custom').is(':checked')) {
                    $('.form-group.page').hide();
                    $('.form-group.custom').show();
                }
            });

            if ($('#page').is(':checked')) {
                $('.form-group.page').show();
                $('.form-group.custom').hide();
            } else if ($('#custom').is(':checked')) {
                $('.form-group.page').hide();
                $('.form-group.custom').show();
            }
        });
    </script>
@endsection
