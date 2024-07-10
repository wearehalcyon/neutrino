@extends('dashboard.layouts.app')

@section('title', __('Posts'))

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
            <h3 class="fw-bold mb-3">{{ __('All Posts') }}</h3>
            <h6 class="op-7 mb-2">{{ __('All site posts is here!') }}</h6>
        </div>
    </div>

    <div class="card-action mb-4">
        <a href="{{ route('dash.posts.add') }}" class="btn btn-primary">{{ __('Create New Post') }}</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-flex align-items-center justify-content-between">
                        <span>
                            {{ __('Posts List') }}
                            @if($posts->isNotEmpty())
                                <strong>({{ $posts->total() }})</strong>
                            @endif
                        </span>
                        <div class="form-groups">
                            <div class="form-group">
                                <form action="{{ route('dash.posts') }}" method="get" class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="{{ __('Search posts...') }}" value="{{ request()->input('search') }}">
                                    <button type="submit" class="input-group-text">{{ __('Find') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('dash.posts.quickaction') }}" method="post" class="card-body">
                    @if($posts->isNotEmpty())
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                {{--                                <th scope="col" style="width: 50px;">ID</th>--}}
                                <th scope="col" style="width: 20px;">
                                    <input type="checkbox" name="select_all" style="width: 14px; height: 14px;">
                                </th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Categories') }}</th>
                                <th scope="col">{{ __('Tags') }}</th>
                                <th scope="col">{{ __('Created At') }}</th>
                                <th scope="col">{{ __('Author') }}</th>
                                <th scope="col" style="text-align: center;">{{ __('SEO') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        {{--                                    <td>{{ $post->id }}</td>--}}
                                        <td><input type="checkbox" name="selects[]" value="{{ $post->id }}" style="width: 14px; height: 14px;"></td>
                                        <td class="editable">
                                            <a href="{{ route('dash.posts.edit', $post->id) }}" title="{{ $post->name }}">{{ $post->name }}</a>@if($post->status == 2) <strong>{{ __('— Draft') }}</strong> @endif
                                            <div class="post-actions">
                                                <ul>
                                                    <li><a href="{{ route('dash.posts.edit', $post->id) }}" title="{{ __('Edit') }}">{{ __('Edit') }}</a></li>
                                                    <li class="separator">|</li>
                                                    <li><a class="link-danger delete" href="{{ route('dash.posts.delete', $post->id) }}" title="{{ __('Delete') }}">{{ __('Delete') }}</a></li>
                                                    <li class="separator">|</li>
                                                    <li><a href="{{ route('pages.blog.post', $post->slug) }}" title="{{ __('View') }}" target="_blank">{{ __('View') }}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            @if($post->categories->isNotEmpty())
                                                @foreach($post->categories as $index => $category)
                                                    <a href="{{ route('dash.categories.edit', $category->id) }}" title="{{ $category->name }}">{{ $category->name }}</a>{{ $index < $post->categories->count() - 1 ? ', ' : '' }}
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($post->tags->isNotEmpty())
                                                @foreach($post->tags as $index => $tag)
                                                    <a href="{{ route('dash.tags.edit', $tag->id) }}" title="{{ $tag->name }}">{{ '#' . $tag->name }}</a>{{ $index < $post->tags->count() - 1 ? ', ' : '' }}
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ date('M d, Y', strtotime($post->created_at)) . ' at ' . date('H:i:s', strtotime($post->created_at)) }}</td>
                                        <td>{{ $post->getAuthor()->name }}</td>
                                        <td style="text-align: center;">
                                            @php($length = \Illuminate\Support\Str::length($post->getPostMeta('meta_description')))
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
                        @if($posts->links())
                            <div class="pagination w-100 d-block">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="basic-datatables_info" role="status" aria-live="polite">
                                            {{ __('Showing ' . $posts->count() . ' of ' . $posts->total() . ' entries') }}
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="d-flex dataTables_paginate paging_simple_numbers justify-content-end">
                                            {{ $posts->links('dashboard.partials.pagination', ['posts' => $posts]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <p>{{ __('No any posts found at this time.') }}</p>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
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
