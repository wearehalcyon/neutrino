'use strict';

jQuery(document).ready(function($){
    var swiper = new Swiper(".homepage-slider-container", {
        spaceBetween: 30,
        autoplay: true,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    swiper.on('slideChange', function () {
        var activeSlide = swiper.slides[swiper.activeIndex];
        var slideType = $(activeSlide).data('type');
        var slideTitle = $(activeSlide).data('title');
        var slideLink = $(activeSlide).data('url');
        $('.slider-content .slide-type').text(slideType);
        $('.slider-content .slide-title').text(slideTitle);
        $('.slider-content .slide-button a').attr('href', slideLink);
    });

    var initialActiveSlide = swiper.slides[swiper.activeIndex];
    var initialType = $(initialActiveSlide).data('type');
    var initialTitle = $(initialActiveSlide).data('title');
    var initialLink = $(initialActiveSlide).data('url');
    $('.slider-content .slide-type').text(initialType);
    $('.slider-content .slide-title').text(initialTitle);
    $('.slider-content .slide-button a').attr('href', initialLink);
});
