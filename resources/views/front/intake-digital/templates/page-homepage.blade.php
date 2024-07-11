@include('front.intake-digital.header')
    <h1 style="display: none; opacity: 0; visibility: hidden;">INTAKE Digital Homeland</h1>
    <section class="homepage-slider d-flex align-items-center">
        <div class="slider-pictures">
            <div class="swiper homepage-slider-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" data-type="ID Store" data-title="OUTRUN - Digitalism Vol.1" data-url="https://store.intakedigital.net/item/outrun-digitalism-vol-1/">
                        <a class="slide-inner" href="https://store.intakedigital.net/item/outrun-digitalism-vol-1/" target="_blank">
                            <img src="{{ getThemeAssetsUri('/assets/images/slide-01.jpg') }}" alt="Slide 01" width="1520" height="760">
                        </a>
                    </div>
                    <div class="swiper-slide" data-type="ZEN Task" data-title="ZEN Task BETA release" data-url="{{ url('/blog/asana-killer-called-zen-is-available-to-free-testing-and-use') }}">
                        <a class="slide-inner" href="{{ url('/blog/asana-killer-called-zen-is-available-to-free-testing-and-use') }}">
                            <img src="{{ getThemeAssetsUri('/assets/images/slide-02.jpg') }}" alt="Slide 02" width="1520" height="760">
                        </a>
                    </div>
                    <div class="swiper-slide" data-type="ID Store" data-title="Get new Figma template for dogotal streaming service" data-url="https://store.intakedigital.net/item/astra-music-app-figma-template/">
                        <a class="slide-inner" href="https://store.intakedigital.net/item/astra-music-app-figma-template/" target="_blank">
                            <img src="{{ getThemeAssetsUri('/assets/images/slide-03.jpg') }}" alt="Slide 03" width="1520" height="760">
                        </a>
                    </div>
                    <div class="swiper-slide" data-type="ID Engine" data-title="INTAKE Digital release first public version of new CMS - ID Engine" data-url="{{ url('/id-engine-cms/') }}">
                        <a class="slide-inner" href="{{ url('/id-engine-cms/') }}">
                            <img src="{{ getThemeAssetsUri('/assets/images/slide-04.jpg') }}" alt="Slide 04" width="1520" height="760">
                        </a>
                    </div>
                    <div class="swiper-slide" data-type="News" data-title="AI techs integration in our most used Apps" data-url="{{ url('/blog/future-is-coming-ai-techs-will-be-integreated-in-our-most-used-apps') }}">
                        <a class="slide-inner" href="{{ url('/blog/future-is-coming-ai-techs-will-be-integreated-in-our-most-used-apps') }}">
                            <img src="{{ asset('/uploads/d4aad1bd01754bb890ad551162e72552.webp') }}" alt="Slide 05" width="1520" height="760">
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
                    @foreach(getPosts(null, 'created_at', 'DESC', null) as $post)
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
                    <div class="col-12 pt-5 view-all">
                        <a href="{{ url('/blog/') }}">View All</a>
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
                                            <img src="{{ asset('/uploads/steven-sharp.jpg') }}" alt="Review Photo" width="150" height="150">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-9 col-xl-10 my-2">
                                        <div class="review-text">
                                            <p>INTAKE Digital proved to be true professionals in their field. Their team developed a web platform for us that exceeded our expectations. They not only carefully listened to our requirements but also offered creative solutions that significantly enhanced our customer interactions. Thanks to INTAKE Digital, we were able to strengthen our market position and significantly increase our user base. Highly recommend their services!</p>
                                        </div>
                                        <div class="name">— Steven Sharp</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="row reviews-slide">
                                    <div class="col-12 col-md-12 col-lg-3 col-xl-2 my-2">
                                        <div class="photo">
                                            <img src="{{ asset('/uploads/david-mcfaul.jpg') }}" alt="Review Photo" width="150" height="150">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-9 col-xl-10 my-2">
                                        <div class="review-text">
                                            <p>INTAKE Digital delivered exactly what we needed. Their team's expertise and proactive approach ensured our project's success. We're impressed with the results and look forward to future collaborations.</p>
                                        </div>
                                        <div class="name">— David McFaul</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="row reviews-slide">
                                    <div class="col-12 col-md-12 col-lg-3 col-xl-2 my-2">
                                        <div class="photo">
                                            <img src="{{ asset('/uploads/eugene-stetsiuk.jpg') }}" alt="Review Photo" width="150" height="150">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-9 col-xl-10 my-2">
                                        <div class="review-text">
                                            <p>INTAKE Digital provided exceptional service. Their team's professionalism and innovative solutions were instrumental in achieving our project goals efficiently. We're grateful for their expertise and look forward to continuing our partnership.</p>
                                        </div>
                                        <div class="name">— Eugene Stetsiuk</div>
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
            <div class="form">
                {!! getContactForm('Homepage Form', '2', 'homepage-footer-form', 'homepage-footer-form row justify-content-center') !!}
            </div>
        </div>
    </section>
@include('front.intake-digital.footer')
