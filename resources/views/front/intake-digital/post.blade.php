@include('front.intake-digital.header')
    <section class="inner-hero">
        <img src="{{ asset($page->thumbnail) }}" alt="Internal Hero Image">
        <div class="container text-center">
            <h1 class="hero-title">{{ $page->name }}</h1>
            <div class="breadcrumbs">
                <ol>
                    @foreach($breadcrumbs as $breadcrumb)
                        <li>
                            @if($breadcrumb['url'])
                                <a href="{{ $breadcrumb['url'] }}"><span>{{ $breadcrumb['name'] }}</span></a>
                                <span class="separator">»</span>
                            @else
                                <span>{{ $breadcrumb['name'] }}</span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </section>
    <main class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-7 col-xl-8 col-xxl-9">
                    <div class="text">{!! $page->content !!}</div>
                    @if($page->tags)
                        <div class="tags mt-4">
                            <h4>Post Tags</h4>
                            <ul>
                                @foreach($page->tags as $tag)
                                    <li><a href="{{ getTagLink($tag->slug) }}" title="{{ $tag->name }}">{{ '#' . $tag->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(getPostCategories($page->id)->isNotEmpty())
                        <div class="category-posts mt-5">
                            <h4>This Article Categories</h4>
                            <div class="row">
                                @php $doubles = []; @endphp
                                @foreach(getPostCategories($page->id) as $cat)
                                    @if(getCategoryPosts($cat->id, $page->id, $doubles)->isNotEmpty())
                                        <div class="col-12">
                                            <h5 class="category-title">
                                                <a href="{{ getCategoryLink($cat->slug) }}" title="{{ $cat->name }}">{{ $cat->name }}</a>
                                            </h5>
                                            <div class="row">
                                                @foreach(getCategoryPosts($cat->id, $page->id, $doubles, 'created_at', 'DESC') as $catPost)
                                                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                                                        <a href="{{ getPostLink($catPost->slug) }}" class="post-item mb-4">
                                                            <div class="thumbnail">
                                                                @if($catPost->thumbnail)
                                                                    <img src="{{ asset($catPost->thumbnail) }}" alt="{{ $catPost->name }}" width="530" height="350">
                                                                @else
                                                                    <img src="{{ getThemeAssetsUri('/assets/images/svg/no-thumbnail.svg') }}" alt="{{ $catPost->name }}" width="530" height="350">
                                                                @endif
                                                            </div>
                                                            <div class="meta">
                                                                    <span class="category">
                                                                        @foreach(getPostCategories($catPost->id) as $category)
                                                                            {{ $category->name }}@if (!$loop->last), @endif
                                                                        @endforeach
                                                                    </span>
                                                                <span class="date">{{ getPostDate('F d, Y', $catPost->created_at) }}</span>
                                                            </div>
                                                            <h3 class="post-title">{{ $catPost->name }}</h3>
                                                        </a>
                                                    </div>
                                                    @php $doubles[] = $catPost->id; @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-12 col-lg-5 col-xl-4 col-xxl-3 mt-3 mt-xl-0">
                    <aside class="sidebar">
                        <div class="sidebar-widget">
                            <h4 class="widget-title mb-3">Contact Us</h4>
                            {!! getContactForm('Sidebar Form', '3') !!}
                        </div>
                        <div class="sidebar-widget">
                            <h4 class="widget-title mb-3">Related News</h4>
                            <div class="row">
                                @foreach (getRelatedPosts($page->id, 4, 'random') as $relPost)
                                    <div class="col-12 col-md-12 col-lg-12 col-xl-6 mb-4">
                                        <a href="{{ getPostLink($relPost->slug) }}" class="post-item mb-4">
                                            <div class="thumbnail">
                                                @if($relPost->thumbnail)
                                                    <img src="{{ asset($relPost->thumbnail) }}" alt="{{ $relPost->name }}" width="530" height="350">
                                                @else
                                                    <img src="{{ getThemeAssetsUri('/assets/images/svg/no-thumbnail.svg') }}" alt="{{ $relPost->name }}" width="530" height="350">
                                                @endif
                                            </div>
                                            <div class="meta">
                                            <span class="category">
                                                @foreach(getPostCategories($relPost->id) as $category)
                                                    {{ $category->name }}@if (!$loop->last), @endif
                                                @endforeach
                                            </span>
                                                <span class="date">{{ getPostDate('F d, Y', $relPost->created_at) }}</span>
                                            </div>
                                            <h3 class="post-title">{{ $relPost->name }}</h3>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
@include('front.intake-digital.footer')
