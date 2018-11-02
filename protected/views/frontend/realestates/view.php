<?php

$this->pageTitle=Yii::t('all','Каталог недвижимости Москвы')." | ".( trim($model->seo_title)<>'' ? trim($model->seo_title) : $model->title." - ".$model->area." м2 / Аренда офиса ".($model->district ? (mb_strtolower($model->district->title,'UTF-8')=='центр' ? 'в ' : 'на').' '.mb_strtolower($model->district->title, 'UTF-8').'е Москвы' : 'в Москве')) ;//Yii::t('all',Yii::app()->name);

//$this->pageDescription = 'pegasrealty.ru - Портал недвижимости агентства "Пегас недвижимость", профессионала рынка коммерческой недвижимости | Аренда офиса Москвы';
$this->pageDescription = HRu::cutstr(( trim($model->seo_desc)<>'' ? trim($model->seo_desc) : ( trim($model->anons)<>'' ? Yii::t('all',$model->anons) : $this->pageDescription)),750);

/*$this->pageKeywords = array('аренда', 'офиса', 'центре', 'москвы', 'москве', 'москвы', 'коммерческая недвижимость','офисная недвижимость', 
                            'склад', 'аренда помещений', 'собственник', 'помещений', 'продажа', 'без комиссии', 'купить офис');*/
$this->pageKeywords = ( trim($model->seo_keywords)<>'' ? explode(',',$model->seo_keywords) : $this->pageKeywords);

