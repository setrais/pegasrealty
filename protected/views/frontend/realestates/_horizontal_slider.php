      <div class="shogpred hidden" >   
      <?/*<h2 class="fs-12i center m-2 z1 w-100p pos-a tt-u tahome c-333 ">Лучшие предложения - аренда помещений в москве под офис</h2>*/?> 
      <h2 class="fs-12i center m-2 z1 w-100p pos-a tt-u tahome c-333 ">Лучшие объявления<?/*предложения*/?> - <?php echo CHtml::link(CHtml::encode('аренда помещений в Москве под офис'), array('realestates/index'), array('alt'=>'Коммерческая недвижимость - Аренда в Москве под офис', 'class'=>"c-orang"));?></h2>    
      <?php $this->beginWidget('ext.widgets.carousel.ECarouselWidget',
                        array('options'=>array( 'animation'=>'fast',
                                                'easing'=>null,
                                                'auto'=>10,
                                                'wrap'=>'both',
                                               )
                                         )); ?>           
            <? foreach ( $favs as $fav ) { ?>
            <li>
               <div id="item-shogpred-<?=$fav->id;?>" class="item-shogpred pos-r itview" style="/*border-radius:0px;box-shadow: 1px 1px 2px 0 #3A3A3A;*/">
                  <div class="ids fs-12 pos-a" style="right: 6px;margin-top: 4px;" >                
                                <?php 
                                        echo CHtml::ajaxLink(CHtml::image( '/images/mail-send.png','', 
                                                    array('title'=>'Отправить заявку | '.$fav->seo_title,'style'=>'margin: -3px 0 0;vertical-align: middle;')), 
                                        array('realestates/createfavsend','id'=>$fav->id),
                                        array('success'=>"js:function(data) {
                                                            document.onselectstart=function(){return true}                                            
                                                            document.onmousedown=function(){return true}
                                                            $('.popup').dialog({title:'Оформление заявки',
                                                                    modal: true});                            
                                                            $('#ClaimSendForm_nid').val(data);                                                                                                            
                                                         }"),                              
                                        array('id'=>'sendfav'.$fav->id, 'class'=>'sendfav obram','title'=>'send'));              
                               ?> 
                               <?php
                                        echo CHtml::ajaxLink(CHtml::image( '/images/addtofav.png','', 
                                                    array('title'=>'Добавить в избранное | '.$fav->seo_title,'style'=>'margin: -3px 0 0;vertical-align: middle;')), 
                                        array( 'realestates/favadd','id'=>$fav->id),
                                        array( 'success'=>"js: function(data) {       
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
                                        }"),                           
                                        array('id'=>'addtofav'.$fav->id, 'class'=>'addtofav obram','title'=>'AddToFav')); 
                                ?>
                   </div>                    
                   <div class="pic radius-3 center" >
      <?php 
      $thumb_picsim_width = 120;
      $thumb_picsim_height = 80;
      
      if ( trim($fav->pic_oreginal_id)<>"") 
      {       
         $pic = $fav->picOreginal->original_name; 
         $thumb = str_replace('_original'.substr($fav->picOreginal->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($fav->picOreginal->original_name,-4,4), $fav->picOreginal->original_name);          
      } else if( trim($fav->pic_detile_id)<>"" )
      {  
         $pic = $fav->picDetile->original_name; 
         $thumb = str_replace('_big'.substr($fav->picDetile->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($fav->picDetile->original_name,-4,4), $fav->picDetile->original_name); 
      } else if( trim($fav->pic_anons_id)<>"" )
      {  
         $pic = $fav->picAnons->original_name;  
         $thumb = str_replace('_original'.substr($fav->picAnons->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($fav->picAnons->original_name,-4,4), $fav->picAnons->original_name);                                 
      } else 
      {                  
         $thumb = '/images/no_foto.png';          
      }
            
      $picSrc = '/'.$pic;      
      $picThumb = '/'.$thumb;      
      
      if( !file_exists($picSrc) ) {
          $image = Yii::app()->image->load($pic);
          $image->resize($thumb_picsim_width,$thumb_picsim_height);
          $image->save($thumb); 
      }      
?>           
<?php 
           
      echo CHtml::link(CHtml::image( $picThumb,'Пегас Недвижимость | './*'Аренда | Офиса | Москва - '.$fav->title*/$fav->getName(true), 
                                      array( 'title'=>'Пегас Недвижимость | './*'Аренда | Офиса | Москва - '.$fav->title*/$fav->getName(true) )), 
                       array('realestates/view','id'=>$fav->id),  
                        /*'/'.$fav->picOreginal->original_name*/ array(/*'class'=>'fancyImage',*/ 'title'=>'Пегас Недвижимость | './*'Аренда | Офиса | Москва - '.$fav->title*/$fav->getName(true))); 
?>                       
                   </div>   
                   <div class="desc">
                       <div class="title">
                        <?/*<h2>Недвижимость&bull;Аренда&bull;Офиса в Москве</h2>*/?>   
                        <? echo CHtml::link('<b>'.HRu::cutstr($fav->title, 60, false, '...').'</b>',
                                  array('realestates/view','id'=>$fav->id),
                                  array('title'=>'Пегас Недвижимость | './*'Аренда | Офиса | Москва - '.$fav->title*/$fav->getName(true))
                                ); ?>
                        <? /*<a href="#" ><b><?=$fav->title;?></b></a>*/?>   
                       </div>
                       <div class="properties fs-11 p-2 p-l4 p-r4 lh-14">
                        <div class="s-iteme fl">
                        <span class="bold arial fs-11">S</span><span class="bold arial" style="/*background: url('/images/icons/area-new.png') no-repeat left center;*//*padding-left: 20px;*/color:/*yellow;*/green;display: inline-block; line-height: 16px;"><?=ceil($fav->area);?></span>
                        м2
                        </div>
                        <div class="s-price fr">
                        <span class="c-red bold arial" style="background: url('/images/icons/cost.png') no-repeat left center; display: inline-block; line-height: 16px; padding-left: 18px;"><?=round($fav->price,2);?></span>
                        <?=$fav->valute->abbr;?>
                        </div>
                        <div class="clear"></div>   
                       </div>
                       <?/*<div class="area c-333 p-2"><b><?=ceil($fav->area);?>&nbsp;м2</b></div>
                       <div class="price p-2"><b><?=round($fav->price,2);?>&nbsp;<?=$fav->valute->abbr;?></b></div>*/?>
                   </div>                   
               </div>  
            </li> 
            <? } ?>
      <?php $this->endWidget(); ?>
      </div>
      <script>
          $(document).ready(function() {
              $('.shogpred').removeClass('hidden');
          });
      </script>