@extends('dashboard.layouts.app')

@section('title', __('Create New Post'))

@section('header-scripts')
    <style>
        .ck-content{
            min-height: 400px;
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
            <h3 class="fw-bold mb-3">{{ __('Create New Post') }}</h3>
        </div>
    </div>

    <form class="row" action="{{ route('dash.categories.add.save') }}" method="post">
        @csrf
        <div class="col-md-8 col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Post Information') }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><strong>{{ __('Title') }}</strong></label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="slug"><strong>{{ __('Slug') }}</strong></label>
                        <input type="text" name="slug" class="form-control" id="slug">
                        <small id="slug" class="form-text text-muted">{{ __('Will be automatically generated from Title field.') }}</small>
                    </div>
                    <div class="form-group">
                        <label for="description"><strong>{{ __('Description') }}</strong></label>
                        <textarea name="description" id="description" cols="30" rows="12" class="form-control ckeditor"></textarea>
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
                    <div class="form-group px-0">
                        <label for="name"><strong>{{ __('Title') }}</strong></label>
                        <input type="datetime-local" name="name" class="form-control" id="name" required>
                    </div>
                    <button type="submit" class="btn btn-success">{{ __('Create') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('footer-scripts')
    <script src="{{ asset('assets/js/ckeditor5.js') }}"></script>
    <script src="{{ asset('assets/js/ckeditor5-alignment.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.ckeditor').each(function() {
                ClassicEditor
                    .create(this, {
                        toolbar: {
                            items: [
                                'heading',
                                '|',
                                'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                                '|',
                                'link', 'blockQuote', 'codeBlock',
                                '|',
                                'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent', 'alignment',
                                '|'
                            ],
                            shouldNotGroupWhenFull: false
                        },
                        alignment: {
                            options: ['left', 'center', 'right', 'justify'] // Настройки выравнивания
                        },
                        shouldNotGroupWhenFull: true
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        });
    </script>
@endsection
