@extends('dashboard.layouts.app')

@section('title', __('Customize'))

@section('header-scripts')
    <style>
        .site-logo{
            display: inline-block;
            background: url("{{ asset('assets/images/transparent.png') }}") top left;
            min-width: 80px;
            min-height: 80px;
            width: auto;
            height: auto;
            margin-bottom: 10px;
        }
        .site-logo img{
            width: auto;
            height: auto;
            max-height: 80px;
            max-width: 100%;
        }
        .header-image{
            display: inline-block;
            background: url("{{ asset('assets/images/transparent.png') }}") top left;
            min-width: 80px;
            min-height: 80px;
            width: auto;
            height: auto;
            margin-bottom: 10px;
        }
        .header-image img{
            width: auto;
            height: auto;
            max-height: 200px;
            max-width: 100%;
        }
        .favicon{
            display: inline-block;
            background: url("{{ asset('assets/images/transparent.png') }}") top left;
            min-width: 32px;
            min-height: 32px;
            width: auto;
            height: auto;
            margin-bottom: 10px;
        }
        .favicon img{
            width: auto;
            height: auto;
            max-height: 32px;
            max-width: 100%;
        }
        .btn{
            color: #fff !important;
            filter: none;
            margin: 0 !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/plugins/codemirror5/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/codemirror5/theme/monokai.css') }}">
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4" >
        <div>
            <h3 class="fw-bold mb-3">{{ __('Customize') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('dash.customize.save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <div class="card-title">{{ __('Site Identity') }}</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h5><strong>{{ __('Site Media') }}</strong></h5>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label><strong>{{ __('Site Logo') }}</strong></label>
                                    <br>
                                    <div class="site-logo">
                                        @if(getOption('site_logo'))
                                            <img src="{{ asset('uploads/' . getOption('site_logo')) }}" alt="{{ __('Site Logo') }}">
                                        @endif
                                    </div>
                                    <input id="site_logo" type="file" name="site_logo" style="display: none;" accept="image/png,image/jpg,image/jpeg">
                                    <input type="hidden" name="remove_logo" value="">
                                    <br>
                                    <label for="site_logo" class="btn btn-secondary"><span class="btn-label"></span>{{ __('Upload Logo') }}</label>
                                    <a href="javascript:;" class="btn btn-danger remove">{{ __('Remove') }}</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label><strong>{{ __('Header Image') }}</strong></label>
                                    <br>
                                    <div class="header-image">
                                        @if(getOption('header_image'))
                                            <img src="{{ asset('uploads/' . getOption('header_image')) }}" alt="{{ __('Header Image') }}">
                                        @endif
                                    </div>
                                    <input id="header_image" type="file" name="header_image" style="display: none;" accept="image/png,image/jpg,image/jpeg">
                                    <input type="hidden" name="remove_header_image" value="">
                                    <br>
                                    <label for="header_image" class="btn btn-secondary"><span class="btn-label"></span>{{ __('Upload Image') }}</label>
                                    <a href="javascript:;" class="btn btn-danger remove_header_image">{{ __('Remove') }}</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label><strong>{{ __('Favicon') }}</strong></label>
                                    <br>
                                    <div class="favicon">
                                        @if(getOption('favicon'))
                                            <img src="{{ asset('uploads/' . getOption('favicon')) }}" alt="{{ __('Favicon') }}">
                                        @endif
                                    </div>
                                    <input id="favicon" type="file" name="favicon" style="display: none;" accept="image/png,image/jpg,image/jpeg">
                                    <input type="hidden" name="remove_favicon" value="">
                                    <br>
                                    <label for="favicon" class="btn btn-secondary"><span class="btn-label"></span>{{ __('Upload Favicon') }}</label>
                                    <a href="javascript:;" class="btn btn-danger remove_favicon">{{ __('Remove') }}</a>
                                </div>
                            </div>
                            <hr style="opacity: .1;">
                            <h5><strong>{{ __('Site Custom Scripts and Styles') }}</strong></h5>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="header_scripts"><strong>{{ __('Header') }}</strong></label>
                                    <textarea id="header_scripts" name="header_scripts" class="header_scripts codemirror" cols="30" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="header_scripts"><strong>{{ __('Footer') }}</strong></label>
                                    <textarea id="header_scripts" name="header_scripts" class="header_scripts codemirror" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script src="{{ asset('assets/plugins/codemirror5/lib/codemirror.js') }}"></script>
    <script src="{{ asset('assets/plugins/codemirror5/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('assets/plugins/codemirror5/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('assets/plugins/codemirror5/mode/css/css.js') }}"></script>
    <script src="{{ asset('assets/plugins/codemirror5/mode/htmlmixed/htmlmixed.js') }}"></script>
    <script>
        jQuery(document).ready(function($){
            $('#site_logo').on('change', function() {
                const file = this.files[0];
                if (file) {

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('.site-logo').html('<img src="' + e.target.result + '" alt="{{ __('Site Logo') }}">');
                    }
                    reader.readAsDataURL(file);
                }
            });
            $(document).on('click', '.remove',  function(e){
                e.preventDefault();

                $('.site-logo img').remove();
                $('input[name="remove_logo"]').val(1);
            });
        });
    </script>
    <script>
        jQuery(document).ready(function($){
            $('#header_image').on('change', function() {
                const file = this.files[0];
                if (file) {

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('.header-image').html('<img src="' + e.target.result + '" alt="{{ __('Header Image') }}">');
                    }
                    reader.readAsDataURL(file);
                }
            });
            $(document).on('click', '.remove_header_image',  function(e){
                e.preventDefault();

                $('.header-image img').remove();
                $('input[name="remove_header_image"]').val(1);
            });
        });
    </script>
    <script>
        jQuery(document).ready(function($){
            $('#favicon').on('change', function() {
                const file = this.files[0];
                if (file) {

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('.favicon').html('<img src="' + e.target.result + '" alt="{{ __('Favicon') }}">');
                    }
                    reader.readAsDataURL(file);
                }
            });
            $(document).on('click', '.remove_favicon',  function(e){
                e.preventDefault();

                $('.favicon img').remove();
                $('input[name="remove_favicon"]').val(1);
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var codeAreas = document.querySelectorAll('.codemirror');
            codeAreas.forEach(function(codeArea) {
                CodeMirror.fromTextArea(codeArea, {
                    lineNumbers: true,
                    mode: 'htmlmixed',
                    matchBrackets: true,
                    theme: 'monokai'
                });
            });
        });
    </script>
@endsection
