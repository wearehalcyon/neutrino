@extends('dashboard.layouts.app')

@section('title', __('Edit Page'))

@section('header-scripts')
    <style>
        .ck-content{
            min-height: 400px;
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
            <h3 class="fw-bold mb-3">{{ __('Edit Page') }}</h3>
        </div>
    </div>

    <form class="row" action="{{ route('dash.pages.edit.save', $page->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-8 col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Page Information') }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><strong>{{ __('Title') }}</strong></label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $page->name }}" required>
                    </div>
                    <div class="form-group slug" @if(getOption('homepage_id') == $page->id) style="display: none;" @endif>
                        <label for="slug"><strong>{{ __('Slug') }}</strong></label>
                        <input type="text" name="slug" class="form-control" id="slug" value="{{ $page->slug }}">
                        <small id="slug" class="form-text text-muted">{{ __('Will be automatically generated from Title field.') }}</small>
                    </div>
                    <div class="form-group">
                        <label for="description"><strong>{{ __('Description') }}</strong></label>
                        <textarea name="content" id="description" cols="30" rows="12" class="form-control ckeditor">{{ $page->content }}</textarea>
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
                        <input type="text" name="seo_title" class="form-control" id="seo_title" value="{{ $page->getPageMeta('seo_title') }}">
                    </div>
                    <div class="form-group">
                        <label for="seo_slug"><strong>{{ __('SEO Slug') }}</strong></label>
                        <input type="text" name="seo_slug" class="form-control" id="seo_slug" value="{{ $page->getPageMeta('seo_slug') }}">
                    </div>
                    <div class="form-group">
                        <label for="meta_description"><strong>{{ __('Meta Description') }}</strong></label>
                        <textarea name="meta_description" id="meta_description" cols="30" rows="6" class="form-control">{{ $page->getPageMeta('meta_description') }}</textarea>
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
                                <label for="status"><strong>{{ __('Status') }}</strong></label>
                                <select name="status" id="status" class="form-select form-control">
                                    <option value="1" @if($page->status == 1) selected @endif>{{ __('Published') }}</option>
                                    <option value="2" @if($page->status == 2) selected @endif>{{ __('Draft') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-6">
                            <div class="form-group px-0">
                                <label for="author"><strong>{{ __('Author') }}</strong></label>
                                <select name="author_id" id="author" class="form-select form-control">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($page->author_id == $user->id) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group px-0">
                                <label for="created_at"><strong>{{ __('Publication Date') }}</strong></label>
                                <input type="datetime-local" name="created_at" class="form-control" id="created_at" value="{{ date('Y-m-d\TH:i:s', strtotime($page->created_at)) }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">{{ __('Update') }}</button>
                    @if(getOption('homepage_id') != $page->id)
                        <a href="{{ route('dash.pages.delete', $page->id) }}" class="btn btn-danger delete d-inline-block mt-2" title="{{ __('Delete') }}">{{ __('Delete') }}</a>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Page Attributes') }}</div>
                </div>
                <div class="card-body">
                    <div class="form-check form-switch p-0">
                        <label for="homepage_id"><strong>{{ __('Make This Page As Homepage') }}</strong></label>
                        <br>
                        @if(!getOption('homepage_id') || getOption('homepage_id') == $page->id)
                            <input id="homepage_id" class="form-check-input" type="checkbox" name="homepage_id" style="cursor: pointer;" @if(getOption('homepage_id') == $page->id) checked @endif>
                            <br>
                            @if(getOption('homepage_id') == $page->id)
                                <small class="form-text text-muted mt-3" style="display: block;">{{ __('This page set as Homepage and can\'t be deleted.') }}</small>
                            @endif
                        @else
                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="box-shadow: none; background-color: #fff6ea;">
                                {!! __('This page can\'t be set as the Homepage because a different page is currently selected. <a href="' . route('dash.pages.edit', getOption('homepage_id')) . '" title="Edit The Homepage">Edit The Hompage</a>.') !!}
                            </div>
                        @endif
                    </div>
                    <div class="form-group px-0">
                        <label for="template"><strong>{{ __('Page Template') }}</strong></label>
                        <select name="template" id="template" class="form-select form-control">
                            <option value="default">Default</option>
                            @foreach($templates as $template)
                                <option value="{{ $template }}" @if($template == $page->template) selected @endif>{{ ucwords(str_replace('-', ' ', $template)) }}</option>
                            @endforeach
                        </select>
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
        let delBtn = $('.delete');
        delBtn.on('click', function(){
            if (confirm('Do you really want to delete this page?') == true) {
                return true;
            }
            return false;
        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[name="homepage_id"]').change(function() {
                if ($(this).is(':checked')) {
                    $('.form-group.slug').hide();
                } else {
                    $('.form-group.slug').show();
                }
            });
        });
    </script>
@endsection
