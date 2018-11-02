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

<?    
$js_security = "                
                document.onselectstart=function(){return false};
                document.oncontextmenu=function(){return false};
                $('.items tbody').bind('mousedown',function(){return false});
               ";

Yii::app()->getClientScript()->registerScript('Security'.$this->getId(), $js_security, CClientScript::POS_READY);

Yii::app()->getClientScript()->registerScript('_collapse', "               
            
            /*$('tr.even.extrarow').hover(
                        function() {    
                            $(this).prev().css('background-color', '#ECFBD4');                            
                        },
                        function() {                                            
                            $(this).prev().css('background-color', '#F8F8F8');
            });
            
            $('tr.odd.extrarow').hover(
                    function(){                                        
                        $(this).prev().css('background-color', '#ECFBD4');
                    },
                    function() {                
                        $(this).prev().css('background-color', '#E5F1F4');
            });*/
            
            $('tr.even').hover(
                        function() {                
                            $(this).next('tr.even').css('background-color', '#ECFBD4');                            
                        },
                        function() {                                            
                            $(this).next('tr.even').css('background-color', '#F8F8F8');
            });
            
            $('tr.odd').hover(
                    function(){                                        
                        $(this).next('tr.odd').css('background-color', '#ECFBD4');
                    },
                    function() {                
                        $(this).next('tr.odd').css('background-color', '#E5F1F4');
            });
            
      ");        
?>    
