@include('front.intake-digital.header')
<section class="inner-hero">
    <img src="{{ getThemeAssetsUri('/assets/images/hero/hero-0' . rand(1, 9) . '.jpg') }}" alt="Internal Hero Image">
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
        @if(getPosts()->count())
            <div class="row">
                @foreach(getPosts(null, 'created_at', 'ASC', null) as $post)
                    <div class="col-12 col-md-12 col-lg-6 col-xl-4 my-3">
                        <a href="{{ getPostLink($post->slug) }}" class="post-item">
                            <div class="thumbnail">
                                @if($post->thumbnail)
                                    <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->name }}" width="530" height="350">
                                @else
                                    <img src="{{ getThemeAssetsUri('/assets/images/svg/no-thumbnail.svg') }}" alt="{{ $post->name }}" width="530" height="350">
                                @endif
                            </div>
                            <div class="meta">
                                    <span class="category">
                                        @foreach(getPostCategories($post->id) as $category)
                                            {{ $category->name }}@if (!$loop->last), @endif
                                        @endforeach
                                    </span>
                                <span class="date">{{ getPostDate('F d, Y', $post->created_at) }}</span>
                            </div>
                            <h3 class="post-title">{{ $post->name }}</h3>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p>No news posts available now.</p>
        @endif
    </div>
</main>
@include('front.intake-digital.footer')
