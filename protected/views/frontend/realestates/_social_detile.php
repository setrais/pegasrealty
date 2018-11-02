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
                       //'annotation'=>$model->title,
                       'href'=> Yii::app()->getBaseUrl(true).'/'.Yii::app()->request->getPathInfo().(Yii::app()->request->getQueryString()<>'' ? '?'.Yii::app()->request->getQueryString() : ''),
                       'lang'=>'ru_RU'
         ));
    ?>                
    </div>    
    <div class="fb fl inline lh-24" id="fb" >       
        <iframe allowtransparency="true" style="border: medium none; overflow: hidden; width:110px;height:34px;vertical-align:middle;" src="http://www.facebook.com/plugins/like.php?locale=ru_RU&href=http%3A%2F%2Fpegasrealty.ru<?='/'.Yii::app()->request->getPathInfo();?><?=(Yii::app()->request->getQueryString()<>'' ? '?'.Yii::app()->request->getQueryString() : '');?>&amp;layout=button_count&amp;show_faces=false&amp;width=85&amp;action=like&amp;colorscheme=light&amp;height=34" frameborder="0" scrolling="no"></iframe>
                       <!--<iframe src="//www.facebook.com/plugins/like.php?locale=ru_RU&href=http%3A%2F%2F<?=$_SERVER["SERVER_NAME"]?>&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=false&amp;action=recommend&amp;colorscheme=light&amp;font=tahoma&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>-->
    </div>
    <?/*<!-- Put this div tag to the place, where the Like block will be -->
    <div class="vk fl" id="vk" >
        <!--<a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/images/vk.png" alt="" /></a>-->
        <div id="vk_like"></div>
        //<a href="http://vkontakte.ru/share.php?url=Yii::app()->getBaseUrl(true).'/'.Yii::app()->request->getPathInfo()" target="_blank">Поделиться ВКонтакте</a>
        /*<script>
           $(document).ready(function() {                                     
                 VK.Widgets.Like('vk_like', { type :'button', 
                                              width: 500, 
                                              pageTitle: '<?=$this->pageTitle;?>', 
                                              pageDescription: '<?=$this->pageDescription;?>',
                                              pageUrl: '<?=Yii::app()->getBaseUrl(true).'/'.Yii::app()->request->getPathInfo();?>,
                                              pageImage: '<?=$image_soc;?>',
                                              //text: 'Текст который будет опубликован на стене',
                                              height: 22, //18,20,24
                                              verb: 0, //1 - Это интересно
                                               }/*, 321/);
           });
        </script>
    </div>*/?>
    <div class="b-share fr" id="b-share" >
        <?/*<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,friendfeed,diary" data-yashareImage="<? echo $image_soc;?>"></div>*/?>
        <script>
        new Ya.share({
        element: 'b-share',
            elementStyle: {
                'type': 'button',
                'border': true,
                'quickServices': ['yaru', 'vkontakte', 'facebook', 'twitter', 'odnoklassniki', 'moimir', 'friendfeed', 'diary'/*, '|', 'blogger',
                                  'delicious' , 'digg' , 'evernote', 'juick', 'liveinternet', 'linkedin', 'lj', 'moikrug', 'myspace', 'pinterest', 
                                  'surfingbird', 'tutby', 'yazakladki'*/

                ]
            },
            image: '<?=$image_soc;?>',
            link: '<?=Yii::app()->getBaseUrl(true).'/'.Yii::app()->request->getPathInfo().(Yii::app()->request->getQueryString()<>'' ? '?'.Yii::app()->request->getQueryString() : '');?>'
            /*title: 'Yandex — the best search engine in the universe!',
            popupStyle: {
                blocks: {
                    'Поделись-ка!': ['yaru', 'twitter', '', 'vkontakte'],
                    'Поделись-ка по-другому!': ['yaru', 'twitter', 'vkontakte']
                },
                copyPasteField: true
            }*//*,
            serviceSpecific: {
                /*twitter: {
                    title: '#Yandex — the best search engine in the universe!'
               }
            }*/
        });
        </script>
        <?/*<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,friendfeed,diary" <?/*data-yashareTheme="counter"?>></div>*/?>
    </div>
    <div class="clear"></div>
</div>  