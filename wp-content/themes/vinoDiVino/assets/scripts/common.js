function getScrollbarWidth() {
    // Creating invisible container
    var outer = document.createElement('div');
    outer.style.visibility = 'hidden';
    outer.style.overflow = 'scroll'; // forcing scrollbar to appear
    outer.style.msOverflowStyle = 'scrollbar'; // needed for WinJS apps
    document.body.appendChild(outer);
    // Creating inner element and placing it in the container
    var inner = document.createElement('div');
    outer.appendChild(inner);
    // Calculating difference between container's full width and the child width
    var scrollbarWidth = (outer.offsetWidth - inner.offsetWidth);
    // Removing temporary elements from the DOM
    outer.parentNode.removeChild(outer);
    return scrollbarWidth;
}

$(function(){
    // console.log('loading..');
 
    // preloader blur effect add
    // $('.header, .main, .footer').addClass('blur');


    // if img have mobile src -- add it to main src
    if ($(window).width() <= 1024) {
        $('img[mob-src]').each(function() {
            var srcMob = $(this).attr('mob-src');

            $(this).attr('src', srcMob);
        });
    }

    $(document).ready(function() {
    
        var scrollWidth = getScrollbarWidth();
        
        // preloader blur effect remove
        // $('.header, .main, .footer').removeClass('blur');



        // header contacts dropdown list
        $('.header__contacts').on('click', '.btn', function(e) {
            e.preventDefault();

            $(this).toggleClass('opened').siblings('.header__cont-list').toggleClass('opened');
        });
        $('.header__cont-list').on('click', '.btn', function(e) {
            e.preventDefault();
            $('.header__cont-list, .header__contacts .btn').removeClass('opened');
        })



        // burger menu
        $(document).on('click', '.header__burger, .modal__shadow--main', function(e) {
            e.preventDefault();

            $(this).toggleClass('toggled');
            $('.header__content').toggleClass('toggled').css('top', $('.header').innerHeight() );
            $('.main').toggleClass('opened-menu');
            $('body').toggleClass('body-fixed');
            $('.header, .main section, .footer').css('padding-right', scrollWidth);
            $('.modal__shadow--main').fadeToggle(400);
        });
        $(document).on('click', '.header__burger.toggled', function() {
            $('.header, .main section, .footer').css('padding-right', 0);
        });
        // $('.modal__shadow--main').click(function() {
        //     $(this).fadeToggle(400);
        // })
        

        // add text to data attr for css features of animations with pseudoEl "after"
        $('.btn').each(function() {
            $(this).attr('data-text', $(this).text());
        });

        // sticky header after scroll
        $(window).on('load scroll', function () {

            if ( $(window).scrollTop() > $('.header').innerHeight() ) {
                $('.header').addClass('sticky');
            } else {
                $('.header').removeClass('sticky');
            }
        });

        // scroll to block via hash in link
        $(document).on('click', 'a[href*="#"]', function(event) {
        
            // scroll to block via hash in link
            var target = $(this).attr('href');
            // console.log(target);

            if( target.length && target != "#") {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: $(target).offset().top - $('.header').innerHeight()
                }, 800);
            }
        });




        // scroll to next block or section
        $('.scroll-next').each(function() {

            var nextElementOffset = $(this).parents('.section, section').next().offset().top;

            $(this).on('click', function(e) {
                e.preventDefault();
                $('html,body').animate({
                    scrollTop: nextElementOffset - $('.header').innerHeight()
                }, 800);
            })
        });

        // detect function if block is visible on screen when i scroll
        $.fn.isInViewport = function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height() / 2;
            
            return elementBottom >= viewportTop && elementTop <= viewportBottom;
        };

        // init active slide nav item when page has loaded
        $('.current-block__index').eq(0).addClass('current');
        // sections navigation color when page has loaded
        if ( ($(window).scrollTop() * 2) >= $(window).height() ) {
            sectionsNav.attr('data-color', '');
            // console.log(true); 
        };
        
        $('.faq__item').on('click', '.faq__quest', function() {
            $(this).toggleClass('opened').parent().toggleClass('active').find('.faq__answ')
            .slideToggle(400);
            // .fadeToggle(400);
        })


        // init animation if block is visible in window
        AOS.init({
            disable: 'phone',
            duration: 1200,
        });
    })

})