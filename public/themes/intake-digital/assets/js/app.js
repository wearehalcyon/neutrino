'use strict';

jQuery(document).ready(function($){
    var swiper = new Swiper(".homepage-slider-container", {
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
});
