@extends('dashboard.layouts.app')

@section('title', __('Pages'))

@section('header-scripts')
    <style>
        .seo-icon{
            display: inline-block;
            width: 16px;
            height: 16px;
            border-radius: 100px;
        }
        .editable .post-actions{
            display: block;
            opacity: 0;
        }
        .editable:hover .post-actions{
            opacity: 1;
        }
        .editable .post-actions ul{
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        .editable .post-actions ul li.separator{
            display: inline-block;
            margin: 0 5px;
            font-size: 14px;
        }
        .editable .post-actions ul li a{
            font-weight: 500;
            font-size: 14px;
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
            <h3 class="fw-bold mb-3">{{ __('All Pages') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All site pages is here!') }}</h6>
        </div>
    </div>

    <div class="card-action mb-4">
        <a href="{{ route('dash.pages.add') }}" class="btn btn-primary">{{ __('Create New Page') }}</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-flex align-items-center justify-content-between">
                        <span>
                            {{ __('Pages List') }}
                            @if($pages->isNotEmpty())
                                <strong>({{ $pages->total() }})</strong>
                            @endif
                        </span>
                        <div class="form-groups d-flex">
                            <div class="form-group">
                                <div class="input-group input-group-actions">
                                    <select name="action" class="form-select form-control bulk-actions" disabled style="min-width: 150px;">
                                        <option selected disabled>Bulk Actions</option>
                                        <option value="1">{{ __('Draft/Publish') }}</option>
                                        <option value="2">{{ __('Duplicate') }}</option>
                                        <option value="3">{{ __('Delete') }}</option>
                                    </select>
                                    <button type="button" class="btn input-group-text submit-action" disabled onclick="submitQuickAction()">{{ __('Apply') }}</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <form action="{{ route('dash.pages') }}" method="get" class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="{{ __('Search pages...') }}" value="{{ request()->input('search') }}">
                                    <button type="submit" class="input-group-text">{{ __('Find') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($pages->isNotEmpty())
                        <form id="quick-action" action="{{ route('dash.pages.quickaction') }}" method="get" class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 20px;">
                                        <input type="checkbox" name="select_all" style="width: 14px; height: 14px;">
                                    </th>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Author') }}</th>
                                    <th scope="col">{{ __('Created At') }}</th>
                                    <th scope="col" style="text-align: center;">{{ __('SEO') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pages as $page)
                                    <tr>
                                        <td><input type="checkbox" name="selects[]" value="{{ $page->id }}" style="width: 14px; height: 14px;"></td>
                                        <td class="editable">
                                            <a href="{{ route('dash.pages.edit', $page->id) }}" title="{{ $page->name }}">
                                                {{ $page->name }}
                                                @if(getOption('homepage_id') == $page->id)
                                                    <span class="badge badge-black d-inline-block mx-2">{{ __('Homepage') }}</span>
                                                @endif
                                            </a>
                                            <div class="post-actions">
                                                <ul>
                                                    <li><a href="{{ route('dash.posts.edit', $page->id) }}" title="{{ __('Edit') }}">{{ __('Edit') }}</a></li>
                                                    <li class="separator">|</li>
                                                    <li><a class="link-danger delete" href="{{ route('dash.pages.delete', $page->id) }}" title="{{ __('Delete') }}">{{ __('Delete') }}</a></li>
                                                    <li class="separator">|</li>
                                                    <li><a href="{{ route('dash.pages.duplicate', $page->id) }}" title="{{ __('Duplicate') }}">{{ __('Duplicate') }}</a></li>
                                                    <li class="separator">|</li>
                                                    <li><a href="{{ route('pages.internal', $page->slug) }}" title="{{ __('View') }}" target="_blank">{{ __('View') }}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>{{ $page->getAuthor()->name }}</td>
                                        <td>{{ date('M d, Y', strtotime($page->created_at)) . ' at ' . date('H:i:s', strtotime($page->created_at)) }}</td>
                                        <td style="text-align: center;">
                                            @php($length = \Illuminate\Support\Str::length($page->getPageMeta('meta_description')))
                                            @php($max = 170)
                                            @php($result = (100 / $max) * $length)
                                            @if($result < 1)
                                                @php($color = '#e8e8e8')
                                            @elseif($result <= 25)
                                                @php($color = '#f00')
                                            @elseif($result <= 50)
                                                @php($color = '#ff9900')
                                            @elseif($result <= 75)
                                                @php($color = '#00c4ff')
                                            @elseif($result <= 100)
                                                @php($color = '#51d842')
                                            @else
                                                @php($color = '#f00')
                                            @endif
                                            <span class="seo-icon" style="background-color: {{ $color }};"></span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if($pages->links())
                                <div class="pagination w-100 d-block">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="basic-datatables_info" role="status" aria-live="polite">
                                                {{ __('Showing ' . $pages->count() . ' of ' . $pages->total() . ' entries') }}
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="d-flex dataTables_paginate paging_simple_numbers justify-content-end">
                                                {{ $pages->links('dashboard.partials.pagination', ['posts' => $pages]) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </form>
                    @else
                        <p>{{ __('No any pages found at this time.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
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
            function updateActionControls() {
                var anyChecked = $('input[name="selects[]"]:checked').length > 0;
                $('.input-group-actions select, .input-group-actions button').prop('disabled', !anyChecked);
            }

            $('input[name="select_all"]').change(function() {
                var isChecked = $(this).prop('checked');
                $('input[name="selects[]"]').prop('checked', isChecked);
                updateActionControls();
            });

            $('input[name="selects[]"]').change(function() {
                var allChecked = $('input[name="selects[]"]:checked').length === $('input[name="selects[]"]').length;
                var anyChecked = $('input[name="selects[]"]:checked').length > 0;
                $('input[name="select_all"]').prop('checked', allChecked);
                updateActionControls();
            });

            updateActionControls();
        });
    </script>
    <script>
        function submitQuickAction() {
            var form = document.getElementById('quick-action');
            var action = document.querySelector('.bulk-actions').value;

            if (action && action !== 'Bulk Actions') {
                var actionInput = form.querySelector('input[name="action"]');
                if (!actionInput) {
                    actionInput = document.createElement('input');
                    actionInput.type = 'hidden';
                    actionInput.name = 'action';
                    form.appendChild(actionInput);
                }

                actionInput.value = action;

                form.submit();
            } else {
                alert('Please select a bulk action');
            }
        }

        function toggleApplyButton() {
            var selectElement = document.querySelector('.bulk-actions');
            var applyButton = document.querySelector('.submit-action');

            if (selectElement.value && selectElement.value !== 'Bulk Actions') {
                applyButton.disabled = false;
            } else {
                applyButton.disabled = true;
            }
        }

        document.querySelector('.bulk-actions').addEventListener('change', toggleApplyButton);
        document.addEventListener('DOMContentLoaded', toggleApplyButton);
    </script>
@endsection
