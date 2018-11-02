<script>
    $(document).ready(function() {
        $(".fancyImage").fancybox(
           {'overlayShow': true, 'hideOnContentClick': true}
        );
        
        /*jQuery('.popup.tipsy').livequery(function(){
            enable_tipsy(jQuery(this));
        });

        function enable_tipsy(tag)
        {
            tag.tipsy( {
            //content: hkShowPopUp,
            trigger:'manual',
            isOut:true,
            delayOut:0
          } );
        }*/  

    }); 
</script>  

<?php    
$js_security = "                
                document.onselectstart=function(){return false};
                document.oncontextmenu=function(){return false};
                $('.items tbody').bind('mousedown',function(){return false});
               ";

Yii::app()->getClientScript()->registerScript('Security'.$this->getId(), $js_security, CClientScript::POS_READY);
?>
