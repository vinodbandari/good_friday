/******************
 * Vinova Themes  Framework for Prestashop 1.7.x
 * @package    Nova - PrestaShop 1.7 Theme For Fashion Templates
 * @version    1.0
 * @author    http://vinovathemes.com/
 * @copyright  Copyright (C) October 2013 vinovathemes.com <@emai:vinovathemes@gmail.com>
 * <info@vinovathemes.com>.All rights reserved.
 * @license   GNU General Public License version 1
 * *****************/
(function ($) {
    $.cookie = function (key, value, options) {
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
            options = $.extend({}, options);
            if (value === null || value === undefined) {
                options.expires = -1
            }
            if (typeof options.expires === 'number') {
                var days = options.expires,
                        t = options.expires = new Date();
                t.setDate(t.getDate() + days)
            }
            value = String(value);
            return (document.cookie = [encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value), options.expires ? '; expires=' + options.expires.toUTCString() : '', options.path ? '; path=' + options.path : '', options.domain ? '; domain=' + options.domain : '', options.secure ? '; secure' : ''].join(''))
        }
        options = value || {};
        var decode = options.raw ? function (s) {
            return s
        } : decodeURIComponent;
        var pairs = document.cookie.split('; ');
        for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
            if (decode(pair[0]) === key)
                return decode(pair[1] || '')
        }
        return null
    }
})(jQuery);
if ((typeof novtheme) === 'undefined') {
    novtheme = {};
}
//When hover Cat in desktop
$('#_desktop_cart').hover(function () {
    $('.cart_block').addClass('hover-active');
}, function () {
    $('.cart_block').removeClass('hover-active');
});
var novtheme_current_width = $(window).innerWidth();
var novtheme_min_width = 768;
var novtheme_min_width_ipad = 992;
var novtheme_responsive_mobile = novtheme_current_width < novtheme_min_width;
var novtheme_responsive_ipad = novtheme_current_width < novtheme_min_width_ipad;
$(".header-top_text .zmdi-close").click(function () {
    $(".header-top_text").slideToggle("slow");
});
//   search------------
function Header_top() {
    if (localStorage.getItem('Header_top')) {
        $('.header-top_text').attr('class', localStorage.getItem('Header_top'));
    }
    $('.header-top_text .zmdi-close').click(function () {
        $(this).parent().slideUp(300).removeClass('active');
        localStorage.setItem('Header_top', $('.header-top_text').attr('class'));
    })
    localStorage.removeItem("Header_top");
    $(window).on('load', function () {
        setTimeout(function () {
            $('.header-top_text').addClass('active');
        }, 3600000);
    });
}