$this->breadcrumbs=array(
	Yii::t('all','Realestates')=>array('index'),
	$model->title.' - '.round($model->area).' '.Yii::t('all','м2'),
);
?>
<?php 
      $props = CHtml::listData(Properties::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'); 
      $cnt=count($model->realestateProperties);
      $listProperties='';
      foreach ($model->realestateProperties as $key=>$realestatePropertie) { 
          if ($cnt<>($key+1)) $listProperties.= CHtml::encode($props[$realestatePropertie->property_id])
                                                   .'<span class="ed" >/</span>';
          else $listProperties.= CHtml::encode($props[$realestatePropertie->property_id]);
      } 
?>    
<?       
    $realestateFotos=array();
    foreach ($model->realestateFotos as $key=>$realestateFoto) {
        $realestateFotos[] = $realestateFoto->file_id; 
    }    
    
    if ($model->picOreginal->id || $model->picDetile->id ) {
        if ($model->picDetile->id) array_unshift($realestateFotos, $model->picDetile->id);
        else array_unshift($realestateFotos, $model->picOreginal->id);
    }
    
    if (!empty($realestateFotos)) {
                          $fotos = Files::model()->findAll('id in ('.implode(",",$realestateFotos).')');                          
       ?>
       <?php                         
           foreach ($fotos as $key=>$foto) {
              
              $pic_width  ="450";
              $pic_height ="";
              
              $thumb_width  ="";
              $thumb_height ="75";

              $rel = str_replace('_original'.substr($foto->original_name,-4,4),
                             '_src'.substr($foto->original_name,-4,4),
                             $foto->original_name); 
              $src = str_replace('_original'.substr($foto->original_name,-4,4),
                             '_big'.substr($foto->original_name,-4,4),
                             $foto->original_name);               
              
                                                      
              $res = str_replace('_original'.substr($foto->original_name,-4,4),
                                 '_'.$pic_width.'x'.$pic_height.substr($foto->original_name,-4,4),
                                                                       $foto->original_name); 
              $thumb = str_replace('_original'.substr($foto->original_name,-4,4),
                                 '_'.$thumb_width.'x'.$thumb_height.substr($foto->original_name,-4,4),
                                                                       $foto->original_name); 
                                        
              $picRes = '/'.$res; 
              $picRel = '/'.$rel;                           
              $picSrc = '/'.$src;                          
              $picThumb = '/'.$thumb;               
              if( file_exists($src) ) {                  
                  if( !file_exists($res) ) {
                      $image = Yii::app()->image->load($src);
                     /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                      $image->resize($pic_width,null);
                      $image->save($res); // or $image->save('images/small.jpg');
                  }

                  if( !file_exists($thumb) ) {
                      $image = Yii::app()->image->load($src);
                     /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                      $image->resize(null,$thumb_height,null);
                      $image->save($thumb); // or $image->save('images/small.jpg');
                  }
                  $afotos[]=array('image_url'=>$picRes,'thumb_url'=>$picThumb, 
                      'title'=>'Недвижимость/'.( $model->district 
                          ? 'Аренда офиса '.(mb_strtolower($model->district->title,'UTF-8')=='центре' ? 'в ' : 'на').' '.mb_strtolower($model->district->title, 'UTF-8').'е Москвы'
                          : 'Аренда офиса в Москве')
                          .' - '.$model->title/*foto->name*/, 'alt'=>'Недвижимость/'.( $model->district 
                          ? 'Аренда офиса '.(mb_strtolower($model->district->title,'UTF-8')=='центре' ? 'в ' : 'на').' '.mb_strtolower($model->district->title, 'UTF-8').'е Москвы'
                          : 'Аренда офиса в Москве').$model->title/*$foto->name*/, 'link'=>$picSrc);                                 
              }               
           } 
       ?>

<?php } ?>
<?php 
     // Схожие предложения     
     //print_r($model->realestatesSimilarities);
?> 
<div id="content" class="p-b0">
<div class="content" >    
    <div class="title" >    
        <div class="fl">            
            <h1>
                <?php 
                    if ($model->district) {
                        echo $model->title.' - '.round($model->area).' '.Yii::t('all','м2').' аренда офиса '.(mb_strtolower($model->district->title,'UTF-8')=='центр' ? 'в ' : 'на').' '.mb_strtolower($model->district->title, 'UTF-8').'е Москвы'; 
                    } else {
                        echo $model->title.' - '.round($model->area).' '.Yii::t('all','м2').' аренда офиса в Москве'; 
                    }
                ?>                                  
            </h1>
        </div>    
        <div class="fl p-l16 lh-30">
           <?php 
                   echo CHtml::ajaxLink(CHtml::image( '/images/mail-send.png','', 
                                    array('title'=>'Отправить '.$model->title)), 
                        array('realestates/createfavsend','id'=>$model->id),
                        array('success'=>"js:function(data) {
                                            document.onselectstart=function(){return true}                                            
                                            document.onmousedown=function(){return true}
                                            $('.popup').dialog({title:'Оформление заявки',
                                                    modal: true});                            
                                            $('#ClaimSendForm_nid').val(data);                                                                                                            
                                         }"),                              
                        array('id'=>'sendfav', 'class'=>'sendfav','title'=>'send'));              
           ?> 
           <?php 
                   echo CHtml::link( CHtml::image( '/images/printer_arrow.png','', 
                                     array('title'=>'Печать '.$model->title)), 
                                     '#',array('id'=>'realestate_pdf', 'class'=>'pdf', 'title'=>'print')
                                   );
           ?>             
           <?php 
                   echo CHtml::ajaxLink(CHtml::image( '/images/addtofav.png','', 
                                    array('title'=>'Добавить в избранное '.$model->title)), 
                        array( 'realestates/favadd','id'=>$model->id),
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
                        array('id'=>'addtofav', 'class'=>'addtofav','title'=>'AddToFav'));              
           ?>   
        </div> 
        <?/*<div class="fl m-l14" >
              <?php// $this->renderPartial('/realestates/_social');?>
        </div>*/?>         
        <?php $this->renderPartial('_send',array('model'=>$model_claim));?> 
        <div class="fr fs-22 c-333">            
            <a class="button back" href="javascript:history.back();">Назад</a>
            <span>№<?php echo $model->nid; ?><?/* ID:<?php echo $model->id; ?>*/?></span>
        </div>
        <div class="clear"></div>
    </div>         
    <div class="item" >
        <div class="props w-454 fl mh-438 radius-5 bg-blue" style="margin-top:7px;" >
             <div class="bg-blue radius-5-0 p-5 m-l1-r1" >                
             </div>
             <?/*<h2>Свойства недвижимости:</h2>*/?>       
             <div>
             <?php $this->widget('zii.widgets.CDetailView', array(
                        'data'=>$model,
                        'attributes'=>array(              
                                /*'address',*/
                                array( 'name'=>'operation.title',
                                       'label'=>Yii::t('label','Operation'),                    
                                ),
                                array( 'name'=>'realestateType.title',
                                       'label'=>Yii::t('label','Realestate Type'),                    
                                ),
                                /*array( 'name'=>'fav',
                                       'value'=>($model->fav ? 'да' : 'нет'),
                                ),*/
                                array( 'name'=>'metro.title',
                                       'label'=>Yii::t('label','Metro'),
                                ),
                                array( 'name'=>'remoteness',
                                       'label'=>Yii::t('label','Remoteness'),
                                       'type'=>'html',
                                       'value'=>round($model->remoteness)
                                                .' <span class="ed">'.$model->unit->short_title.'</span>',
                                ),
                                array( 'name'=>'realestateVid.title',
                                       'label'=>Yii::t('label','Realestate Vid'),                    
                                ),  
                                array( 'name'=>'realestateClass.abbr',
                                       'label'=>Yii::t('label','Realestate Class'),                    

                                ),
                                array( 'name'=>'planning.title',
                                       'label'=>Yii::t('label','Planning'),                                                               
                                ),
                                array( 'name'=>'coefficient_corridor',
                                       'value'=>($model->coefficient_corridor===null ? 'отсутствует' : $model->getCoefficientCorridor()),
                                ),
                                 array( 'name'=>'is_separate_entrance',
                                        'value'=>($model->is_separate_entrance ? 'да' : 'нет'),
                                ),                                
                                array( 'name'=>'area',
                                       'type'=>'html',
                                       'value'=>round($model->area)
                                               .' <span class="ed">'.Yii::t('all','м2').'</span>',
                                ),                  
                                array( 'name'=>'stavka',
                                       'type'=>'html',
                                       'label'=>Yii::t('label','Арендная ставка'), 
                                       'value'=>round($model->price).' <span class="ed">'.$model->valute->abbr.'</span>',
                                ),    
                                array( 'name'=>'price',
                                       'type'=>'html',
                                       'label'=>Yii::t('label','Стоимость в месяц'),
                                       'value'=>round(($model->price*$model->area)/12).' <span class="ed">'.$model->valute->abbr.'</span>',
                                ),  
                                array( 'name'=>'tax.abbr',
                                       'label'=>Yii::t('label','Tax'),  
                                       'value'=>$model->tax->abbr<>'НДС' ? $model->tax->abbr.($model->taxReference->abbr ? " | ".$model->taxReference->abbr : "") : "вкл.".$model->tax->abbr.($model->taxReference->abbr ? " | ".$model->taxReference->abbr : ""),                                                                      
                                ), 
                                array( 'name'=>'parking.title',
                                       'label'=>Yii::t('label','Parking'),
                                       'type'=>'html',
                                       'value'=>'<span style="text-transform: lowercase;">'
                                                    .$model->parking->title.'</span> - '
                                                    .'<b>'.$model->cnt_parking_place.'</b> '
                                                    .' <span class="ed">'.Yii::t('all','м/м').' </span>',
                                ),  
                                /*array( 'name'=>'realestateProperties',
                                       'label'=>'Свойства',//Yii::t('label','Realestate Properties'),
                                       'type'=>'html',
                                       'value'=>$listProperties,
                                ),*/                                
                                /*array( 'name'=>'district.title',
                                       'label'=>Yii::t('label','District'),
                                ),*/
                                /*array( 'name'=>'areas.title',
                                       'label'=>Yii::t('label','Areas'),
                                ),*/                            
                                /*array( 'name'=>'taxReference.title',
                                       'label'=>Yii::t('label','№ Tax'),
                                ),*/
                                /*array( 'name'=>'in_stock',
                                       'value'=>($model->in_stock ? 'да' : 'нет'),
                                ),*/                                    
                        ),
                )); ?>
              </div> 
              <div class="bg-blue radius-0-5 m-l1-r1 p-5 p-t16 justify">                    
                    <p><?php echo $model->anons; ?></p>
             </div>
        </div>         
        <div class="slider fr">
        <?
            $this->widget('ext.adGallery.AdGallery',
                            array(  /*'agEffect' => 'resize',/*fade*/
                                    /*'agDescriptionWrapper'=>'true',*/
                                    'imageList' => $afotos/*array(
                                            array(
                                                    'image_url' => 'images/1.jpg',
                                                    'thumb_url' => 'images/thumbs/t1.jpg',
                                                    'title' => 'Test tile',
                                                    'link' => 'http://www.google.com/',
                                                    'alt' => 'Something something',
                                            ),
                                            array(
                                                    'image_url' => 'images/2.jpg',
                                                    'title' => 'Test tile sdfjaskdf',
                                                    'link' => 'http://www.msn.com/',
                                            ),
                                            'images/3.jpg',
                                            'images/4.jpg',
                                            'images/5.jpg',
                                            'images/6.jpg',
                                            'images/7.jpg',
                                            'images/8.jpg',
                                            'images/9.jpg',
                                            'images/10.jpg',
                                            'images/11.jpg',
                                            'images/12.jpg',
                                    ),*/
                            )
                    );
        ?>
            <?php $this->renderPartial('/realestates/_social',array('model'=>(object)array('title'=>$this->pageTitle)));?>
        </div>    
        <div class="clear"></div>
    </div>
    <div class="detile">
            <? if ( trim($model->detile)<>'' || $model->realestatesSimilarities || $model->realestatesOthers ) { ?>
                <h2 class="bg-blue radius-5-0 p-5">Описание недвижимости</h2> 
                <div class="p-5">
                    <?/* if ( trim($model->anons)<>'' ) { ?>
                    <p><?php echo $model->anons; ?></p>
                    <? } */?>
                    <div class="hait">
                      <?// $realestatesOthers=$model->with('realestatesSimilarities')->findAll("realestate_linking_id=1"); ?>                        
                      <? $realestatesOthers=$model->realestatesOthers; ?>                        
                      <?// $realestatesShogpreds=$model->with('realestatesSimilarities')->findAll("realestate_linking_id=1"); ?>                        
                      <? $realestatesShogpreds=$model->realestatesSimilarities; ?>
                      <?// print_r($realestatesOthers);?>  
 
                       <?if ($realestatesOthers) { ?>  
                        <div class="other-area fr w-310 m-l14<?/*m-r14*/?>">
                                <h3 class="center c-fill <?/*m-5*/?> fs-14 ff-tahoma"><b>Другая площадь:</b></h3>
                                <table class="tshap">
                                    <tr>
                                        <th class="valign-m halign-c p-3" width="79" >Cкриншот</th>
                                        <th class="valign-m halign-r p-3" width="93" >Площадь <b>м2</b></th>
                                        <th class="valign-m halign-r p-3" >Стоимость</th>                                        
                                    </tr>
                                </table>
                                <table class="tbody">
                                 <? foreach ( $realestatesOthers as $realestateSimilarity ) { ?>                                                                                                                          
                                    <tr>
                                      <td class="valign-m halign-c p-3" width="78" >                                                
<?php 
      //$thumb_picsim_width = 100;
      $thumb_picsim_height = 40;
      
      if ( trim($realestateSimilarity->pic_oreginal_id)<>"") 
      {       
         $pic = $realestateSimilarity->picOreginal->original_name; 
         $thumb = str_replace('_original'.substr($realestateSimilarity->picOreginal->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($realestateSimilarity->picOreginal->original_name,-4,4), $realestateSimilarity->picOreginal->original_name);          
      } else if( trim($realestateSimilarity->pic_detile_id)<>"" )
      {  
         $pic = $realestateSimilarity->picDetile->original_name; 
         $thumb = str_replace('_big'.substr($realestateSimilarity->picDetile->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($realestateSimilarity->picDetile->original_name,-4,4), $realestateSimilarity->picDetile->original_name); 
      } else if( trim($realestateSimilarity->pic_anons_id)<>"" )
      {  
         $pic = $realestateSimilarity->picAnons->original_name;  
         $thumb = str_replace('_original'.substr($realestateSimilarity->picAnons->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($realestateSimilarity->picAnons->original_name,-4,4), $realestateSimilarity->picAnons->original_name);                                 
      } else 
      {                  
         $thumb = '/images/no_foto.png';          
      }
            
      $picSrc = '/'.$pic;      
      $picThumb = '/'.$thumb;      
      
      if( !file_exists($picSrc) ) {
          $image = Yii::app()->image->load($pic);
          $image->resize(null,$thumb_picsim_height);
          $image->save($thumb); 
      }      
?>                                                                                                                                                 
<?php 
      echo CHtml::link( CHtml::image( $picThumb,'', array('title'=>'Cкриншот '.$realestateSimilarity->title )), 
                        array('realestates/view','id'=>$realestateSimilarity->id)
                        /*'/'.$realestateSimilarity->picOreginal->original_name*/, array('class'=>'fancyImage')); 
?>
                                       </td>  
                                      <td class="valign-m halign-r p-3" width="94" ><?php echo ceil($realestateSimilarity->area); ?></td>
                                      <td class="valign-m halign-r p-3" width="99" ><?php echo round($realestateSimilarity->price); ?> <b><small class="c-333"><?=$realestateSimilarity->valute->abbr;?></small></b></td>                                       
                                    </tr>  
                                    <? } ?>
                              </table>
                        </div> 
                       <? } ?>
                       <? if (trim($model->detile)<>'') { ?>
                        <div class="<?/*fr w-616*/?>">
                            <? if ($realestatesOthers) { ?>  
                             <h3 class="center c-fill m-5 fs-14 ff-tahoma"><b>О недвижимости:</b></h3>                             
                            <? } ?>  
                            <?php echo $model->detile; ?>                            
                        </div>
                      <? } ?>
                      <div class="clear"></div>
                    </div>
                </div>
            <? } ?>    
    </div>
    <div class="description p-5">
         <?php echo $model->description; ?>
    </div> 
    <div class="map p-5 m-5 radius-5 bg-blue">
         <?php echo $map; ?>
    </div> 
    <?if ($realestatesShogpreds) { ?> 
    <div class="shogpred p-5" >            
            <h2 class="bg-blue radius-5-0 p-5 m-b0">Схожие предложения</h2>
            <?php $this->beginWidget('ext.widgets.carousel.ECarouselWidget'); ?>
            <? foreach ( $realestatesShogpreds as $realestatesShogpred ) { ?>
            <li>
               <div id="item-shogpred-<?=$realestatesShogpred->id;?>" class="item-shogpred" >
                   <div class="pic radius-3 center" >
<?php 
      $thumb_picsim_width = 120;
      $thumb_picsim_height = 80;
      
      if ( trim($realestatesShogpred->pic_oreginal_id)<>"") 
      {       
         $pic = $realestatesShogpred->picOreginal->original_name; 
         $thumb = str_replace('_original'.substr($realestatesShogpred->picOreginal->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($realestatesShogpred->picOreginal->original_name,-4,4), $realestatesShogpred->picOreginal->original_name);          
      } else if( trim($realestatesShogpred->pic_detile_id)<>"" )
      {  
         $pic = $realestatesShogpred->picDetile->original_name; 
         $thumb = str_replace('_big'.substr($realestatesShogpred->picDetile->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($realestatesShogpred->picDetile->original_name,-4,4), $realestatesShogpred->picDetile->original_name); 
      } else if( trim($realestatesShogpred->pic_anons_id)<>"" )
      {  
         $pic = $realestatesShogpred->picAnons->original_name;  
         $thumb = str_replace('_original'.substr($realestatesShogpred->picAnons->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($realestatesShogpred->picAnons->original_name,-4,4), $realestatesShogpred->picAnons->original_name);                                 
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
      echo CHtml::link(CHtml::image( $picThumb,'Аренда/Офиса в Москве/Недвижимость - '.$realestatesShogpred->title, array('title'=>'Аренда/Офиса в Москве/Недвижимость - '.$realestatesShogpred->title, 'alt'=>'Аренда/Офиса в Москве/Недвижимость - '.$realestatesShogpred->title )), 
                       array('realestates/view','id'=>$realestatesShogpred->id),  
                        /*'/'.$realestatesShogpred->picOreginal->original_name*/ array('class'=>'fancyImage','title'=>'Аренда/Офиса в Москве/Недвижимость - '.$realestatesShogpred->title)); 
?>                       
                   </div>   
                   <div class="desc">
                       <div class="title">
                        <? echo CHtml::link('<b>'.$realestatesShogpred->title.'</b>',
                                  array('realestates/view','id'=>$realestatesShogpred->id,'title'=>'Аренда/Офиса в Москве/Недвижимость - '.$realestatesShogpred->title)
                                ); ?>
                        <? /*<a href="#" ><b><?=$realestatesShogpred->title;?></b></a>*/?>   
                       </div>
                       <div class="area c-333 p-2"><b><?=ceil($realestatesShogpred->area);?>&nbsp;м2</b></div>
                       <div class="price p-2"><b><?=round($realestatesShogpred->price,2);?>&nbsp;<?=$realestatesShogpred->valute->abbr;?></b></div>
                   </div>                   
               </div>  
            </li> 
            <? } ?>
            <?php $this->endWidget(); ?>
            <?/* <div class="clear"></div>*/?>
    </div>
    <? } ?>
 </div>     
 <div class="halign-l p-l5">
    <a class="button back" href="javascript:history.back();">Назад</a>
 </div>
    <?/*<div class="slider-wrapper theme-default">
	    <div id="slider">*/   
        /*$this->widget('application.extensions.nivoslider.CNivoSlider', 
                  array( 'images'=>$afotos,
                         'fancy'=>false, 
                         'themes'=>'default',
                         'htmlOptions'=>array('id'=>'slider','style'=>'width: 456px; height: 308px;'),
                         'config'=>array(
                                'directionNav'=>true,
				'directionNavHide'=>true,
				'controlNav'=>true,
				'keyboardNav'=>true,
				'pauseOnHover'=>true,
				'manualAdvance'=>true,
                                'controlNavThumbs'=>true,
                                'controlNavThumbsFromRel'=>true ,
                                'effect'=>'random', // Specify sets like: 'fold,fade,sliceDown'
                                'slices'=>15, // For slice animations
                                'boxCols'=>5, // For box animations
                                'boxRows'=>1, // For box animations
                                'controlNavThumbsSearch'=>'.jpg', // Replace this with...
                                'controlNavThumbsReplace'=>'_src.jpg', // ...this in thumb Image src
                         )               
                       )
        );
       </div>
    </div>*/?>
 </div>
 <div id="pdf" class="print">
 </div>    
<?
    $js = " $(document).ready(function() {

               /*$('img[longdesc]').each(function(index) {
                   if (index) {
                       $('#wrap').append('<a href=\"'+$(this).attr('longdesc')+'\" rel=\"fancy-gallery\" index=\"'+index+'\" class=\"fancy-gallery\" style=\"display:none\"><img src=\"'+$(this).parent().attr('href')+'\" /></a>');                 
                   } 
               });           
               $('.ad-image-wrapper a').attr('rel','fancy-gallery');           
               $(\"a[rel='fancy-gallery']\").fancybox();*/

               $('.ad-image-wrapper a').live('mouseover', function(){	
		$(this).fancybox({'overlayShow': true, 'hideOnContentClick': true, /*'showCloseButton':false*/}); 
               });

               $('.ad-thumbs a').click( function() {

                  //$('.ad-image-wrapper a').attr('rel','fancy-gallery');           
                  //$('a img[src='+$(this).attr('href')+']).delete();

                  $('.ad-image-wrapper a').fancybox({'overlayShow': true, 'hideOnContentClick': true, /*'showCloseButton':false*/});  
               });

               $('.ad-prev').click( function() {
                  //$('.ad-image-wrapper a').attr('rel','fancy-gallery');             
                  $('.ad-image-wrapper a').fancybox({'overlayShow': true, 'hideOnContentClick': true, /*'showCloseButton':false*/});  
               });           

               $('.ad-next').click( function() {
                  //$('.ad-image-wrapper a').attr('rel','fancy-gallery');           
                  $('.ad-image-wrapper a').fancybox({'overlayShow': true, 'hideOnContentClick': true, /*'showCloseButton':false*/});  
               });   
               //$('.fancyImage').fancybox({'overlayShow': true, 'hideOnContentClick': false});    
               

               $('#realestate_pdf').fancybox({
                      'href': '/index.php/ru/realestates/pdf/".$model->id.".html',
                      'width': 940, 
                      'height':600, 
                      'type': 'iframe',                                
                      'frameWidth' : 940, 
                      'frameHeight': 600, 
                      'overlayShow': true, 
                      'hideOnContentClick': false});                               
                      
              });         
    ";
    Yii::app()->getClientScript()->registerScript('adGalleryfansy'.$this->getId(), $js, CClientScript::POS_READY);
?>

<?
    $js_mfansybox = "
            $('.ad-image-wrapper a').fancybox({'overlayShow': true, 'hideOnContentClick': true, /*'showCloseButton':false*/});
        ";               
    Yii::app()->getClientScript()->registerScript('mfansybox'.$this->getId(), $js_mfansybox, CClientScript::POS_END);
?>

<?    
    $js_security = "                
                document.onselectstart=function(){return false}
                document.oncontextmenu=function(){return false}
                document.onmousedown=function(){return false}
               ";

    Yii::app()->getClientScript()->registerScript('Security'.$this->getId(), $js_security, CClientScript::POS_HEAD);
?>        