@extends('dashboard.layouts.app')

@section('title', __('Edit Menu Item'))

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
            <h3 class="fw-bold mb-3">{{ __('Edit Menu Item') }}</h3>
        </div>
    </div>

    <form class="row" action="{{ route('dash.menu.items.edit.save', $item->id) }}" method="post">
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
                                <option value="{{ $menu->id }}" @if($item->menu_id == $menu->id) selected @endif>{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name"><strong>{{ __('Name') }}</strong></label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" required>
                    </div>
                    <div class="form-group type">
                        <label><strong>{{ __('Type') }}</strong></label><br>
                        <div class="selectgroup w-auto">
                            <label class="selectgroup-item">
                                <input id="page" type="radio" name="type" value="1" class="selectgroup-input" @if($item->type == 1) checked @endif>
                                <span class="selectgroup-button">{{ __('Page') }}</span>
                            </label>
                            <label class="selectgroup-item">
                                <input id="custom" type="radio" name="type" value="2" class="selectgroup-input" @if($item->type == 2) checked @endif>
                                <span class="selectgroup-button">{{ __('Custom Link') }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group page">
                        <label for="slug"><strong>{{ __('Slug') }}</strong></label>
                        <input type="text" name="slug" class="form-control" id="slug" value="{{ $item->slug }}">
                        <small id="slug" class="form-text text-muted">{{ __('Will be automatically generated from Name field.') }}</small>
                    </div>
                    <div class="form-group custom">
                        <label for="url"><strong>{{ __('Custom URL') }}</strong></label>
                        <input type="text" name="url" class="form-control" id="url" value="{{ $item->url }}">
                    </div>
                    <div class="form-group">
                        <label for="custom_class"><strong>{{ __('Custom Class') }}</strong></label>
                        <input type="text" name="custom_class" class="form-control" id="custom_class" value="{{ $item->custom_class }}">
                    </div>
                    <div class="form-check form-switch">
                        <label for="target"><strong>{{ __('Open In New Tab') }}</strong></label>
                        <br>
                        <input id="target" class="form-check-input" type="checkbox" name="target" style="cursor: pointer;" @if($item->target) checked @endif>
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
                    <p><strong>{{ __('Created At: ') }}</strong><span>{{ date('M d, F', strtotime($item->created_at)) . ' at ' . date('H:i:s', strtotime($item->created_at))  }}</span></p>
                    @if($item->created_at != $item->updated_at)
                        <p><strong>{{ __('Updated At: ') }}</strong><span>{{ date('M d, F', strtotime($item->updated_at)) . ' at ' . date('H:i:s', strtotime($item->updated_at))  }}</span></p>
                    @endif
                    <p><strong>{{ __('Author: ') }}</strong><span>{{ getUser($item->author_id)->name  }}</span></p>
                    <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                    <a href="" class="btn btn-danger delete">{{ __('Delete') }}</a>
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
    <script>
        let delBtn = $('.delete');
        delBtn.on('click', function(){
            if (confirm('Do you really want to delete this menu item?') == true) {
                return true;
            }
            return false;
        });
    </script>
@endsection