//Go to top
function goToTop() {
    var timer;
    $(window).scroll(function () {
        if (timer)
            clearTimeout(timer)
        timer = setTimeout(function () {
            if ($(window).scrollTop() >= 200) {
                $('#_desktop_back_top').fadeIn();
            } else {
                $('_desktop_back_top').fadeOut();
            }
        }, 300);

    });
    $("#back-top").click(function () {
        $("body,html").animate({scrollTop: 0}, "normal");
        return!1
    });
}
//Popup newsletter
function PopupNewletter() {
    var date = new Date();
    var minutes = 60;
    date.setTime(date.getTime() + (minutes * 60 * 1000));
    if ($.cookie('popupNewLetterStatus') != 'closed' && $('body').outerWidth() > 768) {
        $("#popup-subscribe").modal({
            show: !0
        });
    }
    $.cookie("popupNewLetterStatus", "closed", {
        'expires': date,
        'path': '/'
    })
    $('input.no-view').change(function () {
        if ($('input.no-view').prop("checked") == 1) {
            $.cookie("popupNewLetterStatus", "closed", {
                'expires': date,
                'path': '/'
            })
        } else {
            $.cookie("popupNewLetterStatus", "", {
                'expires': date,
                'path': '/'
            })
        }
    })
}
if ($("#popup-subscribe").length) {
    $(window).load(function () {
        var timer = window.setTimeout(PopupNewletter, 8000);
    });
}
function RunInstagram() {
    var winHeight = $(window).height();
    var Event = false,
            offset_top = $('.nov-image-centered').offset().top,
            distance = offset_top - winHeight;
    $(window).on('scroll', function () {
        var currentPosition = $(document).scrollTop();
        if (currentPosition > distance && Event === false) {
            Event = true;
            setTimeout(function () {
                $('.nov-image-centered').addClass('ins-animate');
            }, 1000);
        }
    });
}
function Load_canvas_menu() {
    var $main_menu = $(".level1", "#megamenu");
    if (current_width < 768) {
        if ($("#canvas-main-menu").length < 1 && $main_menu.length > 0) {
            var $menu = $main_menu.parent().clone();
            $menu.attr("id", "canvas-main-menu");
            $($menu).find(".menu").removeAttr('id');
            $('.canvas-menu').append($menu);
            $menu.mmenu({
                offCanvas: false,
                "navbar": {
                    "title": false
                }
            });
            remove_canvas_menu();
        }
    }
}
function click_button_canvas_menu() {
    $('#_mobile_menutop').on("click", function () {
        if ($('.canvas-menu').hasClass('active')) {
            $('.canvas-menu').removeClass('active');
            $('body').removeClass('canvasmenu-right');
            $(this).removeClass('close');
        } else {
            $('.canvas-menu').addClass('active');
            $('body').addClass('canvasmenu-right');
            $(this).addClass('close');
        }
        return false;
    });
}
function remove_canvas_menu() {
    $('.canvas-header-box .close-box, .canvas-overlay').on("click", function () {
        $('.canvas-menu').removeClass('active');
        $('body').removeClass('canvasmenu-right');
        return false;
    });
}
function NovMegamenuToggle() {
    $('.toggle-megamenu').on("click", function () {
        if ($('.menu-style2').hasClass('active')) {
            $('.menu-style2').removeClass('active');
            $('body').removeClass('canvasmenu-right');
            $(this).removeClass('menu_close');
        } else {
            $('.menu-style2').addClass('active');
            $('body').addClass('canvasmenu-right');
            $(this).addClass('menu_close');
        }
        return false;
    });
    $('.menu_close .zmdi-close, .canvas-overlay').on("click", function () {
        $('.menu-style2').removeClass('active');
        $('body').removeClass('canvasmenu-right');
        return false;
    });
    $('.menu_left .toggle-megamenu').on("click", function () {
        if ($('.menu_vertical').hasClass('active')) {
            $('.menu_vertical').removeClass('active');
            $('body').removeClass('canvasmenu-right');
            $(this).removeClass('menu_close');
        } else {
            $('.menu_vertical').addClass('active');
            $('body').addClass('canvasmenu-right');
            $(this).addClass('menu_close');
        }
        return false;
    });
    $('.menu_close .zmdi-close, .canvas-overlay').on("click", function () {
        $('.menu_vertical').removeClass('active');
        $('body').removeClass('canvasmenu-right');
        return false;
    });
    $('.toggle-myaccount').on("click", function () {
        if ($('.menu_myaccount').hasClass('active')) {
            $('.menu_myaccount').removeClass('active');
            $('body').removeClass('canvasmenu-right');
            $(this).removeClass('menu_close');
        } else {
            $('.menu_myaccount').addClass('active');
            $('body').addClass('canvasmenu-left');
            $(this).addClass('menu_close');
        }
        return false;
    });
    $('.menu_close .zmdi-close, .canvas-overlay').on("click", function () {
        $('.menu_myaccount').removeClass('active');
        $('body').removeClass('canvasmenu-right');
        return false;
    });
}
function NovMenu_canvas() {
    $('.show_settings_canvas').on("click", function () {
        if ($('.settings-canvas').hasClass('active')) {
            $('.settings-canvas').removeClass('active');
            $('body').removeClass('canvasmenu-right');
            $(this).removeClass('close_canvas');
        } else {
            $('.settings-canvas').addClass('active');
            $('body').addClass('canvasmenu-right');
            $(this).addClass('close_canvas');
        }
        return false;
    });
    $('.settings-canvas .close_canvas, .canvas-overlay').on("click", function () {
        $('.settings-canvas').removeClass('active');
        $('body').removeClass('canvasmenu-right');
        return false;
    });
    $(document).on('click', '.open_header_cart_canvas', function (e) {
        if ($('.header-cart-canvas').hasClass('active')) {
            $('.header-cart-canvas').removeClass('active');
            $('body').removeClass('canvasmenu-right');
            $(this).removeClass('close_canvas');
        } else {
            $('.header-cart-canvas').addClass('active');
            $('body').addClass('canvasmenu-right');
            $(this).addClass('close_canvas');
        }
        return false;
    });
    $(document).on('click', '.header-cart-canvas .close_canvas', function (e) {
        $('.header-cart-canvas').removeClass('active');
        $('body').removeClass('canvasmenu-right');
        return false;
    });
    $('.header-cart-canvas .close_canvas, .canvas-overlay').on("click", function () {
        $('.header-cart-canvas').removeClass('active');
        $('body').removeClass('canvasmenu-right');
        return false;
    });
}
function Form_newletter() {
//    $(".popup_newletter").modal({
//        show: !0
//    });

}
//Owl-carousel 
function Nov_Owlcarousel() {
    $(".owl_carousel").each(function (index) {
        if ($('body').hasClass('lang-rtl'))
            rtl = true;
        else
            rtl = false;
        var autoplay = $(this).data('autoplay');
        var autoplayTimeout = $(this).data('autoplayTimeout');
        var margin = $(this).data('margin');
        var nav = $(this).data('nav');
        var dots = $(this).data('dots');
        var loop = $(this).data('loop') ? $(this).data('loop') : false;
        var items = $(this).data('items') ? $(this).data('items') : 2;
        var items_large = $(this).data('items_large') ? $(this).data('items_large') : 2;
        var items_tablet = $(this).data('items_tablet') ? $(this).data('items_tablet') : 2;
        var items_mobile = $(this).data('items_mobile') ? $(this).data('items_mobile') : 1;
        var center = $(this).data('center') ? $(this).data('center') : false;
        var start = $(this).data('start') ? $(this).data('start') : 0;
        var owl = $('.owl-carousel');
        $(this).owlCarousel({
            navText: ['<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i>',
                '<i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>'],
            lazyLoad: true,
            lazyContent: true,
            loop: loop,
            autoplay: autoplay,
            autoplayTimeout: autoplayTimeout,
            items: items,
            rtl: rtl,
            dots: dots,
            nav: nav,
            responsive: {
                0: {
                    items: 1,
                    center: false,
                    loop: false,
                },
                320: {
                    items: items_mobile,
                    center: false,
                    loop: false,
                    autoHeight: true,
                },
                425: {
                    items: items_mobile,
                    center: false,
                    loop: false,
                    autoHeight: true,
                },
                768: {
                    items: items_tablet,
                    center: false,
                    loop: false
                },
                992: {
                    items: items_large,
                    center: false,
                    loop: loop
                },
                1200: {
                    items: items,
                    center: center,
                    startPosition: start,
                    loop: loop
                }
            }
        });
        checkClasses(this);
        $(this).on('translated.owl.carousel', function (event) {
            checkClasses(this);
        });
    });
}
//Owl with Slick
function Thumnail_Product() {
    $(".js-qv-mask .slick-images").each(function (index) {
        if ($('body').hasClass('lang-rtl'))
            rtl = true;
        else
            rtl = false;
        var autoplay = $(this).data('autoplay');
        var autoplayTimeout = $(this).data('autoplayTimeout');
        var items = $(this).data('items');
        var items_large = $(this).data('items_large');
        var items_mobile = $(this).data('items_mobile');
        var margin = $(this).data('margin');
        var nav = $(this).data('arrows');
        var dots = $(this).data('dots');
        var loop = $(this).data('loop');
        var vertical = $(this).data('vertical');
        var position = $(this).find('.selected').data('position-image');
        $(this).slick({
            prevArrow: '<div class="slickNext"><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></div>',
            nextArrow: '<div class="slickPrev"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></div>',
            rtl: rtl,
            vertical: vertical,
            //initialSlide: position,
            slidesToShow: items,
            slidesToScroll: 1,
            arrows: true,
            dots: dots,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        dots: dots,
                        vertical: false,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        vertical: false,
                        arrows: false,
                        dots: false,
                        slidesToShow: items_large,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 360,
                    settings: {
                        vertical: false,
                        arrows: false,
                        dots: false,
                        slidesToShow: items_mobile,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    })
}
function Nov_Owlcarousel2() {
    $(".thumb-v6 .product-images").each(function (index) {
        if ($('body').hasClass('lang-rtl'))
            rtl = true;
        else
            rtl = false;
        var autoplay = $(this).data('autoplay');
        var autoplayTimeout = $(this).data('autoplayTimeout');
        var margin = $(this).data('margin');
        var nav = $(this).data('nav');
        var dots = $(this).data('dots');
        var loop = $(this).data('loop') ? $(this).data('loop') : false;
        var items = $(this).data('items') ? $(this).data('items') : 2;
        var items_large = $(this).data('items_large') ? $(this).data('items_large') : 2;
        var items_tablet = $(this).data('items_tablet') ? $(this).data('items_tablet') : 2;
        var items_mobile = $(this).data('items_mobile') ? $(this).data('items_mobile') : 1;
        var center = $(this).data('center') ? $(this).data('center') : false;
        var start = $(this).data('start') ? $(this).data('start') : 0;
        var owl = $('.owl-carousel');
        $(this).owlCarousel({
            navText: ['<span>Next</span><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i>',
                '<i class="zmdi zmdi-chevron-left" aria-hidden="true"></i><span>Prev</span>'],
            lazyLoad: true,
            lazyContent: true,
            loop: loop,
            autoplay: autoplay,
            autoplayTimeout: autoplayTimeout,
            items: items,
            rtl: rtl,
            dots: dots,
            nav: nav,
            responsive: {
                0: {
                    items: 1,
                    center: false,
                    loop: false,
                },
                320: {
                    items: items_mobile,
                    center: false,
                    loop: false,
                    autoHeight: true,
                },
                425: {
                    items: items_mobile,
                    center: false,
                    loop: false,
                    autoHeight: true,
                },
                768: {
                    items: items_tablet,
                    center: false,
                    loop: false
                },
                992: {
                    items: items_large,
                    center: false,
                    loop: loop
                },
                1200: {
                    items: items,
                    center: center,
                    startPosition: start,
                    loop: loop
                }
            }
        });
        checkClasses(this);
        $(this).on('translated.owl.carousel', function (event) {
            checkClasses(this);
        });
    });
}
//Thumnail Slick Product Deal
function Thumnailslider_Deal() {
    $('.nov-productdealthumbnail .thumbnail').each(function (index) {
        var asNavFor_nav = $('.thumnailslider-for', this).data('asnavfornav');
        var autoplay = $('.thumnailslider-nav', this).data('autoplay');
        var autoplayTimeout = $('.thumnailslider-nav', this).data('autoplayTimeout');
        var items = $('.thumnailslider-nav', this).data('items');
        var items_mobile = $('.thumnailslider-nav', this).data('items_mobile');
        var margin = $('.thumnailslider-nav', this).data('margin');
        var nav = $('.thumnailslider-nav', this).data('nav');
        var dots = $('.thumnailslider-nav', this).data('dots');
        var loop = $('.thumnailslider-nav', this).data('loop');
        var vertical = $('.thumnailslider-nav', this).data('vertical');
        var position = $('.thumnailslider-nav', this).find('.selected').data('position-image');
        var asNavFor_for = $('.thumnailslider-nav', this).data('asnavforfor');
        if ($('body').hasClass('lang-rtl')) {
            var rtl = true;
            $(this).attr('dir', 'rtl');
        } else {
            var rtl = false;
        }
        $(asNavFor_for, this).slick({
            rtl: rtl,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            fade: true,
            loop: false,
            arrows: false,
            asNavFor: asNavFor_nav
        });
        $(asNavFor_nav, this).slick({
            rtl: rtl,
            slidesToShow: items,
            slidesToScroll: 1,
            asNavFor: asNavFor_for,
            centerMode: false,
            loop: false,
            focusOnSelect: true,
            dots: false,
            arrows: false,
            vertical: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2
                    }
                }
            ]
        });
    })
}
function checkClasses(class_parent) {
    if ($('body').hasClass('lang-rtl'))
        rtl = true;
    else
        rtl = false;
    var total = $('.owl-stage .owl-item.active', class_parent).length;
    $('.owl-stage .owl-item', class_parent).removeClass('firstActiveItem lastActiveItem');
    $('.owl-stage .owl-item.active', class_parent).each(function (index) {
        if (index === 0 && rtl === false) {
// this is the first one
            $(this).addClass('firstActiveItem');
        } else if (index === 0 && rtl === true) {
            $(this).addClass('lastActiveItem');
        }
        if (index === total - 1 && total > 1 && rtl === false) {
// this is the last one
            $(this).addClass('lastActiveItem');
        } else if (index === total - 1 && total > 1 && rtl === true) {
            $(this).addClass('firstActiveItem');
        }
    });
}
//Change Display Type category
function setDefaultGrid() {
    if ($.cookie('nov_grid_list') == 'grid_4') {
        $('.change-type .grid-type4').trigger('click');
    }
    if ($.cookie('nov_grid_list') == 'grid_3') {
        $('.change-type .grid-type3').trigger('click');
    }
    if ($.cookie('nov_grid_list') == 'grid_2') {
        $('.change-type .grid-type2').trigger('click');
    }
    if ($.cookie('nov_grid_list') == 'list') {
        $('.change-type .list-type').trigger('click');
    }

}
$(document).on('click', '.change-type span', function (e) {
    e.preventDefault();
    var view = $(this).data('type');
    if (!$(this).hasClass('active')) {
        $('.product_list').removeClass('grid_4 grid_3 grid_2 list');
        $('.product_tab_content').removeClass('grid_4 grid_3 grid_2');
        $('.product_list').addClass(view);
        $('.product_tab_content').addClass(view);
        $('.change-type span').removeClass('active');
        $(this).addClass('active');
        $.cookie('nov_grid_list', view, {
            expires: 1,
            path: '/'
        })
    }
});

