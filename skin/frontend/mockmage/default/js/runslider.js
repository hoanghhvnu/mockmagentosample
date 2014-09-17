$(function(){
    var featuredSwiper = $('.featured').swiper({
        slidesPerView: 5,
        loop: true,
        autoplay: 1000
    });

    //Thumbs
    $('.slider').each(function(){
        $(this).swiper({
            autoplay: 1000
        })
    })
});