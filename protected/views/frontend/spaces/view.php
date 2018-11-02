<?php
$this->breadcrumbs=array(
	Yii::t('all','Spaces')=>array('index'),
	$model->title,
);
?>
<?php 
      $props = CHtml::listData(Properties::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'); 
      $cnt=count($model->spaceProperties);
      $listProperties='';
      foreach ($model->spaceProperties as $key=>$spacePropertie) { 
          if ($cnt<>($key+1)) $listProperties.= CHtml::encode($props[$spacePropertie->property_id])
                                                   .'<span class="ed" >/</span>';
          else $listProperties.= CHtml::encode($props[$spacePropertie->property_id]);
      } 
?>    
<?       
    $spaceFotos=array();
    foreach ($model->spaceFotos as $key=>$spaceFoto) $spaceFotos[] = $spaceFoto->file_id; 
      if (!empty($spaceFotos)) {
                          $fotos = Files::model()->findAll('id in ('.implode(",",$spaceFotos).')');                          
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
              
              if( !file_exists($picRes) ) {
                  $image = Yii::app()->image->load($src);
                 /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                  $image->resize($pic_width,null);
                  $image->save($res); // or $image->save('images/small.jpg');
              }
              
              if( !file_exists($picThumb) ) {
                  $image = Yii::app()->image->load($src);
                 /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                  $image->resize(null,$thumb_height,null);
                  $image->save($thumb); // or $image->save('images/small.jpg');
              }
                            
              $afotos[]=array('image_url'=>$picRes,'thumb_url'=>$picThumb, /*'title'=>$foto->name, 'alt'=>$foto->name,*/ 'link'=>$picSrc);              
           } 
       ?>

<?php } ?>
<?php 
     // Схожие предложения     
     //print_r($model->spacesSimilarities);
