<div class="social">   
    <div class="google-plus fl" >
    <?/*<div id="gplus">
        <?/*<a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/images/gplus.png" alt="" /></a> 
        <!-- Поместите этот тег туда, где должна отображаться кнопка +1. -->
        <g:plusone href="http://<?=$_SERVER["SERVER_NAME"]?>"></g:plusone>
        <!-- Поместите этот вызов функции отображения в соответствующее место. -->
        <script type="text/javascript">
           window.___gcfg = {lang: 'ru'};
           $(function() {
              var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                  po.src = 'https://apis.google.com/js/plusone.js';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
           });
       </script>
       </div>*/?>
    <?php
         $this->widget('ext.yii-google-plusone.GPlusoneButton', array(
                       'width'=>'200',/*290*/
                       'annotation'=>$model->title,
                       'href'=>'http://vlastdeneg.ru',
                       'lang'=>'ru_RU'
         ));
    ?>                
    </div>    
    <div class="fb fl inline lh-24" id="fb" >
              <iframe allowtransparency="true" style="border: medium none; overflow: hidden; width:100px;height:34px;vertical-align:middle;" src="http://www.facebook.com/plugins/like.php?locale=ru_RU&href=http%3A%2F%2Fvlastdeneg.ru&amp;layout=button_count&amp;show_faces=false&amp;width=85&amp;action=like&amp;colorscheme=light&amp;height=34" frameborder="0" scrolling="no"></iframe>
                       <!--<iframe src="//www.facebook.com/plugins/like.php?locale=ru_RU&href=http%3A%2F%2F<?=$_SERVER["SERVER_NAME"]?>&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=false&amp;action=recommend&amp;colorscheme=light&amp;font=tahoma&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>-->
    </div>
    <?/*<!-- Put this div tag to the place, where the Like block will be -->
    <div class="vk fl" id="vk" >
        <!--<a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/images/vk.png" alt="" /></a>-->
        <div id="vk_like"></div>
        //<a href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fvlastdeneg.ru" target="_blank">Поделиться ВКонтакте</a>
        /*<script>
           $(document).ready(function() {                                     
                VK.Widgets.Like("vk_like", {type: "full"});
           });
        </script>
    </div>*/?>
    <div class="b-share fr" id="b-share" >
        <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir"></div> 
    </div>
    <div class="clear"></div>
</div>  