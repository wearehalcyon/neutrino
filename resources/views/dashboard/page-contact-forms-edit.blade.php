@extends('dashboard.layouts.app')

@section('title', __('Edit Contact Form'))

@section('header-scripts')
    <link rel="stylesheet" href="{{ asset('assets/plugins/codemirror5/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/codemirror5/theme/monokai.css') }}">
    <style>
        .CodeMirror{
            min-height: 500px;
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
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul style="margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4" >
        <div>
            <h3 class="fw-bold mb-3">{{ __('Edit Contact Form') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Form Fields') }}</div>
                </div>
                <form id="contact-form-builder" action="{{ route('dash.c-forms.edit.save', $form->id) }}" method="post" class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="name"><strong>{{ __('Name') }}</strong></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ? old('name') : $form->name }}">
                    </div>
                    <div class="form-group">
                        <label for="form_fields"><strong>{{ __('Form Markup') }}</strong></label>
                        <textarea name="form_fields" id="form_fields" cols="30" rows="25" class="form-control codemirror">{{ old('form_fields') ? old('form_fields') : $form->form_fields }}</textarea>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="shortcode"><strong>{{ __('Form Shortcode') }}</strong></label>--}}
{{--                        <input type="text" value='[getContactForm title="{{ $form->name }}" id="{{ $form->id }}"]' class="form-control" disabled readonly style="font-weight: 700;">--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <label for="shortcode"><strong>{{ __('Form PHP Function') }}</strong></label>
                        <input type="text" value="getContactForm('{{ $form->name }}', '{{ $form->id }}')" class="form-control" disabled readonly style="font-weight: 700;">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ __('Update Form') }}</button>
                        <a href="" class="btn btn-danger delete">{{ __('Delete') }}</a>
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
    <script>
        let delBtn = $('.delete');
        delBtn.on('click', function(){
            if (confirm('Do you really want to delete this form?') == true) {
                return true;
            }
            return false;
        });
    </script>
@endsection