?> 
<div id="content" class="p-b0">
<div class="content" >    
    <div class="title" >    
        <div class="fl">            
            <h1>
                <?php echo $model->title; ?><?php// echo Yii::t('all','View Spaces');?>
            </h1>
        </div>    
        <div class="fl p-l16 lh-30">
           <?php 
                   echo CHtml::ajaxLink(CHtml::image( '/images/mail-send.png','', 
                                    array('title'=>'Отправить '.$model->title)), 
                        array('spaces/createfavsend','id'=>$model->id),
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
                                     '#',array('id'=>'space_pdf', 'class'=>'pdf', 'title'=>'print')
                                   );
           ?>             
           <?php 
                   echo CHtml::ajaxLink(CHtml::image( '/images/addtofav.png','', 
                                    array('title'=>'Добавить в избранное '.$model->title)), 
                        array( 'spaces/favadd','id'=>$model->id),
                        array( 'success'=>"js: function(data) {       
                               $.pnotify({
                                pnotify_width: 100,
                                pnotify_nonblock: true,
                                pnotify_title: 'Информация', 
                                pnotify_text: 'Недвижемость №'+data+' успешно!<br/>добавлена в избранное',
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
              <?php// $this->renderPartial('/spaces/_social');?>
        </div>*/?>         
        <?php $this->renderPartial('_send',array('model'=>$model_claim));?> 
        <div class="fr fs-22 c-333">            
            <a class="button back" href="javascript:history.back();">Назад</a>
            <span>№<?php echo $model->nid; ?> ID:<?php echo $model->id; ?></span>
        </div>
        <div class="clear"></div>
    </div>         
    <div class="item" >
        <div class="props w-454 fl mh-438 radius-5 bg-blue" style="margin-top:7px;" >
             <div class="bg-blue radius-5-0 p-5 m-l1-r1" >                
             </div>
             <?/*<h2>Свойства недвижемости:</h2>*/?>       
             <div>
             <?php $this->widget('zii.widgets.CDetailView', array(
                        'data'=>$model,
                        'attributes'=>array(              
                                /*'address',*/
                                array( 'name'=>'operation.title',
                                       'label'=>Yii::t('label','Operation'),                    
                                ),
                                array( 'name'=>'spaceType.title',
                                       'label'=>Yii::t('label','Space Type'),                    
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
                                array( 'name'=>'spaceVid.title',
                                       'label'=>Yii::t('label','Space Vid'),                    
                                ),  
                                array( 'name'=>'spaceClass.abbr',
                                       'label'=>Yii::t('label','Space Class'),                    

                                ),
                                array( 'name'=>'planning.title',
                                       'label'=>Yii::t('label','Planning'),                                                               
                                ),
                                array( 'name'=>'coefficient_corridor',
                                       'value'=>($model->coefficient_corridor===null ? 'не указан' : $model->coefficient_corridor),
                                ),
                                 array( 'name'=>'is_separate_entrance',
                                        'value'=>($model->is_separate_entrance ? 'да' : 'нет'),
                                ),                                
                                array( 'name'=>'area',
                                       'type'=>'html',
                                       'value'=>round($model->area)
                                               .' <span class="ed">'.Yii::t('all','м2').'</span>',
                                ),                  
                                array( 'name'=>'price',
                                       'type'=>'html',
                                       'value'=>round($model->price).' <span class="ed">'.$model->valute->abbr.'</span>',
                                ),                         
                                array( 'name'=>'tax.abbr',
                                       'label'=>Yii::t('label','Tax'),                       
                                ), 
                                array( 'name'=>'parking.title',
                                       'label'=>Yii::t('label','Parking'),
                                       'type'=>'html',
                                       'value'=>'<span style="text-transform: lowercase;">'
                                                    .$model->parking->title.'</span> - '
                                                    .'<b>'.$model->cnt_parking_place.'</b> '
                                                    .' <span class="ed">'.Yii::t('all','м/м').' </span>',
                                ),  
                                /*array( 'name'=>'spaceProperties',
                                       'label'=>'Свойства',//Yii::t('label','Space Properties'),
                                       'type'=>'html',
                                       'value'=>$listProperties,
                                ),*/                                
                                /*array( 'name'=>'district.title',
                                       'label'=>Yii::t('label','District'),
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
            <?php $this->renderPartial('/spaces/_social');?>
        </div>    
        <div class="clear"></div>
    </div>
    <div class="detile">
            <? if ( trim($model->anons)<>'' && $model->spacesSimilarities ) { ?>
                <h2 class="bg-blue radius-5-0 p-5">О недвижемости</h2> 
                <div class="p-5">
                    <?/* if ( trim($model->anons)<>'' ) { ?>
                    <p><?php echo $model->anons; ?></p>
                    <? } */?>
                    <div class="hait">
                      <? $spacesSimilarities=$model->with('spacesSimilarities')->findAll("space_linking_id=1"); ?>                        
                      <? $spacesSimilarities=$model->spacesSimilarities; ?>                        
                      <? $spacesShogpreds=$model->with('spacesSimilarities')->findAll("space_linking_id=2"); ?>                        
                      <? $spacesShogpreds=$model->spacesSimilarities; ?>
                      <?// print_r($spacesSimilarities);?>  
 
                       <?if ($spacesSimilarities) { ?>  
                        <div class="other-area fr w-310 <?/*m-r14*/?>">
                                <h3 class="center c-fill <?/*m-5*/?> fs-14 ff-tahoma"><b>Другая площадь:</b></h3>
                                <table class="tshap">
                                    <tr>
                                        <th class="valign-m halign-c p-3" width="79" >Cкриншот</th>
                                        <th class="valign-m halign-r p-3" width="93" >Площадь <b>м2</b></th>
                                        <th class="valign-m halign-r p-3" >Стоимость</th>                                        
                                    </tr>
                                </table>
                                <table class="tbody">
                                 <? foreach ( $spacesSimilarities as $spaceSimilarity ) { ?>                                                                                                                          
                                    <tr>
                                      <td class="valign-m halign-c p-3" width="78" >                                                
<?php 
      //$thumb_picsim_width = 100;
      $thumb_picsim_height = 40;
      
      if ( trim($spaceSimilarity->pic_oreginal_id)<>"") 
      {       
         $pic = $spaceSimilarity->picOreginal->original_name; 
         $thumb = str_replace('_original'.substr($spaceSimilarity->picOreginal->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($spaceSimilarity->picOreginal->original_name,-4,4), $spaceSimilarity->picOreginal->original_name);          
      } else if( trim($spaceSimilarity->pic_detile_id)<>"" )
      {  
         $pic = $spaceSimilarity->picDetile->original_name; 
         $thumb = str_replace('_big'.substr($spaceSimilarity->picDetile->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($spaceSimilarity->picDetile->original_name,-4,4), $spaceSimilarity->picDetile->original_name); 
      } else if( trim($spaceSimilarity->pic_anons_id)<>"" )
      {  
         $pic = $spaceSimilarity->picAnons->original_name;  
         $thumb = str_replace('_original'.substr($spaceSimilarity->picAnons->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($spaceSimilarity->picAnons->original_name,-4,4), $spaceSimilarity->picAnons->original_name);                                 
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
      echo CHtml::link( CHtml::image( $picThumb,'', array('title'=>'Cкриншот '.$spaceSimilarity->title )), 
                        array('spaces/view','id'=>$spaceSimilarity->id)
                        /*'/'.$spaceSimilarity->picOreginal->original_name*/, array('class'=>'fancyImage')); 
?>
                                       </td>  
                                      <td class="valign-m halign-r p-3" width="94" ><?php echo ceil($spaceSimilarity->area); ?></td>
                                      <td class="valign-m halign-r p-3" width="99" ><?php echo round($spaceSimilarity->price); ?> <b><small class="c-333"><?=$spaceSimilarity->valute->abbr;?></small></b></td>                                       
                                    </tr>  
                                    <? } ?>
                              </table>
                        </div>   
                        <div class="<?/*fr w-616*/?>">
                             <h3 class="center c-fill m-5 fs-14 ff-tahoma"><b>Описание недвижемости:</b></h3>                             
                             <?php echo $model->detile; ?>                            
                        </div>
                        <div class="clear"></div>
                        <? } ?>
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
    <?if ($spacesShogpreds) { ?> 
    <div class="shogpred p-5" >            
            <h2 class="bg-blue radius-5-0 p-5 m-b0">Схожие предложения</h2>
            <?php $this->beginWidget('ext.widgets.carousel.ECarouselWidget'); ?>
            <? foreach ( $spacesShogpreds as $spacesShogpred ) { ?>
            <li>
               <div id="item-shogpred-<?=$spacesShogpred->id;?>" class="item-shogpred" >
                   <div class="pic radius-3 center" >
<?php 
      $thumb_picsim_width = 120;
      $thumb_picsim_height = 80;
      
      if ( trim($spacesShogpred->pic_oreginal_id)<>"") 
      {       
         $pic = $spacesShogpred->picOreginal->original_name; 
         $thumb = str_replace('_original'.substr($spacesShogpred->picOreginal->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($spacesShogpred->picOreginal->original_name,-4,4), $spacesShogpred->picOreginal->original_name);          
      } else if( trim($spacesShogpred->pic_detile_id)<>"" )
      {  
         $pic = $spacesShogpred->picDetile->original_name; 
         $thumb = str_replace('_big'.substr($spacesShogpred->picDetile->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($spacesShogpred->picDetile->original_name,-4,4), $spacesShogpred->picDetile->original_name); 
      } else if( trim($spacesShogpred->pic_anons_id)<>"" )
      {  
         $pic = $spacesShogpred->picAnons->original_name;  
         $thumb = str_replace('_original'.substr($spacesShogpred->picAnons->original_name,-4,4),
                     '_'.$thumb_picsim_width.'x'.$thumb_picsim_height.substr($spacesShogpred->picAnons->original_name,-4,4), $spacesShogpred->picAnons->original_name);                                 
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
      echo CHtml::link(CHtml::image( $picThumb,'', array('title'=>'Cкриншот '.$spacesShogpred->title )), 
                       array('spaces/view','id'=>$spacesShogpred->id),  
                        /*'/'.$spacesShogpred->picOreginal->original_name*/ array('class'=>'fancyImage')); 
?>                       
                   </div>   
                   <div class="desc">
                       <div class="title">
                        <? echo CHtml::link('<b>'.$spacesShogpred->title.'</b>',
                                  array('spaces/view','id'=>$spacesShogpred->id)
                                ); ?>
                        <? /*<a href="#" ><b><?=$spacesShogpred->title;?></b></a>*/?>   
                       </div>
                       <div class="area c-333 p-2"><b><?=ceil($spacesShogpred->area);?>&nbsp;м2</b></div>
                       <div class="price p-2"><b><?=round($spacesShogpred->price,2);?>&nbsp;<?=$spacesShogpred->valute->abbr;?></b></div>
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
               

               $('#space_pdf').fancybox({
                      'href': '/index.php/ru/spaces/pdf/".$model->id.".html',
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