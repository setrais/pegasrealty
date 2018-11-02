<?php     
$afterAjaxUpdate =<<< EOD
            function(id) {  
              changeBrowserUrl($.fn.yiiListView.getUrl(id));               
              
              $('.fancyImage').fancybox(
                     {'overlayShow': true, 'hideOnContentClick': true}
              );    
              /*yaCounter15927313.hit(location.href, null, null);
              if(_gaq){
                 _gaq.push(['_trackPageview', location.href]);
                 _gaq.push(['_trackEvent', 'List Realestates', 'Click pages']);
              }*/
            }
EOD;
