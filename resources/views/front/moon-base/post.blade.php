@include('front.moon-base.header')
    <section class="post-hero">
        <div class="hero-inner">
            <h1 class="title">{{ $page->name }}</h1>
            <span class="date">{{ getPostDate('F d, Y', $page->created_at) }}</span>
            <p class="author mt-1">Author: <strong>{{ getAuthor($page->author_id)->name }}</strong></p>
            <p class="author">
                Categories:
                @foreach(getPostCategories($page->id) as $category)
                    <a href="{{ getCategoryLink($category->slug) }}" title="{{ $category->name }}"><strong>{{ $category->name }}</strong></a>
                @endforeach
            </p>
        </div>
    </section>
    <section class="breadcrumbs mt-4">
        <div class="container">
            <ol>
                @foreach($breadcrumbs as $breadcrumb)
                    <li>
                        @if($breadcrumb['url'])
                            <a href="{{ $breadcrumb['url'] }}"><span>{{ $breadcrumb['name'] }}</span></a>
                        @else
                            <span>{{ $breadcrumb['name'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    </section>
    <section class="post-content my-5 py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 my-3">
                    <div class="post-content">{!! $page->content !!}</div>
                </div>
                <div class="col-md-12 col-lg-4 my-3">
                    <div class="sidebar">
                        <div class="widget">
                            <h4 class="widget-title">Related Posts</h4>
                            <ul>
                                @foreach(getRelatedPosts() as $post)
                                    <li>
                                        <a href="{{ getPermalink('post', $post->id) }}" title="{{ $post->name }}">{{ $post->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@include('front.moon-base.footer')
