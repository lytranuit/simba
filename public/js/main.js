
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
//            $(element).parents('.form-group').append(error);
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
                        grecaptcha.reset();
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
    $(document).keyup(function (e) {
        if (e.which == 13 && $("#login-modal").is(":visible")) {
            $("#button_login").trigger("click");
        }
    })
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
        var $hr = $("<li class='dropdown-divider'></li>");
        var $web_oishii = $("#oishii-web").clone().removeClass().wrap("<li></li>").parent();
        var $app_simba = $("#simba-app").clone().removeClass().wrap("<li></li>").parent();
        var $button_login = $(".button_login").first().clone().wrap("<li></li>").parent();
        var $logout = "";
        if ($(".logged").length) {
            $(".button_login", $button_login).removeAttr("data-toggle");
            $logout = $(".logout").first().clone().wrap("<li></li>").parent();
        }
        var $language = $("#language").clone().wrap("<li></li>").parent();
        $("ul", $mobile_nav).append($hr.clone()).append($app_simba).append($web_oishii).append($hr).append($button_login).append($logout).append($language);
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
                    top_space += $('#menu').outerHeight();
                    if (!$('#header').hasClass('header-scrolled')) {
                        top_space = top_space + 100;
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
            $('#header,#menu').addClass('header-scrolled');
//            if ($('#nav-menu-container').is(":visible") && $('#header #menu-nav').length == 0) {
//                var $menu_nav = $('#nav-menu-container').clone().prop({
//                    id: 'menu-nav'
//                }).addClass("hidden-md-down");
//                $('#header .container').append($menu_nav);
//            }
        } else {
            $('#header,#menu').removeClass('header-scrolled');
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
    var start = Math.ceil($(".clients-carousel a").length / 2) - 1;
    $(".clients-carousel").owlCarousel({
        autoplay: false,
        dots: false,
        startPosition: start,
        center: true,
        responsive: {0: {items: 2}, 768: {items: 4}, 900: {items: 6}}
    });

    $(".category-carousel").owlCarousel({
        autoplay: true,
        dots: true,
        loop: false,
        margin: 15,
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
        var callback = $(document).data('callback');
        var param = $(document).data("param");
        $.ajax({
            dataType: "JSON",
            type: "POST",
            url: path + "ajax/login",
            data: $("#form-login").serialize(),
            success: function (data) {
                if (data.success == 0) {
                    alert(data.msg);
                } else {
                    var username = data.username;
                    var $button_login = $(".button_login");
                    $button_login.addClass("logged").removeAttr("data-target").attr("data-toggle", "dropdown").attr("id", "navbarDropdownMenuLink");
                    $("#mobile-nav .button_login").removeAttr("data-toggle");
                    $logout = $(".logout").first().clone().wrap("<li></li>").parent();
                    $("#mobile-nav .button_login").parent().after($logout);
                    $("span", $button_login).text(username);
                    $('.modal').modal('hide');
                    if (typeof callback === "function") {
                        callback(param);
                    } else {
                        var role = data.role;
                        if (role == "1") {
                            location.href = path + "admin";
                        }
                    }
                }
            }
        });
        return false;
    });
    $("#advanced_comment").click(function (e) {
        e.preventDefault();
        if ($(".logged").length) {

        } else {
            $(document).data("callback", click_gopy);
            $(".button_login").trigger("click");
            return false;
        }
    });
    $(".files").click(function (e) {
        e.preventDefault();
        var id = $(this).attr("data");
        if ($(".logged").length) {
            download_file(id);
        } else {
            $(document).data("param", id);
            $(document).data("callback", download_file);
            $(".button_login").trigger("click");
            return false;
        }
    })
    $("#tintuc").on("click", "a.page-link", function (e) {
        e.preventDefault();
        var page = $(this).text();
        load_page_news(page);
    });
    $("#tintuc .button_search").click(function () {
        load_page_news();
    });
    $("#tintuc .input_search").keyup(function (e) {
        if (e.keyCode == 13) {
            load_page_news();
        }
    });
    $("#product").on("click", "a.page-link", function (e) {
        e.preventDefault();
        var page = $(this).text();
        load_page_product(page);
    });
    $("#product .button_search").click(function () {
        load_page_product();
    });
    $("#product .input_search").keyup(function (e) {
        if (e.keyCode == 13) {
            load_page_product();
        }
    });
    load_page_news();
    load_page_product();
});

function load_page_news(page = 1) {
    var search = $("#tintuc .input_search").val();
    var data = {page: page, search: search};
    $.ajax({
        dataType: "HTML",
        url: path + "ajax/news",
        data: data,
        success: function (data) {
            $("#tintuc .data").html(data);
        }
    });
}

function load_page_product(page = 1) {
    var search = $("#product .input_search").val();
    var data = {page: page, search: search};
    $.ajax({
        dataType: "HTML",
        url: path + "ajax/product",
        data: data,
        success: function (data) {
            $("#product .data").html(data);
        }
    });
}
function click_gopy(...param) {
    $("#advanced_comment").trigger("click");
}
function download_file(...param) {
    var id = param[0];
    location.href = path + "ajax/downloadfile?id=" + id
}