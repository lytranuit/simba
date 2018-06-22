
$(window).scroll();
jQuery(document).ready(function ($) {
    $("#contactForm").validate({
        highlight: function (input) {
            $(input).parents('.form-group').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-group').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function (form) {
            $.ajax({
                url: 'ajax/contactsubmit',
                data: $("#contactForm").serialize(),
                dataType: "JSON",
                type: "POST",
                success: function (data) {
                    var code = data.code;
                    var msg = data.msg;
                    alert(msg);
                    if (code == 400) {
                        $("#contactForm").trigger('reset');
                    }
                }
            });
            return false;
        }
    });
    var userAgent = navigator.userAgent || navigator.vendor || window.opera;
    // iOS detection from: http://stackoverflow.com/a/9039885/177710
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        $("#simba-app").attr("href", 'https://itunes.apple.com/vn/app/simba-fresh/id1331294173');
    } else {
        $("#simba-app").attr("href", 'https://play.google.com/store/apps/details?id=com.simba.fresh');
    }
    // Back to top button
    $(document).off("click", "#language a").on("click", "#language a", function (e) {
        e.preventDefault();
        var language = $(this).attr("data");
        $.ajax({
            url: 'ajax/setlanguage',
            data: {language: language},
            type: "POST",
            success: function () {
                location.reload();
            }
        });
    })
    $(".hc-tabs .nav-link").click(function () {
        var tab = $(this).attr("href");
        $(".hc-tabs-top img").hide();
        var img = $(".hc-tabs-top img[data-tab='" + tab + "']");
        img.fadeIn(1000)
    });
    $(".hc-tabs .nav-link.active").trigger("click")
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

    // Initiate the wowjs animation library
    // Helper function for add element box list in WOW
    WOW.prototype.addBox = function (element) {
        this.boxes.push(element);
    };

    // Init WOW.js and get instance
    var wow = new WOW({
        callback: function (el) {

        }
    });
    wow.init();
    // Initiate superfish on nav menu
    $('.nav-menu').superfish({
        animation: {
            opacity: 'show'
        },
        speed: 400
    });

    // Mobile Navigation
    if ($('#nav-menu-container').length) {
        var $mobile_nav = $('#nav-menu-container').clone().prop({
            id: 'mobile-nav'
        });
        var $button_login = $(".button_login").clone().wrap("<li></li>").parent();
        var $language = $("#language").clone().wrap("<li></li>").parent();
        $("ul", $mobile_nav).append($button_login).append($language);
        $mobile_nav.find('> ul').attr({
            'class': '',
            'id': ''
        });
        $('body').append($mobile_nav);
        $('#header').prepend('<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>');
        $('body').append('<div id="mobile-body-overly"></div>');
        $('#mobile-nav').find('.menu-has-children').prepend('<i class="fa fa-chevron-down"></i>');

        $(document).on('click', '.menu-has-children i', function (e) {
            $(this).next().toggleClass('menu-item-active');
            $(this).nextAll('ul').eq(0).slideToggle();
            $(this).toggleClass("fa-chevron-up fa-chevron-down");
        });

        $(document).on('click', '#mobile-nav-toggle', function (e) {
            $('body').toggleClass('mobile-nav-active');
            $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
            $('#mobile-body-overly').toggle();
        });

        $(document).click(function (e) {
            var container = $("#mobile-nav, #mobile-nav-toggle");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if ($('body').hasClass('mobile-nav-active')) {
                    $('body').removeClass('mobile-nav-active');
                    $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
                    $('#mobile-body-overly').fadeOut();
                }
            }
        });
    } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
        $("#mobile-nav, #mobile-nav-toggle").hide();
    }

    // Smooth scroll for the menu and links with .scrollto classes
    $(document).off("click", '.nav-menu a, #mobile-nav a, .scrollto').on('click', '.nav-menu a, #mobile-nav a, .scrollto', function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            if (target.length) {
                var top_space = 0;

                if ($('#header').length) {
                    top_space = $('#header').outerHeight();

                    if (!$('#header').hasClass('header-scrolled')) {
                        top_space = top_space + 60;
                    }
                }
                $('html, body').animate({
                    scrollTop: target.offset().top - top_space
                }, 1500, 'easeInOutExpo');

                if ($(this).parents('.nav-menu').length) {
                    $('.nav-menu .menu-active').removeClass('menu-active');
                    $(this).closest('li').addClass('menu-active');
                }

                if ($('body').hasClass('mobile-nav-active')) {
                    $('body').removeClass('mobile-nav-active');
                    $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
                    $('#mobile-body-overly').fadeOut();
                }
                return false;
            }
        }
    });

    // Header scroll class
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#header').addClass('header-scrolled');
//            if ($('#nav-menu-container').is(":visible") && $('#header #menu-nav').length == 0) {
//                var $menu_nav = $('#nav-menu-container').clone().prop({
//                    id: 'menu-nav'
//                }).addClass("hidden-md-down");
//                $('#header .container').append($menu_nav);
//            }
        } else {
            $('#header').removeClass('header-scrolled');
        }
    });

    // Intro carousel
    var introCarousel = $(".carousel");
    var introCarouselIndicators = $(".carousel-indicators");
    introCarousel.on('slide.bs.carousel', function (e) {
    });
    introCarousel.find(".carousel-inner").children(".carousel-item").each(function (index) {
        (index === 0) ?
                introCarouselIndicators.append("<li data-target='#introCarousel' data-slide-to='" + index + "' class='active'></li>") :
                introCarouselIndicators.append("<li data-target='#introCarousel' data-slide-to='" + index + "'></li>");

        $(this).css("background-image", "url('" + $(this).children('.carousel-background').children('img').attr('src') + "')");
        $(this).children('.carousel-background').remove();
    });

    $(".carousel").swipe({
        swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
            if (direction == 'left')
                $(this).carousel('next');
            if (direction == 'right')
                $(this).carousel('prev');
        },
        allowPageScroll: "vertical"
    });
