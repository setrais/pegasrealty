            <div style="/*padding-top:24px*/" >            
                    <table width="100%" style="border-spacing: 3px;border-collapse: separate;">   
                    <? $beg=0 ; $fav_cnt_col=3;?>    
                    <?  foreach( $favs as $fey => $fav ) { ?>                
                    <?  if ( $beg==0 ) { ?>   
                          <tr>                                               
                    <?  } ?>
                    <?  $beg++; ?>                             
                            <td style="text-align: center;vertical-align:middle;<?/*border: 1px solid #747747;*/?>padding:1px;<?/*border-radius: 5px;*/?>" >  
                              <div id="item-<?=$fav->id;?>" class="item pos-r itview" style="padding:4px;display:inline-block;text-align: center;height:152px;">
                                <div class="ids fs-12 pos-a" style="right: 8px;margin-top: 6px;" >                
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
                                 <div id="pic-item-<?=$fav->picOreginal->id;?>" class="pic" style="width:202px;vertical-align: middle;text-align: center;">
                                    <?php 

                                        $pic_width  ="202";
                                        $pic_height ="152";

                                        if ( trim($fav->pic_oreginal_id)<>"" ) 
                                        {   
                                            $pathfrompic = str_replace('_original'.substr($fav->picOreginal->original_name,-4,4),
                                                                            '_big'.substr($fav->picOreginal->original_name,-4,4),
                                                                            $fav->picOreginal->original_name); 

                                            $pathtopic = str_replace('_original'.substr($fav->picOreginal->original_name,-4,4),
                                                                            '_'.$pic_width.'x'.$pic_height.substr($fav->picOreginal->original_name,-4,4),
                                                                            $fav->picOreginal->original_name); 

                                            $picOreginal = '/'.$pathtopic; 

                                            if( !file_exists($picOreginal) ) {
                                                $image = Yii::app()->image->load($pathfrompic);
                                                /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                                                $image->resize($pic_width,$pic_height);
                                                $image->save($pathtopic); // or $image->save('images/small.jpg');
                                            }

                                            echo CHtml::link(CHtml::image( $picOreginal,'Пегас Недвижимость | './*Аренда офиса в Москвe - '.$fav->title*/$fav->getName(true), array( 'title'=>'Пегас Недвижимость | './*Аренда офиса в Москвe - '.$fav->title*/$fav->getName(true), 
                                                     'width'=>$pic_width."px", 'style'=>"height:auto;padding:0px" )), 
                                                          //'/'.$fav->picOreginal->original_name, 
                                                          array('realestates/view','id'=>$fav->id)
                                                          //array('class'=>'fancyImage')
                                                          );

                                        } else { 
                                            echo CHtml::link(CHtml::image( '/images/no_foto.png','Пегас Недвижимость | './*Аренда офиса в Москвe - '.$fav->title*/$fav->getName(true), array( 'title'=>'Пегас Недвижимость | './*Аренда офиса в Москвe - '.$fav->title*/$fav->getName(true),
                                                          'style'=>"height:100px;"),
                                                          array('realestates/view','id'=>$fav->id)
                                                         )
                                                 );

                                        }
                                     ?>  
                                 </div>
                                 <div style="z-index:1;left:0px;width:198px;bottom:0px;margin:4px;padding:2px; font-family: Arial, Tahoma, serif;" class="pos-a h-36 bg-orang">
                                     <a href="<? echo Yii::app()->createUrl('realestates/view',array('id'=>$fav->id));?>" title="<?=Chtml::encode($fav->getName(true));?>" class="title c-white fs-12 tahoma m-b3 p-l4 p-r4 bold" style="vertical-align:bottom;display:inline-block;overflow: hidden;text-align: center;text-overflow: ellipsis;white-space: nowrap;width: 192px;"><?php echo $fav->title; ?></a>
                                    <div class="properties fs-12 p-2 p-l4 p-r4">
                                       <div class="s-iteme fl"><?/*<b>Площадь<?php// echo CHtml::encode($fav->getAttributeLabel('area')); ?>:</b>*/?><span class="bold tahome" style="background: url('/images/icons/area-new.png') no-repeat left center;padding-left: 20px;color:yellow;" ><?php echo CHtml::encode(round($fav->area)); ?></span> <?php echo Yii::t('all','м2'); ?></div>
                                       <div class="s-price fr"><?/*<b>Цена<?php// echo CHtml::encode($fav->getAttributeLabel('price')); ?>:</b>*/?><span class="c-red bold tahome " style="background: url('/images/icons/cost.png') no-repeat left center;padding-left: 20px;"><?php echo CHtml::encode(round($fav->price)); ?></span> <?php echo CHtml::encode($fav->valute->abbr); ?></div>   
                                    </div>
                                 </div>
                              </div>                      
                            </td>                   
                    <?  if ( $beg%$fav_cnt_col==0 ) { ?>  
                          </tr>     
                    <?     $beg=0; ?>
                    <?  } ?>                                                          
                    <? } ?>    
                    </table>
            </div>    