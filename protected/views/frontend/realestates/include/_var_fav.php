<?php
$js_sendfav =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {
        $('.popup').dialog({title:'Оформление заявки',
                            modal: true});                            
        $('#ClaimSendForm_nid').val(data);                    
    });
    return false;
}
EOD;
?>

<?
$js_addtofav =<<< EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {
        //alert(response);
        /*var effect_in = 'scale';
        var easing_in = 'easeOutElastic';
        var effect_out = 'same';
        var easing_out = 'same';
        if (effect_out == 'same') effect_out = effect_in;
        if (easing_out == 'same') easing_out = easing_in;
        var speed = '700';
        if (speed.match(/^\d+$/)) speed = parseInt(speed);
        var options_in = {
            easing: easing_in
        };
        var options_out = {
            easing: easing_out
        };
        if (effect_in == 'scale') options_in.percent = 100;
        if (effect_out == 'scale') options_out.percent = 0;
        $.pnotify({
            pnotify_title: 'Информация',
            pnotify_text: 'Недвижимость №'+data+'успешно!</br>добавлена в избранное',
            pnotify_animate_speed: speed,
            pnotify_animation: {
                'effect_in': 'scale',
                'options_in': options_in,
                'effect_out': effect_out,
                'options_out': options_out
            }
        });*/
        $.pnotify({
            pnotify_width: 100,
            pnotify_nonblock: true,
            pnotify_title: 'Информация', 
            pnotify_text: 'Недвижимость №'+data+' успешно!<br/>добавлена в избранное',
            pnotify_animation: {
                effect_in: function(status, callback, pnotify) {
                    var source_note = 'Always call the callback when the animation completes.';
                    var cur_angle = 0;
                    var cur_opacity_scale = 0;
                    var timer = setInterval(function() {
                        cur_angle += 10;
                        if (cur_angle == 360) {
                            cur_angle = 0;
                            cur_opacity_scale = 1;
                            clearInterval(timer);
                        } else {
                            cur_opacity_scale = cur_angle / 360;
                        }
                        pnotify.css({
                            '-moz-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-webkit-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-o-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-ms-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            'filter': ('progid:DXImageTransform.Microsoft.BasicImage(rotation=' + (cur_angle / 360 * 4) + ')')
                        }).fadeTo(0, cur_opacity_scale);
                        if (cur_angle == 0) callback();
                    }, 20);
                },
                effect_out: function(status, callback, pnotify) {
                    var source_note = 'Always call the callback when the animation completes.';
                    var cur_angle = 0;
                    var cur_opacity_scale = 1;
                    var timer = setInterval(function() {
                        cur_angle += 10;
                        if (cur_angle == 360) {
                            cur_angle = 0;
                            cur_opacity_scale = 0;
                            clearInterval(timer);
                        } else {
                            cur_opacity_scale = cur_angle / 360;
                            cur_opacity_scale = 1 - cur_opacity_scale;
                        }
                        pnotify.css({
                            '-moz-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-webkit-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-o-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            '-ms-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                            'filter': ('progid:DXImageTransform.Microsoft.BasicImage(rotation=' + (cur_angle / 360 * 4) + ')')
                        }).fadeTo(0, cur_opacity_scale);
                        if (cur_angle == 0) {
                            pnotify.hide();
                            callback();
                        }
                    }, 20);
                }
            }
        });
    });
    return false;
}
EOD;
?>
<?php
$js_blick="
    //$(document).ready(function() { 
    /*var timeout_id;
    $('.itview,.view,.even,.odd').live('mouseover',function(){
        var sel = this;
        timeout_id = setTimeout( function() { $(sel).find('.sendfav').fadeOut('fast').fadeIn('fast')},10);
    });
    $('.view,.even,.odd').live('mouseleave',function(){        
        clearTimeout(timeout_id);        
    });*/
    $('.blick').blink({
    maxBlinks: 60, 
    blinkPeriod: 2000,   // in milliseconds
    speed: 'slow',
    onBlink: function(){}, 
    onMaxBlinks: function(){}
});
    /*$('.view').hover(        
        function() {              
            var sel = this;
            var timeout_id = setTimeout( function() { $(sel).find('.sendfav').fadeOut('fast').fadeIn('fast')},10);
        },
        function() {
            clearTimeout(timeout_id);        
        }   
    );*/
//});
";
Yii::app()->getClientScript()->registerScript('blickfavsend'.$this->getId(), $js_blick, CClientScript::POS_READY);         
?>