novtheme.swapChildren = function (obj1, obj2) {
    var temp = obj2.children().detach();
    obj2.empty().append(obj1.children().detach());
    obj1.append(temp);
}
novtheme.toggleSticky = function (action) {
    if (action == true) {
        $("*[class^='contentsticky_']").each(function (idx, el) {
            var target = $('.' + el.classList['0'].replace('contentsticky_', 'contentstickynew_'));
            if (target.length) {
                novtheme.swapChildren($(el), target);
            }
        });
    } else {
        $("*[class^='contentstickynew_']").each(function (idx, el) {
            var target = $('.' + el.classList['0'].replace('contentstickynew_', 'contentsticky_'));
            if (target.length) {
                novtheme.swapChildren($(el), target);
            }
        });
    }
}
var flag_sticky = false;
$(window).on('resize', function () {
    var _cw = novtheme_current_width;
    var _mw = novtheme_min_width;
    var _w = window.innerWidth;
    var _toggle = (_cw >= _mw && _w < _mw) || (_cw < _mw && _w >= _mw);
    novtheme_current_width = _w;
    novtheme_responsive_mobile = novtheme_current_width < novtheme_min_width;

});

//Sticky Menu
function StickyHeader(flag_sticky) {
    if ($('#header').hasClass('sticky-menu')) {
        if (flag_sticky == true) {
            var time;
            var height = $('#header').height();
            var flag = true;
            $(window).scroll(function () {
                if (time)
                    clearTimeout(time);

                time = setTimeout(function () {
                    if ($(window).scrollTop() >= height) {
                        if (flag == true) {
                            $('#header-sticky').addClass('sticky-menu-active');
                            $('#header').css('height', height);
                            novtheme.toggleSticky(true);
                            flag = false;
                        }
                    } else {
                        if (flag == false) {
                            $('#header-sticky').removeClass('sticky-menu-active');
                            $('#header').css('height', 'auto');
                            novtheme.toggleSticky(false);
                            flag = true;
                        }
                    }
                }, 100);
            });
        }
    }
}

