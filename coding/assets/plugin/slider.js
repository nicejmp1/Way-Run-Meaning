
var swiper = new Swiper('.swiper-container.two', {
    pagination: '.swiper-pagination',
    paginationClickable: true,
    loop: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    effect: 'coverflow',
    coverflowEffect: {
        rotate: 0,
        depth: 100,
        slideShadows: true,
        stretch: 100,
        scale: 0.8
    },
    autoplay: {
        delay: 2000,
    }
});
