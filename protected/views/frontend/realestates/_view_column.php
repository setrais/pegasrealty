<div class="view fl w-446 <?php echo $index%2==0 ? "m-r12" : "";?> radius-5"> 
  <div>
    <div class="left-col pos-r" style="padding:4px;display:inline-block;text-align: center;width: 202px;height:152px;" > 
        <div class="pic" style="width:202px;vertical-align: middle;text-align: center; height:152px; overflow: hidden;">
        <?php

              $thumb_picsim_width = 202;
              $thumb_picsim_height = 152;
              if( trim($data->pic_detile_id)<>"" )
              {                    
                                
                  $pic = $data->picDetile->original_name;
                  $src = str_replace('_original'.substr($pic,-4,4),
                             '_big'.substr($pic,-4,4),
                             $pic); 
                  $thumb = str_replace('_big'.substr($pic,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($pic,-4,4), $pic); 
              } else if ( trim($data->pic_oreginal_id)<>"") 
              {  
                  $pic = $data->picOreginal->original_name; 
                  $src = str_replace('_original'.substr($pic,-4,4),
                             '_big'.substr($pic,-4,4),
                             $pic); 
                  $thumb = str_replace('_original'.substr($pic,-4,4),
                           '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($pic,-4,4), $pic);          
              } else if( trim($data->pic_anons_id)<>"" )
              {  
                  $pic = $data->picAnons->original_name;
                  $src = str_replace('_original'.substr($pic,-4,4),
                             '_big'.substr($pic,-4,4),
                             $pic); 
                  $thumb = str_replace('_original'.substr($pic,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($pic,-4,4), $pic);                                 
              } else 
              {                  
                 $thumb = '/images/no_foto.png';          
              }
            
                 $picSrc = '/'.$src;      
                 $picThumb = '/'.$thumb;      
      
                 if( file_exists($src) ) {
                     if (!file_exists($thumb)) {
                        $image = Yii::app()->image->load($pic);
                        $image->resize($thumb_picsim_width,$thumb_picsim_height);
                        $image->save($thumb); 
                     } 
                 }     
      
                  echo CHtml::link(CHtml::image( $picThumb,'', 
                        array('title'=>($data->seo_title ? $data->seo_title : $data->picOreginal->name),'style'=>'width:'.$thumb_picsim_width.'px !important;' )), 
                              $picSrc, 
                              array('class'=>'fancyImage'));
        ?>           
        <?php /*
            if ( trim($data->pic_oreginal_id)<>"" ) 
            {            
                $picOreginal = '/'.str_replace('_original'.substr($data->picOreginal->original_name,-4,4),
                                                '_small'.substr($data->picOreginal->original_name,-4,4),
                                                $data->picOreginal->original_name); 
                echo CHtml::link(CHtml::image( $picOreginal,'', 
                        array('title'=>$data->picOreginal->name, "height"=>80 )), 
                              '/'.$data->picOreginal->original_name, 
                              array('class'=>'fancyImage'));

            } else { 
                echo CHtml::link(CHtml::image( '/images/no_foto.png','', 
                        array('title'=>Yii::t('all','Без фото'),
                              'style'=>"height:80px;")
                             )
                     );

            }*/
         ?>             
       </div>      
       <div style="z-index:1;left:0px;width:198px;bottom:0px;margin:4px;padding:2px; font-family: Arial, Tahoma, serif;height:19px;" class="pos-a bg-orang">
            <div class="properties fs-12 p-2 p-l4 p-r4">
                 <div class="s-iteme fl"><?/*<b>Площадь<?php// echo CHtml::encode($fav->getAttributeLabel('area')); ?>:</b>*/?><span class="bold tahome" style="background: url('/images/icons/area-new.png') no-repeat left center;padding-left: 20px;color:yellow;" ><?php echo CHtml::encode(round($data->area)); ?></span> <?php echo Yii::t('all','м2'); ?></div>
                 <div class="s-price fr"><?/*<b>Цена<?php// echo CHtml::encode($fav->getAttributeLabel('price')); ?>:</b>*/?><span class="c-red bold tahome " style="background: url('/images/icons/cost.png') no-repeat left center;padding-left: 20px;"><?php echo CHtml::encode(round($data->price)); ?></span> <?php echo CHtml::encode($data->valute->abbr); ?></div>   
            </div>
       </div> 
    </div>    

    <div class="right-col w-220i" style="margin: 3px 5px 0;">
        <?/*<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>*/?>
        <div class="pos-r">
            <h3 class="ads m-0 p-0 m-b1 fs-12" style="line-heigth:auto" ><span class="ed"><?php echo CHtml::link(CHtml::encode($data->title), array('realestates/view', 'id'=>$data->id),array('style'=>'color:#ff7000'/*#2d4998;#023c75;#0e509e;#57a9dd;#253c86;#023c75;#ff860c;#2e6ab1;*/)); ?></span></h3>
            <div class="ids fs-12 pos-a" >                
                <?php 
                        echo CHtml::ajaxLink(CHtml::image( '/images/mail-send.png','', 
                                    array('title'=>'Отправить заявку | '.$data->seo_title,'style'=>'margin: -3px 0 0;vertical-align: middle;')), 
                        array('realestates/createfavsend','id'=>$data->id),
                        array('success'=>"js:function(data) {
                                            document.onselectstart=function(){return true}                                            
                                            document.onmousedown=function(){return true}
                                            $('.popup').dialog({title:'Оформление заявки',
                                                    modal: true});                            
                                            $('#ClaimSendForm_nid').val(data);                                                                                                            
                                         }"),                              
                        array('id'=>'sendfav'.$data->id, 'class'=>'sendfav','title'=>'send'));              
                ?> 
                                <?php
                echo CHtml::ajaxLink(CHtml::image( '/images/addtofav.png','', 
                                    array('title'=>'Добавить в избранное | '.$data->seo_title,'style'=>'margin: -3px 0 0;vertical-align: middle;')), 
                        array( 'realestates/favadd','id'=>$data->id),
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
                        array('id'=>'addtofav'.$data->id, 'class'=>'addtofav','title'=>'AddToFav')); 
                ?>
                <b><?php echo Yii::t('all','№'); ?>:</b>
                <?php echo CHtml::link(CHtml::encode($data->nid), array('realestates/view', 'id'=>$data->id)); ?>                              
            </div>
            <?php if ($widget->desc) { ?>    
            <div class="desc fs-12 pos-a" >                    
                <?php echo $data->getDestination(true,$widget->desc); ?></b>                              
            </div>            
            <? } ?>
            <div class="clear"></div>
        </div>                        
        <p class="m-0 m-b1 fs-10">            
            <?php echo ($data->areas_id ? "<b>".CHtml::encode($data->getAttributeLabel("areas_id")).":</b> "
                                                    .CHtml::encode($data->areas->title) : "")." <br/>";?>
            <b><?php echo CHtml::encode($data->getAttributeLabel('district_id')); ?>:</b>
            <?php echo CHtml::encode($data->district->title)." (".CHtml::encode($data->district->abbr).")"; ?><?php// echo CHtml::encode($data->district->desc); ?>;
            <br/>
            <?php echo ($data->street_id ? 
            "<b>".CHtml::encode(mb_convert_case($data->street->getFullName(null,false),MB_CASE_TITLE, "UTF-8")).":</b> " 
                               .CHtml::encode($data->street->name) : "")." "?>            
            <br/>            
            <b><?php echo CHtml::encode($data->getAttributeLabel('metro_id')); ?>:</b>
            <?php echo CHtml::encode($data->metro->title); ?>;                        
            <br/>
            <?php if ($data->realestateVid->is_ceil) { ?>
            <b><?php// echo CHtml::encode($data->getAttributeLabel('realestate_vid_id')); ?><?php echo Yii::t('all','Cнять');?>:</b>
            <?php echo CHtml::encode($data->realestateVid->title); ?>                    
            <?php } else { ?>
            <b><?php// echo CHtml::encode($data->getAttributeLabel('realestate_vid_id')); ?><?php echo Yii::t('all','Cнять');?>:</b>
            <?php echo CHtml::encode($data->realestateVid->title); ?>  
            <b><?php// echo CHtml::encode($data->getAttributeLabel('realestate_vid_id')); ?><?php echo Yii::t('all','в');?>:</b>
            <?php echo CHtml::encode($data->realestateType->namewhere); ?>                                
            <?php } ?>
            <b><?php echo Yii::t('all','класса'); ?></b>
            <span class="ed" ><?php echo CHtml::encode($data->realestateClass->abbr); ?></span>;               
            <br/>
            <?php $props = CHtml::listData(Properties::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'); 
            ?>             
            <?php $cnt=count($data->realestateProperties);            
            ?>                        
            <?php             
                if ($cnt) {
            ?>
                  <b><?php echo CHtml::encode(Yii::t('all','Свойства')); ?>:</b>  
            <?php      
                  foreach ($data->realestateProperties as $key=>$realestatePropertie) { 
                     if ($cnt<>($key+1)) echo CHtml::encode($props[$realestatePropertie->property_id])."/";
                     else echo CHtml::encode($props[$realestatePropertie->property_id]);
                  } 
                    echo  "<br/>";      
                } else {
                    //echo 'не указаны';
                    //echo "<br/>";
                }                              
            ?> 
            <b><?php echo CHtml::encode($data->getAttributeLabel('area')); ?>:</b>
            <span class="c-red fs-11"><?php echo CHtml::encode(round($data->area)); ?></span>
            <span class="ed" ><?php echo Yii::t('all','м2'); ?></span>;
            <b><?php echo CHtml::encode($data->getAttributeLabel('remoteness')); ?>:</b>
            <?php echo CHtml::encode(round($data->remoteness)); ?>
            <span class="ed" ><?php echo CHtml::encode($data->unit->short_title); ?></span>;    
            <br/>
            <b><?php echo CHtml::encode($data->getAttributeLabel('planning_id')); ?>:</b>
            <?php echo CHtml::encode($data->planning->title); ?>;
            <br/>
            <?php /* Отделка не учтена */ ?>
            <?php /* Телекоммуникации */ ?>
            <?php /* Охрана */?>        
        
            <b><?php echo CHtml::encode($data->getAttributeLabel('parking_id')); ?>:</b>
            <span style="text-transform:lowercase;"><?php echo CHtml::encode($data->parking->title); ?>-</span>	
            <?php echo CHtml::encode($data->cnt_parking_place); ?>
            <span class="ed"><?=Yii::t('all','м/м');?></span>;
        
            <?php /* Стоимость парковки */ ?>
            <br/>
            <?/*<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
            <?php echo CHtml::encode(round($data->price)); ?>
            <span class="ed"><?php echo CHtml::encode($data->valute->abbr); ?></span>            
            <?=Yii::t('all','кв/м в год');?>;
            <br/>*/?>
            <b><?php echo CHtml::encode(Yii::t("label","Арендная ставка")); ?>:</b>
            <span class="c-red fs-11"><?php echo round($data->price); ?></span> <span class="ed"><?php echo $data->valute->abbr; ?></span>                                                     
            <br/>
            <b><?php echo Yii::t("label","Стоимость&nbsp;в&nbsp;месяц"); ?>:</b>&nbsp;
            <span class="c-red fs-11"><?php echo round(($data->price*$data->area)/12); ?></span>&nbsp;<span class="ed"><?php echo $data->valute->abbr; ?></span>                               
            <br/>
            <b><?php echo CHtml::encode($data->getAttributeLabel('tax_id')); ?>:</b>
            <?php echo CHtml::encode($data->tax->abbr<>'НДС' ? $data->tax->abbr.($data->taxReference->abbr ? " | ".$data->taxReference->abbr : "") : "вкл.".$data->tax->abbr.($data->taxReference->abbr ? " | ".$data->taxReference->abbr : "")); ?> 
        </p>        
        </div>
        <div class="clear"></div>
        <div>
        <?php// echo CHtml::encode($data->district->desc); ?>
        <?php/* if ($widget->desc) { ?>    
        <p class="anons m-0 p-b1 fs-8 justify" >
           <?php echo $data->getDestination($widget->desc); ?></b> 
        </p>    
        <? } */?>
        <?php// if (!$widget->short) { ?>    
        <p class="anons m-0 p-b1 fs-10 justify">
            <?php echo HRu::cutstr(CHtml::encode($data->anons),520,false,"").
                    "&nbsp;".CHtml::link("&nbsp;подробнее...",Yii::app()->controller->createUrl("/realestates/".$data->primaryKey), array("title"=>"Недвижимость/Аренда/Офиса в Москве - ".$data->title, "class"=>"fs-11" )); ?>
        </p>
        <?// } ?>
        </div>
  </div>
  <?php /*
        <b><?php echo CHtml::encode($data->getAttributeLabel('pic_anons_id')); ?>:</b>
	<?php echo CHtml::encode($data->pic_anons_id); ?>
	<br /> 
        
      	<b><?php echo CHtml::encode($data->getAttributeLabel('pic_scr_id')); ?>:</b>
	<?php echo CHtml::encode($data->pic_scr_id); ?>
	<br />
 
	<b><?php echo CHtml::encode($data->getAttributeLabel('pic_detile_id')); ?>:</b>
	<?php echo CHtml::encode($data->pic_detile_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_rang')); ?>:</b>
	<?php echo CHtml::encode($data->date_rang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_release')); ?>:</b>
	<?php echo CHtml::encode($data->date_release); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('in_stock')); ?>:</b>
	<?php echo CHtml::encode($data->in_stock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>
	<?php echo CHtml::encode($data->telephone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site')); ?>:</b>
	<?php echo CHtml::encode($data->site); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('representative_id')); ?>:</b>
	<?php echo CHtml::encode($data->representative_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commission_id')); ?>:</b>
	<?php echo CHtml::encode($data->commission_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('procent_commission')); ?>:</b>
	<?php echo CHtml::encode($data->procent_commission); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contract_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->contract_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contract_number')); ?>:</b>
	<?php echo CHtml::encode($data->contract_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_number')); ?>:</b>
	<?php echo CHtml::encode($data->tax_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fav')); ?>:</b>
	<?php echo CHtml::encode($data->fav); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('realestate_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->realestate_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('realestate_class_id')); ?>:</b>
	<?php echo CHtml::encode($data->realestate_class_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('realestate_vid_id')); ?>:</b>
	<?php echo CHtml::encode($data->realestate_vid_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anons')); ?>:</b>
	<?php echo CHtml::encode($data->anons); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detile')); ?>:</b>
	<?php echo CHtml::encode($data->detile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('map_latitude')); ?>:</b>
	<?php echo CHtml::encode($data->map_latitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('map_longitude')); ?>:</b>
	<?php echo CHtml::encode($data->map_longitude); ?>
	<br />

	*/ ?>

</div>
 