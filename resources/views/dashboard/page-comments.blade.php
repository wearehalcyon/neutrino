@extends('dashboard.layouts.app')

@section('title', __('Comments'))

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
            <h3 class="fw-bold mb-3">{{ __('All Comments') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All site posts comments is here!') }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Comments List') }}
                        @if($comments->isNotEmpty())
                            <strong>({{ $comments->total() }})</strong>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if($comments->isNotEmpty())
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 100px;">ID</th>
                                <th scope="col">{{ __('Author') }}</th>
                                <th scope="col">{{ __('Comment') }}</th>
                                <th scope="col" style="min-width: 200px;">{{ __('In Response To') }}</th>
                                <th scope="col" style="min-width: 150px;">{{ __('Date') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                                <th scope="col" style="min-width: 200px;">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td><a href="{{ route('dash.users.edit', $comment->getAuthor()->id) }}" title="{{ $comment->getAuthor()->name }}">{{ $comment->getAuthor()->name }}</a></td>
                                    <td>{{ $comment->comment }}</td>
                                    <td></td>
                                    <td>{{ date('M d, Y', strtotime($comment->created_at)) . ' at ' . date('H:i:s', strtotime($comment->created_at)) }}</td>
                                    <td>
                                        @if($comment->status == 1)
                                            <span class="badge badge-success">{{ __('Published') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('Not Published') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <select name="status" class="form-select form-control update-comment" data-route="{{ route('dash.comments.update', $comment->id) }}">
                                            <option value="1" @if($comment->status == 1) selected @endif>{{ __('Approved') }}</option>
                                            <option value="0" @if($comment->status == 0) selected @endif>{{ __('Not Published') }}</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if($comments->links())
                            <div class="pagination w-100 d-block">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="basic-datatables_info" role="status" aria-live="polite">
                                            {{ __('Showing ' . $comments->count() . ' of ' . $comments->total() . ' entries') }}
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="d-flex dataTables_paginate paging_simple_numbers justify-content-end">
                                            {{ $comments->links('dashboard.partials.pagination', ['posts' => $comments]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <p>{{ __('No any comments created yet.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        $('.update-comment').on('change', function(event){
            event.preventDefault();

            let route = $(this).data('route'),
                value = $(this).val();

            window.location.href = route + '?value=' + value;
        });
    </script>
@endsection
