@extends('dashboard.layouts.app')

@section('title', __('Add Contact Form'))

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
            <h3 class="fw-bold mb-3">{{ __('Add Contact Form') }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Form Fields') }}</div>
                </div>
                <form id="contact-form-builder" action="{{ route('dash.c-forms.add.save') }}" method="post" class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="form_fields"><strong>{{ __('Form Markup') }}</strong></label>
                        <textarea name="form_fields" id="form_fields" cols="30" rows="25" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ __('Save Form') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Settings') }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="column"><strong>{{ __('Column') }}</strong></label>
                        <select class="form-select column" id="column">
                            <option value="1">1/4</option>
                            <option value="2">2/4</option>
                            <option value="3">3/4</option>
                            <option value="4">4/4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary add-field">{{ __('Add Field') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        jQuery(document).ready(function(event){
            event.preventDefault();

        });
    </script>
@endsection
