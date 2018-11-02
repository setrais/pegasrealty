$(document).ready(function() {
    $("#add-favourite-shop a").fancybox();
    $("a#call-back").fancybox();
//    window.fancy_url = 'sd_search';
    $('a#address_pop-up').fancybox();

    $('.items-count').mouseenter(function() {
        $(this).next().css('display', 'inline-block');
        $(this).prev().css('display', 'inline-block');
        $(this).next().next().hide();

    });
    $('.order-cart .row').mouseleave(function() {
        $(this).find('.dec.plus-button').css('display', 'none');
        $(this).find('.inc.plus-button').css('display', 'none');
        $(this).find('.sht').show();
    });
    $('.basket .qty').mouseleave(function() {
        $(this).find('.dec.plus-button').css('display', 'none');
        $(this).find('.inc.plus-button').css('display', 'none');
        $(this).find('.sht').show();
    });


    $('#shop-list div.deliv-item').live('click',function(){
        $url = $(this).find('.dev-foto a').attr('href');
        window.location = $url;
    });
    $('#shop-list div.deliv-item .star-rating-control').live('click',function(){
        return false;
    });

//    jQuery('#mycarousel').jcarousel();
//    jQuery('#mycarousel2').jcarousel();
//    jQuery('#mycarousel3').jcarousel();

    $('a#foot').parents('.top-nav').next().css('border', '4px solid #e75106');
    $('a#product').parents('.top-nav').next().css('border', '4px solid #688801');

    $('.openid-nav li a#other').click(function() {
        $('.openid-nav li .open-other').slideDown('fast');
    })
    $('.openid-nav li a#other-act').click(function() {
        $('.openid-nav li .open-other').slideUp('fast');
    });
    $('.popup-close').click(function() {
        $('.pop-up').hide('fast');
        $('.hide').css('display', 'none');
    });
    $('.popup-close.message').click(function() {
        $('.messagge-send-pop-up').hide('fast');
        $('.hide').css('display', 'none');
    });
    $('.sigin').click(function() {
        $('.hide').css('display', 'block');
        $('.auth-popup').show('fast');
    });
    $('.send-message').click(function() {
        $('.messagge-send-pop-up').show('fast');
        $('.hide').css('display', 'block');
    });

    $('#shop-list .deliv-item').hover(function() {
        $(this).css('background', '#fff5d9');
        $(this).find('.hover').show();
    }, function() {
        $(this).css('background', 'none');
        $(this).find('.hover').hide();
    });

    $('.ingrad a').toggle(function() {
        $(this).next().slideDown();
        $(this).prev().text(' - ');
    }, function() {
        $(this).next().slideUp();
        $(this).prev().text(' + ');
    });

    $(".payment .method input").change(function() {
        $val = $(this).val();
        $(".payment .method input").each(function() {
            if ($val != $(this).val())
                $(this).attr('checked', false);
        })
    });

//Этот код не поддерживает параллельные ajax запросы
//$('.message table td span.message-title').toggle(function(){
//    $(this).next('.read-mail').slideDown('fast');
//}, function(){
//    $(this).next('.read-mail').slideUp('fast');
//})

    //поэтому пришлось пойти таким путем:
    $('.message table td span.message-title').click(function() {
        if ($(this).hasClass('expanded')) {
            $(this).removeClass('expanded');
            $(this).next('.read-mail').slideUp('fast');
        } else {
            $(this).addClass('expanded');
            $(this).next('.read-mail').slideDown('fast');
        }
    });


    $(".payment .method input").change(function() {
        $val = $(this).val();
        $(".payment .method input").each(function() {
            if ($val != $(this).val())
                $(this).attr('checked', false);
        })
    });

    function countChecked() {
        $("input.chekked").parents('tr').removeClass('odd');
        $("input.chekked:checked").parents('tr').addClass('odd');
    }

    countChecked();
    $("input.chekked").click(countChecked);


    $('#RegisterForm_gender_0').next().addClass('male-float').next().remove();
    $('#RestaurantWorkHours_around_the_clock').prev().prev().addClass('label-clear');

    $('#RegisterForm_gender_1').next().addClass('male-float');
    $('.blogs').parents('#content').find('.create-order').children('.order-status').hide();

//cart 0n filter
    $('#show-cart').toggle(function(){
        //$(this).parent().hide();
        $(this).parent().prev().hide();
        $(this).parent().next().slideDown('fast');
        return false;
    },function(){
        $(this).parent().prev().show();
        $(this).parent().next().slideUp('fast');
        return false;
    })



});

