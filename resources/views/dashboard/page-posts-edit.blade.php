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
        .tox-promotion,
        .tox-statusbar__branding{
            display: none;
        }
        .select2{
            width: 100% !important;
        }
        .select2-container--default .select2-selection--multiple{
            border-color: #e3e3e3 !important;
        }
        .select2-selection__choice{
            background-color: #f1f1f1 !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-action mb-4">
        <a href="{{ route('dash.posts.add') }}" class="btn btn-primary">{{ __('Create New Post') }}</a>
    </div>

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4" >
        <div>
            <h3 class="fw-bold mb-3">{{ __('Edit Post') }}</h3>
        </div>
    </div>

    <form class="row" action="{{ route('dash.posts.edit.save', $post->id) }}" method="post" enctype="multipart/form-data">
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
                        <div class="input-group mb-3">
                            <span class="input-group-text">{{ url('/' . getOption('blog_base')) . '/' }}</span>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ $post->slug }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description"><strong>{{ __('Description') }}</strong></label>
                        <textarea name="content" id="description" cols="30" rows="12" class="form-control ckeditor">{{ $post->content }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('SEO Optimization') }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="seo_title"><strong>{{ __('SEO Title') }}</strong></label>
                        <input type="text" name="seo_title" class="form-control" id="seo_title" value="{{ $post->getPostMeta('seo_title') }}">
                    </div>
                    <div class="form-group">
                        <label for="seo_slug"><strong>{{ __('SEO Slug') }}</strong></label>
                        <input type="text" name="seo_slug" class="form-control" id="seo_slug" value="{{ $post->getPostMeta('seo_slug') }}">
                    </div>
                    <div class="form-group">
                        <label for="meta_description"><strong>{{ __('Meta Description') }}</strong></label>
                        <textarea name="meta_description" id="meta_description" cols="30" rows="6" class="form-control">{{ $post->getPostMeta('meta_description') }}</textarea>
                        <div class="seo-limiter">
                            <div class="limiter-desc">
                                <span class="form-text text-muted">{{ __('Meta description characters level (170 best choice).') }}</span>
                                <span class="form-text text-muted current-count">0/170</span>
                            </div>
                            <div class="limiter"><div class="level"></div></div>
                        </div>
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
                                <input class="form-check-input" name="category_id[]" type="checkbox" value="{{ $category->id }}" id="category-{{ $category->id }}" @if(in_array($category->id, $post->getCategoriesIds())) checked @endif>
                                <label class="form-check-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('dash.categories.add') }}" class="d-inline-block link-primary mt-3" title="{{ __('Add New Category') }}">{{ __('Add New Category') }}</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Tags') }}</div>
                </div>
                <div class="card-body">
                    <select id="tag-select" class="js-example-basic-multiple" name="tags[]" multiple="multiple"></select>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Thumbnail') }}</div>
                </div>
                <div class="card-body">
                    <div class="post-thumbnail-preview">
                        @if($post->thumbnail)
                            <img src="{{ asset($post->thumbnail) }}" alt="{{ __('Post Thumbnail Preview') }}" class="thumbnail-img" data-src="{{ asset('assets/images/no-thumbnail.jpg') }}">
                        @else
                            <img src="{{ asset('assets/images/no-thumbnail.jpg') }}" alt="{{ __('Post Thumbnail Preview') }}" class="thumbnail-img" data-src="{{ asset('assets/images/no-thumbnail.jpg') }}">
                        @endif
                    </div>
                    <div class="form-group px-0 mt-3">
                        <input id="thumbnail-uploader" name="thumbnail_file" class="form-control form-control-sm" accept="image/png, image/jpeg, image/jpg" type="file" @if($post->thumbnail) style="display: none;" @endif>
                        <input id="thumbnail-input" type="hidden" name="thumbnail" value="{{ $post->thumbnail }}">
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
    <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        @if(getOption('extended_editor') == 1)
        @php($editor = 'true')
        @else
        @php($editor = 'false')
        @endif
        tinymce.init({
            menubar: {{ $editor }},
            selector: '.ckeditor',
            @if(getOption('extended_editor') == 1)
            plugins: 'link autolink code table lists media image autoresize autosave pagebreak quickbars searchreplace visualblocks emoticons preview wordcount ',
            toolbar: 'undo redo | blocks fontsize forecolor bold italic underline strikethrough alignleft aligncenter alignright indent outdent bullist numlist blockquote | pagebreak link table image media | emoticons searchreplace restoredraft preview visualblocks code',
            @else
            plugins: 'link autolink code lists media image autoresize autosave quickbars visualblocks wordcount ',
            toolbar: 'blocks bold italic underline strikethrough alignleft aligncenter alignright indent outdent bullist numlist blockquote | link image media | restoredraft visualblocks code',
            @endif
            content_style: 'body { font-family: serif; font-size:18px; min-height: 300px !important; }',
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
    <script>
        let seoTextarea = $('textarea[name="meta_description"]'),
            current = seoTextarea.val().length,
            max = 170,
            result = (100 / max) * current;

        if (result <= 25) {
            var color = '#f00';
        } else if (result <= 50) {
            var color = '#ff9900';
        } else if (result <= 75) {
            var color = '#00c4ff';
        } else if (result <= 100) {
            var color = '#51d842';
        } else {
            var color = '#f00';
        }

        $('.seo-limiter .limiter-desc .current-count').text(current + '/170');
        $('.seo-limiter .limiter .level').css({
            'width': result + '%',
            'background-color': color
        });

        seoTextarea.on('keydown keyup change', function(){
            let current = $(this).val().length,
                max = 170,
                result = (100 / max) * current;

            if (result <= 25) {
                var color = '#f00';
            } else if (result <= 50) {
                var color = '#ff9900';
            } else if (result <= 75) {
                var color = '#00c4ff';
            } else if (result <= 100) {
                var color = '#51d842';
            } else {
                var color = '#f00';
            }

            $('.seo-limiter .limiter-desc .current-count').text(current + '/170');
            $('.seo-limiter .limiter .level').css({
                'width': result + '%',
                'background-color': color
            });
        });
    </script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script>
        $('#tag-select').select2({
            placeholder: "{{ __('Find tags...') }}",
            minimumInputLength: 2,
            ajax: {
                url: '{{ route('dash.tags.search') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    </script>
@endsection
