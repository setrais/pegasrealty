<?php
$js_infocode="
    //$(document).ready(function() { 
        var infocode = $('.infocode a');
        infocode.attr('rel','nofollow')
        infocode.wrap('<noindex></noindex>');        
        $('.infocode a').live('click',function(){return false;});
    //});    
";    
Yii::app()->getClientScript()->registerScript('infocode'.$this->getId(), $js_infocode, CClientScript::POS_END);         
?>
                        