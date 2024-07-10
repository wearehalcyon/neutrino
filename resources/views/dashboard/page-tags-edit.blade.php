@extends('dashboard.layouts.app')

@section('title', __('Edit Tag'))

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
            <h3 class="fw-bold mb-3">{{ __('Edit Tag') }}</h3>
        </div>
    </div>

    <form class="row" action="{{ route('dash.tags.edit.save', $tag->id) }}" method="post">
        @csrf
        <div class="col-md-8 col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Tag Information') }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><strong>{{ __('Name') }}</strong></label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $tag->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="slug"><strong>{{ __('Slug') }}</strong></label>
                        <input type="text" name="slug" class="form-control" id="slug" value="{{ $tag->slug }}">
                        <small id="slug" class="form-text text-muted">{{ __('Will be automatically generated from Name field.') }}</small>
                    </div>
                    <div class="form-group">
                        <label for="description"><strong>{{ __('Description') }}</strong></label>
                        <textarea name="description" id="description" cols="30" rows="6" class="form-control">{{ $tag->description }}</textarea>
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
                    <p><strong>{{ __('Created At: ') }}</strong><span>{{ date('M d, F', strtotime($tag->created_at)) . ' at ' . date('H:i:s', strtotime($tag->created_at))  }}</span></p>
                    @if($tag->created_at != $tag->updated_at)
                        <p><strong>{{ __('Updated At: ') }}</strong><span>{{ date('M d, F', strtotime($tag->updated_at)) . ' at ' . date('H:i:s', strtotime($tag->updated_at))  }}</span></p>
                    @endif
                    <p><strong>{{ __('Author: ') }}</strong><span>{{ getUser($tag->author_id)->name  }}</span></p>
                    <button type="submit" class="btn btn-success">{{ __('Create') }}</button>
                    <a href="{{ route('dash.tags.delete', $tag->id) }}" class="btn btn-danger delete" title="{{ __('Delete') }}">{{ __('Delete') }}</a>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer-scripts')
    <script>
        let delBtn = $('.delete');
        delBtn.on('click', function(){
            if (confirm('Do you really want to delete this tag?') == true) {
                return true;
            }
            return false;
        });
    </script>
@endsection