//    $('.carousel').owlCarousel({
//        items: 1,
//        lazyLoad: true,
//        loop: true
//    });
    // Skills section
    $('#skills').waypoint(function () {
        $('.progress .progress-bar').each(function () {
            $(this).css("width", $(this).attr("aria-valuenow") + '%');
        });
    }, {offset: '80%'});

    // jQuery counterUp (used in Facts section)
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 1000
    });

    // Porfolio isotope and filter
    // var portfolioIsotope = $('.portfolio-container').isotope({
    //   itemSelector: '.portfolio-item',
    //   layoutMode: 'fitRows'
    // });

    $('#portfolio-flters li').on('click', function () {
        $("#portfolio-flters li").removeClass('filter-active');
        $(this).addClass('filter-active');

        portfolioIsotope.isotope({filter: $(this).data('filter')});
    });

    // Clients carousel (uses the Owl Carousel library)
    $(".clients-carousel").owlCarousel({
        autoplay: false,
        dots: false,
        loop: true,
        responsive: {0: {items: 2}, 768: {items: 4}, 900: {items: 6}}
    });

    $(".category-carousel").owlCarousel({
        autoplay: true,
        dots: true,
        loop: false,
        responsive: {0: {items: 2, slideBy: 2}, 768: {items: 3, slideBy: 3}, 900: {items: 3, slideBy: 3}}
    });

    // Testimonials carousel (uses the Owl Carousel library)
    $(".testimonials-carousel").owlCarousel({
        autoplay: true,
        dots: true,
        loop: true,
        items: 1
    });
    $("#button_login").click(function (e) {
        e.preventDefault();
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: path + "ajax/login",
            data: $("#form-login").serialize(),
            success: function (data) {
                if (data.success == 0) {
                    alert(data.msg);
                } else {
                    var role = data.role;
                    if (role == "1") {
                        location.href = path + "admin";
                    } else {
                        location.reload();
                    }
                }
            }
        });
        return false;
    })
});
