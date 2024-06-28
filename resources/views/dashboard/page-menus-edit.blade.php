@extends('dashboard.layouts.app')

@section('title', __('Edit Menu'))

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
            <h3 class="fw-bold mb-3">{{ __('Edit Menu') }}</h3>
        </div>
    </div>

    <form class="row" action="{{ route('dash.menus.edit.save', $menu->id) }}" method="post">
        @csrf
        <div class="col-md-8 col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Menu Information') }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><strong>{{ __('Name') }}</strong></label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $menu->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description"><strong>{{ __('Description') }}</strong></label>
                        <textarea name="description" id="description" cols="30" rows="6" class="form-control">{{ $menu->description }}</textarea>
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
                    <p><strong>{{ __('Created At: ') }}</strong><span>{{ date('M d, F', strtotime($menu->created_at)) . ' at ' . date('H:i:s', strtotime($menu->created_at))  }}</span></p>
                    @if($menu->created_at != $menu->updated_at)
                        <p><strong>{{ __('Updated At: ') }}</strong><span>{{ date('M d, F', strtotime($menu->updated_at)) . ' at ' . date('H:i:s', strtotime($menu->updated_at))  }}</span></p>
                    @endif
                    <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                    <a href="{{ route('dash.menus.delete', $menu->id) }}" class="btn btn-danger delete">{{ __('Delete Menu') }}</a>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer-scripts')
    <script>
        let delBtn = $('.delete');
        delBtn.on('click', function(){
            if (confirm('Do you really want to delete this menu?') == true) {
                return true;
            }
            return false;
        });
    </script>
@endsection
