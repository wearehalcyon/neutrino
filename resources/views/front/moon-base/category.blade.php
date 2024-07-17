@include('front.moon-base.header')
<section class="post-hero">
    <div class="hero-inner">
        <h1 class="title">{{ $page->name }}</h1>
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
<section class="post-content my-3 py-3">
    <div class="container">
        <div class="row">
            @foreach(getPosts() as $post)
                <div class="col-md-12 col-lg-6 col-xl-4 my-3">
                    <a href="{{ getPermalink('post', $post->id) }}" class="post-card" title="{{ $post->name }}">
                        <h4>{{ $post->name }}</h4>
                        <div class="date">{{ getPostDate('F d, Y', $post->created_at) }}</div>
                        <div class="author mt-1">Author: <strong>{{ getAuthor($page->author_id)->name }}</strong></div>
                        <hr>
                        <div class="excerpt">{{ getExcerpt($post->content, 100, '...') }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@include('front.moon-base.footer')
