    // var lazy   = true,
    //     fade   = false,
    //     effect = 'fade';
    if ($('.gallery__preview').length > 0) {
        var counts = 6,
            lazy   = true,
            fade   = true,
            effect = 'fade';
    } else {
        counts = 4;
        effect = 'none';
        var slidesProgress = true;
        var init = false;
        if ($(window).width() < 480) {
            // newsThumbs.destroy();
        }
    }
    var newsThumbs = new Swiper('.news-slider__thumb, .gallery__thumb', {
        init: true,
        speed: 1500,
        // loop: true,
        loopFillGroupWithBlank: true,
        slidesPerView: counts,
        observer: true,
        watchSlidesProgress: slidesProgress,
        breakpoints: {
            760: {
                slidesPerView: 3
            },
            570: {
                slidesPerView: 2
            },
            // 480: {
            //     init: init
            // }
        }
        // effect: 'fade'
    });

    var newsPreview = new Swiper('.slider-top', {
        speed: 1500,
        loop: true,
        loopFillGroupWithBlank: true,
        slidesPerView: 1,
        autoplay: {
            delay: 4000
        },
        observer: true,
        lazy: {
            loadPrevNext: lazy
        },
        fadeEffect: {
            crossFade: fade
        },
        effect: effect,
        thumbs: {
            swiper: newsThumbs
        },
        // pagination: {
        //     el: '.swiper-pagination',
        //     type: 'fraction',
        // },
        breakpoints: {
            // 570: {
            //     thumbs: {
            //         swiper: init
            //     },
            // },
        }
    });