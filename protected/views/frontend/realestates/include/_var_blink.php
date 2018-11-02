<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$js_blick="
    //$(document).ready(function() { 
    var timeout_id;
    $('.itview,.view,.even,.odd').live('mouseover',function(){
        var sel = this;
        timeout_id = setTimeout( function() { $(sel).find('.sendfav').fadeOut('fast').fadeIn('fast')},10);
    });
    $('.view,.even,.odd').live('mouseleave',function(){        
        clearTimeout(timeout_id);        
    });
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
