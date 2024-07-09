'use strict';

jQuery(document).ready(function($){
    // Homepage hero slide
    let swiperHeroHomepage = new Swiper(".homepage-slider-container", {
        spaceBetween: 30,
        autoplay: true,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    swiperHeroHomepage.on('slideChange', function () {
        let activeSlide = swiperHeroHomepage.slides[swiperHeroHomepage.activeIndex];
        let slideType = $(activeSlide).data('type');
        let slideTitle = $(activeSlide).data('title');
        let slideLink = $(activeSlide).data('url');
        $('.slider-content .slide-type').text(slideType);
        $('.slider-content .slide-title').text(slideTitle);
        $('.slider-content .slide-button a').attr('href', slideLink);
    });

    let initialActiveSlide = swiperHeroHomepage.slides[swiperHeroHomepage.activeIndex];
    let initialType = $(initialActiveSlide).data('type');
    let initialTitle = $(initialActiveSlide).data('title');
    let initialLink = $(initialActiveSlide).data('url');
    $('.slider-content .slide-type').text(initialType);
    $('.slider-content .slide-title').text(initialTitle);
    $('.slider-content .slide-button a').attr('href', initialLink);

    // Homepage reviews slider
    let swiperReviewsHomepage = new Swiper(".reviews-slider", {
        spaceBetween: 30,
        autoplay: true,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    // Mobile menu
    $('.mobile-button .open-mobile').on('click', function(event){
        event.preventDefault();

        if (!$('.mobile-menu').hasClass('show')) {
            $('.mobile-menu').addClass('show');
        } else {
            $('.mobile-menu').removeClass('show');
        }
    });
});
