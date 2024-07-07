@include('front.intake-digital.header')
    <section class="homepage-slider">
        <div class="slider-pictures">
            <div class="swiper homepage-slider-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a class="slide-inner" href="https://store.intakedigital.net/item/outrun-digitalism-vol-1/" target="_blank">
                            <img src="{{ getThemeAssetsUri('/assets/images/slide-01.jpg') }}" alt="Slide 01" width="1520" height="760">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="sliser-content">
            <div class="swiper-pagination"></div>
        </div>
    </section>
@include('front.intake-digital.footer')
