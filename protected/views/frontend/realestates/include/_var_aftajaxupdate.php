<?php     
$afterAjaxUpdate =<<< EOD
            function(id, data) {                       
              //changeBrowserUrl($.fn.yiiGridView.getUrl(id));  
              //changeBrowserUrl($.fn.yiiGridView.getUrl(id));                              
              $('#Realestates_date_release').datepicker($.datepicker.regional['".Yii::app()->params->language."']);
              $('#Realestates_date_release').datepicker( 'option', 'altFormat', 'dd.mm.yy' );                                
              $('#Realestates_date_release').datepicker( 'option', 'dateFormat', 'dd.mm.yy' );
                                
              $('#Realestates_date_rang').datepicker($.datepicker.regional['".Yii::app()->params->language."']);
              $('#Realestates_date_rang').datepicker( 'option', 'altFormat', 'dd.mm.yy' );                                
              $('#Realestates_date_rang').datepicker( 'option', 'dateFormat', 'dd.mm.yy' );
              $('.fancyImage').fancybox(
                     {'overlayShow': true, 'hideOnContentClick': true}
              );    
              /*yaCounter15927313.hit(location.href, null, null);
              if(_gaq){
                 _gaq.push(['_trackPageview', location.href]);
                 _gaq.push(['_trackEvent', 'List Realestates', 'Click pages']);
              }*/
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
              }
EOD;
