@extends('dashboard.layouts.app')

@section('title', __('Dashboard'))

@section('header-scripts')
    <style>
        .card-footer .btn.btn-round{
            padding: 0px 10px;
        }
        .card-footer .btn.btn-round::after{
            display: none;
        }
        .card-footer .btn.btn-round span{
            font-size: 22px;
            font-weight: 700;
        }
        .card-footer .dropdown-menu{
            border-radius: 8px;
        }
    </style>
@endsection

@section('content')
    <div class="page-header">
        <div class="row">
            <h3 class="fw-bold mb-3">{{ __('Dashboard') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All important data is here!') }}</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-6 col-xl-5">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Recent Posts') }}</div>
                </div>
                <div class="card-body">
                    @if($posts->isNotEmpty())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Title') }}</th>
                                    <th scope="col">{{ __('Date') }}</th>
                                    <th scope="col" style="text-align: center;">{{ __('Open') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td><a href="" title="{{ $post->name }}">{{ $post->name }}</a></td>
                                        <td>{{ date('M d, Y', strtotime($post->created_at)) . ' at ' . date('H:i', strtotime($post->created_at)) }}</td>
                                        <td style="text-align: center;"><a href="#" title="{{ __('Open Post To View') }}" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>{{ __('There is no any posts created yet.') }}</p>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span>{{ 'Total posts: ' . $posts->total() }}</span>
                    <div class="btn-group dropdown">
                        <button class="btn btn-primary dropdown-toggle btn-round" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span>+</span></button>
                        <ul class="dropdown-menu" role="menu" style="">
                            <li>
                                <a class="dropdown-item" href="{{ route('dash.posts') }}">{{ __('View All Posts') }}</a>
{{--                                <div class="dropdown-divider"></div>--}}
                                <a class="dropdown-item" href="{{ route('dash.posts.add') }}">{{ __('Create Post') }}</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-7">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Comments') }}</div>
                </div>
                <div class="card-body">
                    @if($comments->isNotEmpty())
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('Author') }}</th>
                                <th scope="col">{{ __('Comment') }}</th>
                                <th scope="col">{{ __('Date') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td><a href="{{ route('dash.users.edit', $comment->getAuthor()->id) }}" title="{{ $comment->getAuthor()->name }}">{{ $comment->getAuthor()->name }}</a></td>
                                    <td>{{ \Illuminate\Support\Str::limit($comment->comment, 80, '...') }}</td>
                                    <td>{{ date('M d, Y', strtotime($comment->created_at)) . ' at ' . date('H:i', strtotime($comment->created_at)) }}</td>
                                    <td>
                                        @if($comment->status == 1)
                                            <span class="badge badge-success">{{ __('Published') }}</span>
                                        @elseif($comment->status == 0)
                                            <span class="badge badge-danger">{{ __('Not Published') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>{{ __('There is no any comments created yet.') }}</p>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span>{{ 'Total comments: ' . $comments->total() }}</span>
                    <div class="btn-group dropdown">
                        <button class="btn btn-primary dropdown-toggle btn-round" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span>+</span></button>
                        <ul class="dropdown-menu" role="menu" style="">
                            <li>
                                <a class="dropdown-item" href="{{ route('dash.posts') }}">{{ __('View All Comments') }}</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Categories') }}</div>
                </div>
                <div class="card-body">
                    @if($categories->isNotEmpty())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col" style="text-align: center;">{{ __('Posts') }}</th>
                                    <th scope="col" style="text-align: center;">{{ __('Open') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td><a href="{{ route('dash.categories.edit', $category->id) }}" title="{{ $category->name }}">{{ $category->name }}</a></td>
                                        <td style="text-align: center;">{{ $category->getPosts()->count() }}</td>
                                        <td style="text-align: center;"><a href="#" title="{{ __('Open Category To View') }}" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>{{ __('There is no any comments created yet.') }}</p>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span>{{ 'Total comments: ' . $comments->total() }}</span>
                    <div class="btn-group dropdown">
                        <button class="btn btn-primary dropdown-toggle btn-round" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span>+</span></button>
                        <ul class="dropdown-menu" role="menu" style="">
                            <li>
                                <a class="dropdown-item" href="{{ route('dash.categories') }}">{{ __('View All Categories') }}</a>
                                <a class="dropdown-item" href="{{ route('dash.categories.add') }}">{{ __('Create Category') }}</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
@endsection
