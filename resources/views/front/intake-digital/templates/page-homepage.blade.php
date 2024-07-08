@include('front.intake-digital.header')
    <section class="homepage-slider d-flex align-items-center">
        <div class="slider-pictures">
            <div class="swiper homepage-slider-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" data-type="ID Store" data-title="OUTRUN - Digitalism Vol.1" data-url="https://store.intakedigital.net/item/outrun-digitalism-vol-1/">
                        <a class="slide-inner" href="https://store.intakedigital.net/item/outrun-digitalism-vol-1/" target="_blank">
                            <img src="{{ getThemeAssetsUri('/assets/images/slide-01.jpg') }}" alt="Slide 01" width="1520" height="760">
                        </a>
                    </div>
                    <div class="swiper-slide" data-type="ZEN Task" data-title="ZEN Task BETA release" data-url="{{ url('/blog/news/zen-task-beta-release') }}">
                        <a class="slide-inner" href="{{ url('/blog/news/zen-task-beta-release') }}" target="_blank">
                            <img src="{{ getThemeAssetsUri('/assets/images/slide-02.jpg') }}" alt="Slide 02" width="1520" height="760">
                        </a>
                    </div>
                    <div class="swiper-slide" data-type="ID Store" data-title="Get new Figma template for dogotal streaming service" data-url="https://store.intakedigital.net/item/astra-music-app-figma-template/">
                        <a class="slide-inner" href="https://store.intakedigital.net/item/astra-music-app-figma-template/" target="_blank">
                            <img src="{{ getThemeAssetsUri('/assets/images/slide-03.jpg') }}" alt="Slide 03" width="1520" height="760">
                        </a>
                    </div>
                    <div class="swiper-slide" data-type="ID Engine" data-title="INTAKE Digital release first public version of new CMS - ID Engine" data-url="{{ url('/id-engine/') }}">
                        <a class="slide-inner" href="{{ url('/id-engine/') }}" target="_blank">
                            <img src="{{ getThemeAssetsUri('/assets/images/slide-04.jpg') }}" alt="Slide 04" width="1520" height="760">
                        </a>
                    </div>
                    <div class="swiper-slide" data-type="News" data-title="We launched our services. Whats next?" data-url="{{ url('/blog/news/we-launched-our-services-whats-next/') }}">
                        <a class="slide-inner" href="{{ url('/blog/news/we-launched-our-services-whats-next/') }}" target="_blank">
                            <img src="{{ getThemeAssetsUri('/assets/images/slide-05.jpg') }}" alt="Slide 05" width="1520" height="760">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-content">
            <span class="slide-type"></span>
            <h2 class="slide-title"></h2>
            <div class="slide-button">
                <a href="https://store.intakedigital.net/item/outrun-digitalism-vol-1/" target="_blank">
                    Check Now
                </a>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <section class="news-posts">
        <div class="container">
            <h2 class="title">News Posts</h2>
            @if(getPosts()->count())
                <div class="row">
                    @foreach(getPosts(null, 'created_at', 'ASC', null) as $post)
                        <div class="col-12 col-md-12 col-lg-6 col-xl-4 my-3">
                            <a href="" class="post-item">
                                <div class="thumbnail">
                                    <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->name }}" width="530" height="350">
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
                    <div class="col-12 pt-5 view-all">
                        <a href="{{ url('/blog/news/') }}">View All</a>
                    </div>
                </div>
            @else
                <p>No news posts available now.</p>
            @endif
        </div>
    </section>
    <section class="reviews">
        <div class="container">
            <h2 class="title">Reviews</h2>
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="swiper reviews-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="row reviews-slide">
                                    <div class="col-12 col-md-12 col-lg-3 col-xl-2 my-2">
                                        <div class="photo">
                                            <img src="{{ getThemeAssetsUri('/assets/images/review-photo.jpg') }}" alt="Review Photo" width="150" height="150">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-9 col-xl-10 my-2">
                                        <div class="review-text">
                                            <p>Vivamus euismod mauris. Quisque rutrum. Cras non dolor. Etiam ut purus mattis mauris sodales aliquam. Etiam sit amet orci eget eros faucibus tincidunt.</p>
                                            <p>Quisque id odio. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Fusce risus nisl, viverra et, tempor et, pretium in, sapien. Nam commodo suscipit quam. Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="row reviews-slide">
                                    <div class="col-12 col-md-12 col-lg-3 col-xl-2 my-2">
                                        <div class="photo">
                                            <img src="{{ getThemeAssetsUri('/assets/images/review-photo.jpg') }}" alt="Review Photo" width="150" height="150">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-9 col-xl-10 my-2">
                                        <div class="review-text">
                                            <p>Vivamus euismod mauris. Quisque rutrum. Cras non dolor. Etiam ut purus mattis mauris sodales aliquam. Etiam sit amet orci eget eros faucibus tincidunt.</p>
                                            <p>Quisque id odio. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Fusce risus nisl, viverra et, tempor et, pretium in, sapien. Nam commodo suscipit quam. Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="row reviews-slide">
                                    <div class="col-12 col-md-12 col-lg-3 col-xl-2 my-2">
                                        <div class="photo">
                                            <img src="{{ getThemeAssetsUri('/assets/images/review-photo.jpg') }}" alt="Review Photo" width="150" height="150">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-9 col-xl-10 my-2">
                                        <div class="review-text">
                                            <p>Vivamus euismod mauris. Quisque rutrum. Cras non dolor. Etiam ut purus mattis mauris sodales aliquam. Etiam sit amet orci eget eros faucibus tincidunt.</p>
                                            <p>Quisque id odio. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Fusce risus nisl, viverra et, tempor et, pretium in, sapien. Nam commodo suscipit quam. Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-form">
        <div class="container">
            <h2 class="title">Quick Contact</h2>
            <p class="subtitle">We will contact you as soon as possible</p>
        </div>
    </section>
@include('front.intake-digital.footer')
