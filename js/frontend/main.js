jQuery(function($) {

    $("ul.tabsnav li").click(function() {
        var parent = $(this).parents(".authtabs");
        $(parent).find("ul.tabsnav li").removeClass("current");
        $(this).addClass("current");
        var attr = $(this).attr("rel");
        $(parent).find(".tab_box").removeClass("active");
        $(parent).find("#" + attr).addClass("active");
    });
});

$(document).ready(function() {
    
    $("a#register").fancybox({
        'width': 610,
        //'height'			: 660,
        'autoScale'            : true,
        'transitionIn'        : 'none',
        'transitionOut'        : 'none',
        'type'                : 'ajax'});

    $("a#auth").fancybox({
        'width': 610,
        //'height'			: 460,
        'autoScale'            : true,
        'transitionIn'        : 'none',
        'transitionOut'        : 'none',
        'type'                : 'ajax'
    });

    $("a#reports").fancybox({
        'width': 610,
        'height'            : 848,
        'autoScale'            : false,
        'transitionIn'        : 'none',
        'transitionOut'        : 'none',
        'type'                : 'ajax',
        'onComplete'        : function() {

            $("a#register").fancybox({
                'width': 610,
                //'height'			: 660,
                'autoScale'            : true,
                'transitionIn'        : 'none',
                'transitionOut'        : 'none',
                'type'                : 'ajax'});
        }
    });

    $("a#question").fancybox({
        'width': 610,
        'height': 590,
        'autoScale': false,
        'transitionIn': 'none',
        'transitionOut': 'none',
        'type': 'ajax'
    });

    $("a.favorite2").click(function() {
        var th = $(this);

        if (th.hasClass('active')) {
            if (!confirm('Вы уверены что хотите удалить блюда из избранного?')) {
                return false;
            }
        }

        $.ajax({
            url: th.attr('href'),
            dataType: 'json',
            success: function(data) {
                if (data.result == true) {
                    th.toggleClass('active');
                } else {
                    $("a#register").trigger('click');
                }
            }
        });
        return false;
    });

    $("a#img").fancybox({
        'autoScale'            : true
    });

    $(".sub_menu a, .menu-ban a").hover(function() {
        $(this).find("img:first").css("opacity", "0.5");
    }, function() {
        $(this).find("img:first").css("opacity", "1");
    });

    $("a#quickRegister").fancybox({
        'width'        : 610,
        'autoScale'    : true,
        'transitionIn' : 'none',
        'transitionOut': 'none',
        'type'         : 'ajax'
    });

    $("#exit").click(function() {
        $(this).parents(".moduletable-login").find(".hind").fadeIn(300);
    });
    $(".hind a").click(function() {
        $(this).parents(".hind").fadeOut(300);
    });
});