function NovFilterToggle() {
    $('.toggle_filter').click(function () {
        if ($('#_desktop_filter').hasClass("active")) {

            $('.toggle_filter').removeClass("active");
            $('#_desktop_filter').removeClass("active");
            $('.canvas-overlay').removeClass('act');
        } else {
            $('.toggle_filter').addClass("active");
            $('#_desktop_filter').addClass("active");
            $('.canvas-overlay').addClass('act');
        }

        $('.canvas-overlay').on('click', function (event) {
            $('#_desktop_filter').removeClass("active");
            if ($('.toggle_filter').hasClass("active")) {
                $('.toggle_filter').removeClass("active");
            }
            $(this).removeClass('act');
        });
    });
    $('.filter_close').on("click", function (l) {
        if ($('.toggle_filter').hasClass("active")) {
            $('.toggle_filter').removeClass("active");
        }
        $('#_desktop_filter').removeClass("active");
        $('.canvas-overlay').removeClass('act');
    });
}
//// menu bottom mobile
function NovTogglePage() {
    $('.nov-toggle-page').on('click', function (e) {
        var target = $(this).data('target');
        $('body').hasClass('show-boxpage') ? ($('body').removeClass('show-boxpage')) : ($('body').addClass('show-boxpage'));
        $(target).hasClass('active') ? ($(target).removeClass('active')) : ($(target).addClass('active'));
        e.stopPropagation();
    });
    $('.box-header .close-box').on('click', function (e) {
        $('body').removeClass('show-boxpage');
        $(this).parents('.mobile-boxpage').removeClass('active');
        $('#mobile-pageaccount').find('.box-content').removeClass('active');
        e.stopPropagation();
    });
    $('.links-currency, .links-language').on('click', function (e) {
        var target_link = $(this).data('target'),
                title_box = $(this).data('titlebox');

        $('#mobile-pageaccount').find('.box-content').removeClass('active');
        $('.title-box', '#mobile-pageaccount').html(title_box);
        $('.back-box', '#mobile-pageaccount').addClass('active');
        $(target_link).hasClass('active') ? ($(target_link).removeClass('active')) : ($(target_link).addClass('active'));
        e.stopPropagation();
    });
    $('.back-box', '#mobile-pageaccount').on('click', function (e) {
        var titlebox_parent = $('#mobile-pageaccount').data('titlebox-parent');
        $('#mobile-pageaccount').find('.box-content').removeClass('active');
        $('.title-box', '#mobile-pageaccount').html(titlebox_parent);
        $(this).removeClass('active');
    })
}

