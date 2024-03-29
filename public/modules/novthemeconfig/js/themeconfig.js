$(document).ready(function () {

    // Make the first tab active
    var $_firstTab = $('#nov-config-tabs .tab').first();
    $_firstTab.addClass('active');

    var firstTabContentID = '#' + $_firstTab.attr('data-tab');
    $('#configuration_form .panel').first().show();

    // On tab click
    $('#nov-config-tabs .tab').on('click', function ()
    {
        var tabContentID = $(this).data('tab');
        $('#configuration_form .panel').animate({opacity: 0}, 0).css("display", "none");
        $('[id^="' + tabContentID + '"]').css("display", "block").animate({opacity: 1}, 200);

        $('#nov-config-tabs .tab').removeClass('active');
        $(this).addClass('active');
    });

    $('.fontOptions').trigger('change');

    $('.slick_slider').each(function (index) {
        var width = window.innerWidth || document.body.clientWidth;
        if ($('body').hasClass('lang-rtl')) {
            rtl = true;
            $(this).attr('dir', 'rtl');
        } else {
            rtl = false;
        }
        var nav = $(this).data('show_arrows') ? $(this).data('show_arrows') : false;
        var dots = $(this).data('show_dots') ? $(this).data('show_dots') : false;
        var autoplay = $(this).data('autoplay') ? $(this).data('autoplay') : false;
        var items = $(this).data('md') ? $(this).data('md') : 4;
        var items_large = $(this).data('lg') ? $(this).data('lg') : 3;
        var items_tablet = $(this).data('xs') ? $(this).data('xs') : 2;
        var items_mobile = $(this).data('xl') ? $(this).data('xl') : 1;
        var rows = $(this).data('number_row') ? $(this).data('number_row') : 1;
        $(this).slick({
            nextArrow: '<div class="slickPrev"><i class="zmdi zmdi-chevron-right" aria-hidden="true"></i></div>',
            prevArrow: '<div class="slickNext"><i class="zmdi zmdi-chevron-left" aria-hidden="true"></i></div>',
            rtl: rtl,
            dots: true,
            rows: rows,
            arrows: nav,
            infinite: false,
            speed: 300,
            slidesToShow: items,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1920,
                    settings: {
                        slidesToShow: items,
                        slidesToScroll: items,
                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: items_large,
                        slidesToScroll: items_large,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: items_tablet,
                        slidesToScroll: items_tablet,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: items_mobile,
                        slidesToScroll: items_mobile,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: items_mobile,
                        slidesToScroll: items_mobile,
                    }
                }
            ]
        });
    });
});


var handle_font_change = function (that, systemFonts) {
    var systemFontsArr = systemFonts.split(',');
    var selected_font = $(that).val();
    var identi = $(that).attr('id');

    if (!$('#' + identi + '_link').size())
        $('head').append('<link id="' + identi + '_link" rel="stylesheet" type="text/css" href="" />');
    if ($.inArray(selected_font, systemFontsArr) < 0)
        $('link#' + identi + '_link').attr({href: 'http://fonts.googleapis.com/css?family=' + selected_font.replace(' ', '+')});
    $('#' + identi + '_example').css('font-family', selected_font);

};