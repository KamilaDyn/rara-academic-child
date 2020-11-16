jQuery(document).ready(function ($) {
    
    var slider_auto, slider_loop, slider_control, rtl, mrtl;


    if (rara_academic_data.auto == '1') {
        slider_auto = true;
    } else {
        slider_auto = false;
    }

    if (rara_academic_data.loop == '1') {
        slider_loop = true;
    } else {
        slider_loop = false;
    }

    if (rara_academic_data.control == '1') {
        slider_control = true;
    } else {
        slider_control = false;
    }


    if (rara_academic_data.rtl == '1') {
        rtl = true;
        mrtl = false;
    } else {
        rtl = false;
        mrtl = true;
    }

    $(".banner-slider").owlCarousel({
        loop: slider_loop,
        items: 1,
        autoplay: slider_auto,
        nav: slider_control,
        dots: true,
        // animateOut: 'slide',
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        autoplaySpeed: rara_academic_data.speed,
        navSpeed: rara_academic_data.a_speed,
        lazyLoad: true,
        rtl: rtl
    });
    /* Masonry for faq */
    if ($('.page-template-template-home').length > 0) {
        $('.services .row').imagesLoaded(function () {
            $('.services .row').masonry({
                itemSelector: '.col-3',
                isOriginLeft: mrtl
            });
        });
    }

    //mobile-menu
    var winWidth = $(window).width();
    if (winWidth < 1025) {
        $('.menu-opener').click(function () {
            $('body').addClass('menu-open');

            $('.btn-close-menu').click(function () {
                $('body').removeClass('menu-open');
            });

            $('.overlay').click(function () {
                $('body').removeClass('menu-open');
            });

        });

        $('.main-navigation').prepend('<div class="btn-close-menu">Close Menu</div>');

        $('.main-navigation ul .menu-item-has-children').append('<div class="angle-down"></div>');

        $('.main-navigation ul li .angle-down').click(function () {
            $(this).prev().slideToggle();
            $(this).toggleClass('active');
        });
    }

    if (winWidth > 1024) {
        $("#site-navigation ul li a").focus(function () {
            $(this).parents("li").addClass("focus");
        }).blur(function () {
            $(this).parents("li").removeClass("focus");
        });
    }


    $("#lightSlider").owlCarousel({
        items       : 1,
        margin: 0,
        dots      : true,
        nav: true,
        currentPagerPosition : 'middle',
        mouseDrag : false,
        loop   : true,
        rtl        : rtl
    });
    
    /* Masonry for faq */
    if( $('.page-template-template-home').length > 0 ){
        $('.services .row').imagesLoaded(function(){ 
            $('.services .row').masonry({
                itemSelector: '.col-3',
                isOriginLeft: mrtl
            }); 
        });
    }

    //mobile-menu
    var winWidth = $(window).width();
    if(winWidth < 1025){
        $('.menu-opener').click(function(){
            $('body').addClass('menu-open');

            $('.btn-close-menu').click(function(){
                $('body').removeClass('menu-open');
            });

            $('.overlay').click(function(){
                $('body').removeClass('menu-open');
            });

        });

        $('.main-navigation').prepend('<div class="btn-close-menu">Close Menu</div>');

        $('.main-navigation ul .menu-item-has-children').append('<div class="angle-down"></div>');

        $('.main-navigation ul li .angle-down').click(function(){
            $(this).prev().slideToggle();
            $(this).toggleClass('active');
        });
    }

    if(winWidth > 1024){
        $("#site-navigation ul li a").focus(function(){
            $(this).parents("li").addClass("focus");
        }).blur(function(){
            $(this).parents("li").removeClass("focus");
       });
    }

    if ( $('#comments').children().length > 0 ) {
        $('#comments').css('display', 'block')
   }

});


