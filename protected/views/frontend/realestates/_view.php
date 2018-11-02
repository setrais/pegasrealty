<div class="view"> 
  <div>
    <div class="left-col" >
        <div class="pic"> 
        <?php
              $thumb_picsim_width = 115;
              $thumb_picsim_height = 80;

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
                        array('title'=>($data->seo_title ? $data->seo_title : $data->picOreginal->name) )), 
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
    </div>    

    <div class="right-col" >
        <?/*<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>*/?>
        <div>
            <h3 class="ads m-0 p-0 m-b1" ><span class="ed"><?php echo CHtml::link(CHtml::encode($data->title), array('realestates/view', 'id'=>$data->id)); ?></span></h3>
            <div class="ids fs-12" ><b>
                <?php echo Yii::t('all','№'); ?>:</b>
                <?php echo CHtml::link(CHtml::encode($data->nid), array('realestates/view', 'id'=>$data->id)); ?>                              
            </div>
            <div class="clear"></div>
        </div>                        
        <?php// echo CHtml::encode($data->district->desc); ?>
        <p class="anons m-0 p-b1 fs-10">
            <?php echo CHtml::encode(HRu::cutstr($data->anons,780)); ?>
        </p>
        <p class="m-0 m-b1 fs-10">
            <b><?php echo CHtml::encode($data->getAttributeLabel('district_id')); ?>:</b>
            <?php echo CHtml::encode($data->district->title); ?><?php// echo CHtml::encode($data->district->desc); ?>;                    
            <b><?php echo CHtml::encode($data->getAttributeLabel('metro_id')); ?>:</b>
            <?php echo CHtml::encode($data->metro->title); ?>;
            <b><?php echo CHtml::encode($data->getAttributeLabel('remoteness')); ?>:</b>
            <?php echo CHtml::encode(round($data->remoteness)); ?>
            <span class="ed"   ><?php echo CHtml::encode($data->unit->short_title); ?></span>;            
            <b><?php// echo CHtml::encode($data->getAttributeLabel('realestate_vid_id')); ?><?php echo Yii::t('all','View');?>:</b>
            <?php echo CHtml::encode($data->realestateVid->title); ?>        
            <b><?php echo Yii::t('all','класса'); ?></b>
            <span class="ed" ><?php echo CHtml::encode($data->realestateClass->abbr); ?></span>;       
            <?php $props = CHtml::listData(Properties::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'title'); 
            ?> 
            <b><?php echo CHtml::encode(Yii::t('all','Свойства недвижимости')); ?>:</b>
            <?php 
              $cnt=count($data->realestateProperties);
              foreach ($data->realestateProperties as $key=>$realestatePropertie) { 
                 if ($cnt<>($key+1)) echo CHtml::encode($props[$realestatePropertie->property_id])."/";
                 else echo CHtml::encode($props[$realestatePropertie->property_id]);
              } 
            ?> 	        
            <b><?php echo CHtml::encode($data->getAttributeLabel('area')); ?>:</b>
            <?php echo CHtml::encode(round($data->area)); ?>
            <span class="ed" ><?php echo Yii::t('all','м2'); ?></span>;
            <b><?php echo CHtml::encode($data->getAttributeLabel('planning_id')); ?>:</b>
            <?php echo CHtml::encode($data->planning->title); ?>;
            <?php /* Отделка не учтена */ ?>
            <?php /* Телекоммуникации */ ?>
            <?php /* Охрана */?>        
        
            <b><?php echo CHtml::encode($data->getAttributeLabel('parking_id')); ?>:</b>
            <span style="text-transform:lowercase;"><?php echo CHtml::encode($data->parking->title); ?>-</span>	
            <?php echo CHtml::encode($data->cnt_parking_place); ?>
            <span class="ed"><?=Yii::t('all','м/м');?></span>;
        
            <?php /* Стоимость парковки */ ?>
        
            <b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
            <?php echo CHtml::encode(round($data->price)); ?>
            <span class="ed"><?php echo CHtml::encode($data->valute->abbr); ?></span>
            <?=Yii::t('all','кв/м в год');?>;
        
            <b><?php echo CHtml::encode($data->getAttributeLabel('tax_id')); ?>:</b>
            <?php echo CHtml::encode($data->tax->abbr); ?> 
        </p>        
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