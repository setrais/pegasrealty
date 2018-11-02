<div class="view"> 
  <div>
    <div class="left-col" >
       <div id="space-pic-oreginal" class="space-pic" >
         <div class="pic"> 
        <?php 
            if ( trim($data->pic_oreginal_id)<>"" ) 
            {            
                $picOreginal = '/'.str_replace('_original'.substr($data->picOreginal->original_name,-4,4),
                                                '_big'.substr($data->picOreginal->original_name,-4,4),
                                                $data->picOreginal->original_name); 
                echo CHtml::link(CHtml::image( $picOreginal,'', 
                        array('title'=>$data->picOreginal->name )), 
                              '/'.$data->picOreginal->original_name, 
                              array('class'=>'fancyImage'));

            } else { 
                echo CHtml::link(CHtml::image( '/images/no_foto.png','', 
                        array('title'=>Yii::t('all','Без фото'),
                              'style'=>"height:160px;")
                             )
                     );

            }
         ?>             
         </div>
       </div> 
       <?php $spaceFotos=array();
       foreach ($data->spaceFotos as $key=>$spaceFoto) $spaceFotos[] = $spaceFoto->file_id; 
         if (!empty($spaceFotos)) {
                          $fotos = Files::model()->findAll('id in ('.implode(",",$spaceFotos).')');                          
       ?>
       <div class="block-fotos" >
       <?php                         
           foreach ($fotos as $key=>$foto) {
              $picFoto = '/'.str_replace('_original'.substr($foto->original_name,-4,4),
                             '_src'.substr($foto->original_name,-4,4),
                             $foto->original_name); 
       ?>                                                
          <div id="space-fotos-<?=$spaceFoto->id;?>" class="space-fotos">
            <div class="fotos" >
            <?php                
                echo CHtml::link(CHtml::image( $picFoto, '', 
                                   array('title'=>$foto->name)),                                                       
                                     '/'.$foto->original_name, 
                                     array('class'=>'fancySladeShow',
                                           'rel'=>"spaceFotos".$spaceFoto->id,
                                           'title'=>$foto->name));                           
            ?>                       
            </div>
          </div>
   <?php   } ?>
          <script>
                $(document).ready(function() {
                   //$(".fancySladeShow").attr("rel","spaceFotos<?=$spaceFoto->id;?>"); 
                   $(".fancySladeShow[rel=spaceFotos<?=$spaceFoto->id;?>]").fancybox({
                                    'showCloseButton': true,
                                    'overlayShow' : true,
                                    'transitionIn': 'none',
                                    'transitionOut'		: 'none',
                                    'titlePosition' 	: 'over',
                                    'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
                                                                return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                                                              }                                   
                   });                        
                }); 
           </script>   
         </div>
   <?php } ?>
   <?php $spacePresentations=array();
      foreach ($data->spacePresentations as $key=>$spacePresentation) $spacePresentations[] = $spacePresentation->file_id; 
        if (!empty($spacePresentations)) {
                $presentations = Files::model()->findAll('id in ('.implode(",",$spacePresentations).')');
   ?>               
        <div class="presents" >
        <?php foreach ($presentations as $key=>$presentation) { ?>

           <div id="space-presentations-<?=$spacePresentation->id;?>" class="space-presentations">
               <div class="presentations">
               <?php
                   echo CHtml::link( $presentation->name, 
                    'http://'.$_SERVER["SERVER_NAME"].'/'.$presentation->original_name, 
                    array('title'=>$presentation->name,
                        'style'=>'padding-right:10px;vertical-align:middle',
                        'class'=>'fancyFrame iframe'));                            
                ?>
               </div> 
            </div>    
        <?php } ?>                         
        </div>
    <?php } ?>                           
        
    </div>    

    <div class="right-col" >
        <?/*<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>*/?>
        <div>
            <div class="ads" >
            <span class="ed"><?php echo CHtml::encode($data->title); ?></span>
            <br />           
            <b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
            <span class="ed"><?php echo CHtml::encode($data->address); ?></span>
            <br />
            </div>
            <div class="ids" >
                <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
                <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>&nbsp;	                
                <b><?php echo Yii::t('all','№'); ?>:</b>
                <?php echo CHtml::link(CHtml::encode($data->nid), array('view', 'id'=>$data->id)); ?>                              
            </div>
            <div class="clear"></div>
        </div>
                
        <?php// echo CHtml::encode($data->district->desc); ?>
        <p class="anons"><?php echo CHtml::encode($data->anons); ?></p>
        
                <b><?php echo CHtml::encode($data->getAttributeLabel('district_id')); ?>:</b>
	<?php echo CHtml::encode($data->district->title); ?>
        <?php// echo CHtml::encode($data->district->desc); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('metro_id')); ?>:</b>
	<?php echo CHtml::encode($data->metro->title); ?>
	<br />        

	<b><?php echo CHtml::encode($data->getAttributeLabel('remoteness')); ?>:</b>
	<?php echo CHtml::encode(round($data->remoteness)); ?>
        <span class="ed"   ><?php echo CHtml::encode($data->unit->short_title); ?></span>
	<br />

        <?/*
	<b><?php echo CHtml::encode($data->getAttributeLabel('number_tax')); ?>:</b>
	<?php echo CHtml::encode($data->number_tax); ?>
	<br />*/?>

        <b>
          <?php// echo CHtml::encode($data->getAttributeLabel('space_vid_id')); ?>
          <?php echo Yii::t('all','View');?>:
        </b>
	<?php echo CHtml::encode($data->spaceVid->title); ?>        
        <b><?php echo Yii::t('all','класса'); ?></b>
        <span class="ed" ><?php echo CHtml::encode($data->spaceClass->abbr); ?></span>        
	<br />
        <?php $props = CHtml::listData(Properties::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'); 
        ?> 
        <b><?php echo CHtml::encode(Yii::t('all','Свойства')); ?>:</b>
        <?php 
              $cnt=count($data->spaceProperties);
              foreach ($data->spaceProperties as $key=>$spacePropertie) { 
                 if ($cnt<>($key+1)) echo CHtml::encode($props[$spacePropertie->property_id])."/";
                 else echo CHtml::encode($props[$spacePropertie->property_id]);
              } 
        ?>	        
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area')); ?>:</b>
	<?php echo CHtml::encode(round($data->area)); ?>
        <span class="ed" ><?php echo Yii::t('all','м2'); ?></span>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('planning_id')); ?>:</b>
	<?php echo CHtml::encode($data->planning->title); ?>
	<br />
        <?php /* Отделка не учтена */ ?>
        <?php /* Телекоммуникации */ ?>
        <?php /* Охрана */?>
        
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('parking_id')); ?>:</b>
	<span style="text-transform:lowercase;"><?php echo CHtml::encode($data->parking->title); ?>-</span>	
	<?php echo CHtml::encode($data->cnt_parking_place); ?>
        <span class="ed"><?=Yii::t('all','м/м');?></span>
	<br />
        
        <?php /* Стоимость парковки */ ?>
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode(round($data->price)); ?>
        <span class="ed"><?php echo CHtml::encode($data->valute->abbr); ?></span>
        <?=Yii::t('all','кв/м в год');?>
        <br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('tax_id')); ?>:</b>
	<?php echo CHtml::encode($data->tax->abbr); ?>
	<br />

    </div>
    <div class="clear"></div>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('space_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->space_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('space_class_id')); ?>:</b>
	<?php echo CHtml::encode($data->space_class_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('space_vid_id')); ?>:</b>
	<?php echo CHtml::encode($data->space_vid_id); ?>
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

<script>
    $(document).ready(function() {
    $(".fancyImage").fancybox(
       {'overlayShow': true, 'hideOnContentClick': false});
    }); 
</script>  
<script>
    $(document).ready(function() {
          $(".fancyFrame").fancybox(
                        {'width': 800, 'height':600, 'frameWidth' : 800, 'frameHeight': 600, 'overlayShow': true, 'hideOnContentClick': false});
    }); 
</script>  