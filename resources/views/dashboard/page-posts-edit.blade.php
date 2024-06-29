@extends('dashboard.layouts.app')

@section('title', __('Edit Post'))

@section('header-scripts')
    <style>
        .ck-content{
            min-height: 400px;
        }
        .categories-list{
            padding: 10px;
            border: 1px solid #e4e4e4;
            border-radius: 8px;
            height: 150px;
            overflow-y: auto;
        }
        .categories-list .form-check{
            padding: 0;
        }
        .categories-list .form-check input,
        .categories-list .form-check label{
            cursor: pointer;
        }
        .categories-list .form-check input:checked ~ label{
            font-weight: 700;
        }
        .thumbnail-img{
            width: 100%;
            max-height: 250px;
            object-fit: cover;
        }
        input#name{
            font-size: 24px;
            font-weight: 600;
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
            <h3 class="fw-bold mb-3">{{ __('Edit Post') }}</h3>
        </div>
    </div>

    <form class="row" action="{{ route('dash.posts.add.save') }}" method="post">
        @csrf
        <div class="col-md-8 col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Post Information') }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><strong>{{ __('Title') }}</strong></label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $post->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="slug"><strong>{{ __('Slug') }}</strong></label>
                        <input type="text" name="slug" class="form-control" id="slug" value="{{ $post->slug }}">
                        <small id="slug" class="form-text text-muted">{{ __('Will be automatically generated from Title field.') }}</small>
                    </div>
                    <div class="form-group">
                        <label for="description"><strong>{{ __('Description') }}</strong></label>
                        <textarea name="content" id="description" cols="30" rows="12" class="form-control ckeditor">{{ $post->content }}</textarea>
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
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12 col-xl-6">
                            <div class="form-group px-0">
                                <label for="delayed_date"><strong>{{ __('Delayed Publication Date') }}</strong></label>
                                <input type="datetime-local" name="delayed_date" class="form-control" id="delayed_date" value="{{ $delay }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-6">
                            <div class="form-group px-0">
                                <label for="status"><strong>{{ __('Status') }}</strong></label>
                                <select name="status" id="status" class="form-select form-control">
                                    <option value="1" @if($post->status == 1) selected @endif>{{ __('Published') }}</option>
                                    <option value="2" @if($post->status == 2) selected @endif>{{ __('Draft') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-6">
                            <div class="form-group px-0">
                                <label for="created_at"><strong>{{ __('Publication Date') }}</strong></label>
                                <input type="datetime-local" name="created_at" class="form-control" id="created_at" value="{{ date('Y-m-d\TH:i:s', strtotime($post->created_at)) }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-6">
                            <div class="form-group px-0">
                                <label for="author"><strong>{{ __('Author') }}</strong></label>
                                <select name="author_id" id="author" class="form-select form-control">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($post->author_id == $user->id) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">{{ __('Update') }}</button>
                    <a href="{{ route('dash.posts.delete', $post->id) }}" class="btn btn-danger delete d-inline-block mt-2" title="{{ __('Delete') }}">{{ __('Delete') }}</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Categories') }}</div>
                </div>
                <div class="card-body">
                    <div class="categories-list">
                        @foreach($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="category-{{ $category->id }}" @if(in_array($category->id, $post->getCategoriesIds())) checked @endif>
                                <label class="form-check-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('dash.categories.add') }}" class="d-inline-block link-primary mt-3" title="{{ __('Add New Category') }}">{{ __('Add New Category') }}</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Thumbnail') }}</div>
                </div>
                <div class="card-body">
                    <div class="post-thumbnail-preview">
                        @if($post->thumbnail)
                            <img src="{{ asset('uploads/' . $post->thumbnail) }}" alt="{{ __('Post Thumbnail Preview') }}" class="thumbnail-img" data-src="{{ asset('assets/images/no-thumbnail.jpg') }}">
                        @else
                            <img src="{{ asset('assets/images/no-thumbnail.jpg') }}" alt="{{ __('Post Thumbnail Preview') }}" class="thumbnail-img" data-src="{{ asset('assets/images/no-thumbnail.jpg') }}">
                        @endif
                    </div>
                    <div class="form-group px-0 mt-3">
                        <input id="thumbnail-uploader" class="form-control form-control-sm" accept="image/png, image/jpeg, image/jpg" type="file" @if($post->thumbnail) style="display: none;" @endif>
                        <input id="thumbnail-input" type="hidden" name="thumbnail" value="">
                        <div class="remove-thumbnail" @if(!$post->thumbnail) style="display: none;" @endif>
                            <a href="javascript:;" class="link-danger" title="{{ __('Remove Thumbnail') }}">{{ __('Remove Thumbnail') }}</a>
                        </div>
                    </div>
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
    <script>
        $(document).ready(function() {
            $('#thumbnail-uploader').on('change', function() {
                const file = this.files[0];
                if (file) {

                    $(this).hide();

                    $('.remove-thumbnail').show();

                    $('#thumbnail-input').val(file.name);

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('.thumbnail-img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
            $('.remove-thumbnail a').on('click', function(e) {
                e.preventDefault();

                let src = $('.thumbnail-img').data('src');

                $(this).parent().hide();

                $('#thumbnail-uploader').show();

                $('#thumbnail-input, #thumbnail-uploader').val('');

                $('.thumbnail-img').attr('src', src);
            });
        });
    </script>
    <script>
        let delBtn = $('.delete');
        delBtn.on('click', function(){
            if (confirm('Do you really want to delete this post?') == true) {
                return true;
            }
            return false;
        });
    </script>
@endsection