function NovSearchToggle() {
    $('.toggle-search').click(function () {
        if ($('#desktop_search').hasClass("in")) {
            $('body').removeClass("open-search");
        } else {
            $('#desktop_search').addClass("in");
            $('body').addClass("open-search");
        }
    });
    $('.search_close').on("click", function (l) {
        if ($('#desktop_search').hasClass("in")) {
            $('#desktop_search').removeClass("in");
            $('body').removeClass("open-search");
        }
        $('#desktop_search').removeClass("in");
        $('body').removeClass("open-search");
    });
}
function ProductScroll() {

}
function NovHeightBoxContent() {
    var height = $(window).outerHeight(),
            boxheight = $('.box-header').outerHeight(),
            menubottom = $('#stickymenu_bottom_mobile').outerHeight();
    $('.box-content', '.mobile-boxpage').each(function () {
        $(this).outerHeight(height - boxheight - menubottom);
    });
}
function Novzoom() {
    if ($(window).width() >= 992) {
        var $productImageZoom = $('.image-zoom');
        $productImageZoom.trigger('zoom.destroy');
        $productImageZoom
                .wrap('<span class="w-100" style="display:inline-block"></span>')
                .css('display', 'block')
                .parent()
                .zoom({
                    url: $(this).find('img').attr('data-zoom')
                });
    }
}
function Novstickyproduct() {
    if ($(window).width() > 991) {
        $(window).on('mousewheel DOMMouseScroll wheel', (function (e) {
            $('.thumbs-vertical .item.act').each(function () {
                var item = $(this),
                        p = item.data('position'),
                        hd = item.height() / 2,
                        hu = item.height() - 150,
                        srt = $(window).scrollTop(),
                        y = e.originalEvent.deltaY,
                        offset_top = item.offset().top;
                if (y > 0) {
                    if (p < $('.thumbs-vertical .item').length) {
                        var npd = p + 1;
                    } else {
                        var npd = p;
                    }
                    if (srt > offset_top + hd) {
                        item.removeClass('act');
                        $('.thumbs-vertical .item[data-position="' + npd + '"]').addClass('act');
                        $('.thumbItem[data-position="' + p + '"]').removeClass('active');
                        $('.thumbItem[data-position="' + npd + '"]').addClass('active');
                    }
                } else {
                    if (p > 1) {
                        var npu = p - 1;
                    } else {
                        var npu = p;
                    }
                    if (srt < offset_top - hd) {
                        item.removeClass('act');
                        $('.thumbs-vertical .item[data-position="' + npu + '"]').addClass('act');
                        $('.thumbItem[data-position="' + p + '"]').removeClass('active');
                        $('.thumbItem[data-position="' + npu + '"]').addClass('active');
                    }
                }
            });
        }));
        $('.thumb-v5 .thumbItem').click(function () {
            var p = $(this).data('position');
            $('.thumb-v5 .thumbItem').removeClass('active');
            $(this).addClass('active');
            $('.thumbs-vertical .item').removeClass('act');
            $('.thumbs-vertical .item[data-position="' + p + '"]').addClass('act');
            var ost = $('.thumbs-vertical .item.act').offset().top;
            $("body,html").animate({scrollTop: ost - 30}, "normal");
        });
    }
    if ($(document).width() <= 991) {
        $('.thumb-v5 .thumbs-vertical').slick({
            slide: '.item',
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: true,
        }).on('afterChange', function (e, o) {
            $('iframe').each(function () {
                $(this)[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
            });
        });
        $('.thumb_vertical .thumbs-vertical').on('afterChange', function (event, slick, currentSlide) {
            $('#productThumbs .nov-thumb_vertical').slick('slickGoTo', currentSlide);
            $('#productThumbs .nov-thumb_vertical').find('.slick-slide.item-active').removeClass('item-active');
            $('#productThumbs .nov-thumb_vertical').find('.slick-slide[data-slick-index="' + currentSlide + '"]').addClass('item-active');
        });

        $('.thumb_vertical .nov-thumb_vertical').on('click', '.slick-slide', function (event) {
            event.preventDefault();
            var goToSingleSlide = $(this).data('slick-index');
            $('.thumb_vertical .thumbs-vertical').slick('slickGoTo', goToSingleSlide);
        });
    }
    if ($(window).width() > 767) {
        $(".thumb-v2 .block_information .block_content").stick_in_parent({
            parent: $('.block_info'),
            offset_top: 70,
        });
        $(".thumb-v5 .product-images, .thumb-v5 .block_information .block_content").stick_in_parent({
            parent: $('.thumb-v5'),
            offset_top: 70,
        });
    }
    if ($(window).width() > 992) {
        $(".thumb-v3 .thumb-vertical").stick_in_parent({
            parent: $('.block_info'),
            offset_top: 70,
        });
//        $(".thumb-v4 .thumb-bottom").stick_in_parent({
//            parent: $('.block_info'),
//            offset_top: 70,
//        });
    }
}
var current_width = $(window).width();
var min_width = 768;
var responsive_mobile = current_width < min_width;
function NovatoggleMobileStylesCart() {
    if (responsive_mobile) {
        $("#_mobile_cart").each(function (idx, el) {
            var target = $('#_mobile_cart_bottom');
            if (target) {
                target.append($('#_mobile_cart').html());
            }
        });
    } else {
        $("#_mobile_cart_bottom").each(function (idx, el) {
            var target = $('#_mobile_cart');
            if (target) {
                $("#_mobile_cart_bottom").children().detach();
            }
        });
    }
}
$(window).on('resize', function () {
    var _cw = current_width;
    var _mw = min_width;
    var _w = $(window).width();
    var _toggle = (_cw >= _mw && _w < _mw) || (_cw < _mw && _w >= _mw);
    responsive_mobile = _cw >= _mw;
    current_width = _w;
    if (_toggle) {
        NovatoggleMobileStylesCart();
    }
});
novtheme.HoverMainMenu = function () {
    if ($(document).width() > 767) {
        $('.header-3 .level1 > li,.header-5 .level1 > li,.header-10 .level1 > li,.menu-top .elementor-icon-list-items > .elementor-icon-list-item').hover(function () {
            $('.header-3 .level1 > li').css('opacity', '0.3');
            $('.header-5 .level1 > li').css('opacity', '0.3');
            $('.header-10 .level1 > li').css('opacity', '0.3');
            $('.menu-top .elementor-icon-list-items > .elementor-icon-list-item').css('opacity', '0.3');
            $(this).css('opacity', '1').addClass('act');
        }, function () {
            $('.header-3 .level1 > li').css('opacity', '1').removeClass('act');
            $('.header-5 .level1 > li').css('opacity', '1').removeClass('act');
            $('.header-10 .level1 > li').css('opacity', '1').removeClass('act');
            $('.menu-top .elementor-icon-list-items > .elementor-icon-list-item').css('opacity', '1').removeClass('act');
        });
    }
}
if ($(window).width() < 768) {
    $('.block_footer .elementor-heading-title').click(function () {
        $(".block_footer .elementor-icon-list-items").slideToggle("slow", function () {
        });
        $('.block_footer .elementor-heading-title').hasClass('active') ? ($('.block_footer .elementor-heading-title').removeClass('active')) : ($('.block_footer .elementor-heading-title').addClass('active'))
    });
    $('.block_footer1 .elementor-heading-title').click(function () {
        $(".block_footer1 .elementor-icon-list-items").slideToggle("slow", function () {
        });
        $('.block_footer1 .elementor-heading-title').hasClass('active') ? ($('.block_footer1 .elementor-heading-title').removeClass('active')) : ($('.block_footer1 .elementor-heading-title').addClass('active'))
    });
    $('.block_footer2 .elementor-heading-title').click(function () {
        $(".block_footer2 .elementor-icon-list-items").slideToggle("slow", function () {
        });
        $('.block_footer2 .elementor-heading-title').hasClass('active') ? ($('.block_footer2 .elementor-heading-title').removeClass('active')) : ($('.block_footer2 .elementor-heading-title').addClass('active'))
    });
    $('.block_footer3 .elementor-heading-title').click(function () {
        $(".block_footer3 .elementor-section-boxed").slideToggle("slow", function () {
        });
        $('.block_footer3 .elementor-heading-title').hasClass('active') ? ($('.block_footer3 .elementor-heading-title').removeClass('active')) : ($('.block_footer3 .elementor-heading-title').addClass('active'))
    });
    $('.block_footer4 .elementor-heading-title').click(function () {
        $(".block_footer4 .elementor-icon-list-items").slideToggle("slow", function () {
        });
        $('.block_footer4 .elementor-heading-title').hasClass('active') ? ($('.block_footer4 .elementor-heading-title').removeClass('active')) : ($('.block_footer4 .elementor-heading-title').addClass('active'))
    });
}
var flag_sticky = false;
$(window).on('resize', function () {
    var _cw = novtheme_current_width;
    var _mw = novtheme_min_width;
    var _w = window.innerWidth;
    var _toggle = (_cw >= _mw && _w < _mw) || (_cw < _mw && _w >= _mw);
    novtheme_current_width = _w;
    novtheme_responsive_mobile = novtheme_current_width < novtheme_min_width;
    if (novtheme_current_width <= 768) {
        if (flag_sticky == true) {
            novtheme.toggleSticky(false);
            $('#header-sticky').removeClass('sticky-menu-active');
        }
    } else {
        //novtheme.toggleSticky(true);
    }
    NovTogglePage();
    NovHeightBoxContent();
});
$(document).ready(function () {
    setDefaultGrid();
    StickyHeader();
    NovSearchToggle();
    NovatoggleMobileStylesCart();
    NovTogglePage();
    NovFilterToggle();
    Thumnailslider_Deal();
    Thumnail_Product();
    Nov_Owlcarousel();
    Novzoom();
    novtheme.HoverMainMenu();
    Novstickyproduct();
    Nov_Owlcarousel2();
    click_button_canvas_menu();
    NovMenu_canvas();
    RunInstagram();
    ProductScroll();
    NovMegamenuToggle();
    Form_newletter();
    Header_top();
    $('.products_menu').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        arrows: false,
        dots: true,
        variableWidth: true,
        autoplaySpeed: 3000,
        responsive: {
            0: {
                slidesToScroll: 1
            },
            768: {
                slidesToScroll: 1
            },
            992: {
                slidesToScroll: 1
            },
            1200: {
                slidesToScroll: 1
            }
        }
    });

    $('.email-popup').on("click", function () {
        if ($('.input-subscribe-wrap .input-group-btn').hasClass("add")) {
            $('.input-subscribe-wrap .input-group-btn').removeClass("add");
        } else {
            $('.input-subscribe-wrap .input-group-btn').addClass("add");
        }
    });
    $('.product-add-to-cart .nov-bt-buynow').hover(function () {
        if ($('.product-quantity .add .add-to-cart[disabled]').length > 0) {
            $('.product-add-to-cart .nov-bt-buynow').addClass("disab");
        } else {
            $('.product-add-to-cart .nov-bt-buynow').removeClass("disab");
        }
    });

    goToTop();
    if (novtheme_current_width > 768) {
        StickyHeader(true);
        flag_sticky = true;
    }
    if (novtheme_current_width < 768) {
        Load_canvas_menu();
    }
    $("#nov-verticalmenu li").first().children('.dropdown-menu').slideDown(300);
    $("#nov-verticalmenu li").first().children('.block_content').slideDown(300);
    $("#nov-verticalmenu li").first().addClass('menu-active');
    $(".show-sub").click(function () {
        var $this = $(this);
        if ($this.parent().hasClass('menu-active')) {
            $this.parent().removeClass('menu-active');
            $this.next('.dropdown-menu').slideUp(300);
        } else {
            $this.parent().parent().find('li').removeClass('menu-active');
            $this.parent().parent().find('li .dropdown-menu, li .block_content').slideUp(300);
            $this.parent().toggleClass('menu-active');
            $this.next('.dropdown-menu').slideToggle(300);
        }
        return false;
    });
    $('.opener').click(function () {
        if ($(this).parent().hasClass('menu-active')) {
            $(this).parent().removeClass('menu-active');
            $(this).parent().children('.dropdown-menu').slideUp(300);
        } else {
            $(this).parent().parent().find('li').removeClass('menu-active');
            $(this).parent().parent().find('li').children('.dropdown-menu').slideUp(300);
            $(this).parent().addClass('menu-active');
            $(this).parent().children('.dropdown-menu').slideDown(300);
        }
    });
    $('.countdownfree').each(function (e) {
        var time_count = $(this).data('date');
        $(this).countdown(time_count, function (event) {
            var $this = $(this).html(event.strftime(''
                    + '<div class="item-time"><span class="data-time time-date">%D</span><span class="name-time">days</span></div>'
                    + '<div class="item-time"><span class="data-time time-hours">%H</span><span class="name-time">hours</span></div>'
                    + '<div class="item-time"><span class="data-time time-minute">%M</span><span class="name-time">mins</span></div>'
                    + '<div class="item-time"><span class="data-time time-second">%S</span><span class="name-time">secs</span></div>'
                    ));
        });
    });

});
let modalId = $('#image-gallery');
$(document).ready(function () {
    loadGallery(true, 'a.thumbnail');
    function disableButtons(counter_max, counter_current) {
        $('#show-previous-image, #show-next-image')
                .show();
        if (counter_max === counter_current) {
            $('#show-next-image')
                    .hide();
        } else if (counter_current === 1) {
            $('#show-previous-image')
                    .hide();
        }
    }
    function loadGallery(setIDs, setClickAttr) {
        let current_image,
                selector,
                counter = 0;
        $('#show-next-image, #show-previous-image')
                .click(function () {
                    if ($(this)
                            .attr('id') === 'show-previous-image') {
                        current_image--;
                    } else {
                        current_image++;
                    }
                    selector = $('[data-image-id="' + current_image + '"]');
                    updateGallery(selector);
                });
        function updateGallery(selector) {
            let $sel = selector;
            current_image = $sel.data('image-id');
            $('#image-gallery-title')
                    .text($sel.data('title'));
            $('#image-gallery-image')
                    .attr('src', $sel.data('image'));
            disableButtons(counter, $sel.data('image-id'));
        }
        if (setIDs == true) {
            $('[data-image-id]')
                    .each(function () {
                        counter++;
                        $(this)
                                .attr('data-image-id', counter);
                    });
        }
        $(setClickAttr)
                .on('click', function () {
                    updateGallery($(this));
                });
    }
});
$(document).keydown(function (e) {
    switch (e.which) {
        case 37: // left
            if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
                $('#show-previous-image')
                        .click();
            }
            break;
        case 39: // right
            if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
                $('#show-next-image')
                        .click();
            }
            break;
        default:
            return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
});