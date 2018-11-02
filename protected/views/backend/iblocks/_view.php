<div class="view"> 
    <div class="left-col fl p-r12" >
       <div id="iblock-pic-oreginal" class="iblock-pic" >
         <div class="picture"> 
        <?php 

              $pic_width  ="280";
              $pic_height ="";

              if ( trim($data->pic_oreginal_id)<>"" ) 
              {   
                 $pathfrompic = str_replace('_original'.substr($data->picOreginal->original_name,-4,4),
                                            '_big'.substr($data->picOreginal->original_name,-4,4),
                                            $data->picOreginal->original_name); 

                 $pathtopic = str_replace('_original'.substr($data->picOreginal->original_name,-4,4),
                                          '_'.$pic_width.'x'.$pic_height.substr($data->picOreginal->original_name,-4,4),
                                          $data->picOreginal->original_name); 

                 $picOreginal = '/'.$pathtopic; 

                 if( !file_exists($picOreginal) ) {
                     $image = Yii::app()->image->load($pathfrompic);
                     /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                     $image->resize($pic_width,null);
                     $image->save($pathtopic); // or $image->save('images/small.jpg');
                 }

                 echo CHtml::link(CHtml::image( $picOreginal,'', 
                      array('title'=>$data->picOreginal->name, 'width'=>$pic_width."px" )), 
                             //'/'.$fav->picOreginal->original_name, 
                            '/'.$data->picOreginal->original_name, 
                            array('class'=>'fancyImage'));

             } else { 
                 echo CHtml::link(CHtml::image( '/images/no_foto.png','', 
                      array('title'=>Yii::t('all','Без фото'),
                            'style'=>"width:280px;height:187px"),
                            array('iblocks/view','id'=>$data->id)
                      ));

             }
         ?>           
         </div>
       </div> 
    </div>
    <div class="right-col fl w-396 ff-tahoma" >
        <div class="title tahoma fs-14 ff-Arial">            
            <div class="name p-r10 c-bled fl" >
                <b><?php echo CHtml::encode($data->name); ?></b>
            </div>
            <div class="id p-r10 fr">
                    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
                    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>                
            </div>    
            <div class="clear" ></div>

        </div>
        <div class="visname p-t5">
            <b><?php echo CHtml::encode($data->getAttributeLabel('sid')); ?>:</b>
            <?php echo CHtml::encode($data->sid); ?>
        </div>
        <div class="uid p-t2">
            <b><?php echo CHtml::encode($data->getAttributeLabel('nid')); ?>:</b>
            <?php echo CHtml::link(CHtml::encode($data->nid), array('view', 'id'=>$data->nid)); ?>
        </div>
        <div class="type p-t2">
            <b><?php echo Yii::t('label','Type of the infoblock'); ?>:</b>
                <?php echo CHtml::encode($data->types_iblocks_id ? $data->typesIblock->desc : 'не указан') ?>
        </div>
        <div class="section p-t2">
                <b><?php echo Yii::t('label','Section'); ?>:</b>&nbsp;<?php echo ($data->grid ? CHtml::encode($model->section->title) : 'не указан'); ?>
        </div>      
        <div class="action p-t2">
            	<b><?php echo CHtml::encode($data->getAttributeLabel('action')); ?>:</b>
                <?php echo ($data->action ? CHtml::encode($data->action) : 'не указана'); ?>	            
        </div>
        <div class="desc p-t2">     
	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />*/?>

	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />*/?>

	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('grid')); ?>:</b>
	<?php echo CHtml::encode($data->grid); ?>
	<br />*/?>

	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />*/?>

        <?/*<b><?php echo CHtml::encode($data->getAttributeLabel('visname')); ?>:</b>
	<?php echo CHtml::encode($data->visname); ?>
	<br />*/?>

	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keywords')); ?>:</b>
	<?php echo CHtml::encode($data->keywords); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />*/?>
            <b><?php echo CHtml::encode($data->getAttributeLabel('anons')); ?>:</b>
            <p class="p-t5"> 
            <?php echo CHtml::encode($data->anons); ?>
            </p>
        </div>
	<?/*<b><?php echo CHtml::encode($data->getAttributeLabel('pic_anons')); ?>:</b>
	<?php echo CHtml::encode($data->pic_anons); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pic_detile')); ?>:</b>
	<?php echo CHtml::encode($data->pic_detile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('act')); ?>:</b>
	<?php echo CHtml::encode($data->act); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('del')); ?>:</b>
	<?php echo CHtml::encode($data->del); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createusers')); ?>:</b>
	<?php echo CHtml::encode($data->createusers); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdate')); ?>:</b>
	<?php echo CHtml::encode($data->createdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateusers')); ?>:</b>
	<?php echo CHtml::encode($data->updateusers); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatedate')); ?>:</b>
	<?php echo CHtml::encode($data->updatedate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detile')); ?>:</b>
	<?php echo CHtml::encode($data->detile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sort')); ?>:</b>
	<?php echo CHtml::encode($data->sort); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cid')); ?>:</b>
	<?php echo CHtml::encode($data->cid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_main')); ?>:</b>
	<?php echo CHtml::encode($data->is_main); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_pay')); ?>:</b>
	<?php echo CHtml::encode($data->is_pay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_arhiv')); ?>:</b>
	<?php echo CHtml::encode($data->is_arhiv); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_use')); ?>:</b>
	<?php echo CHtml::encode($data->is_use); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maps_id')); ?>:</b>
	<?php echo CHtml::encode($data->maps_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('types_iblocks_id')); ?>:</b>
	<?php echo CHtml::encode($data->types_iblocks_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url_detile')); ?>:</b>
	<?php echo CHtml::encode($data->url_detile); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('url_list')); ?>:</b>
	<?php echo CHtml::encode($data->url_list); ?>
	<br /> 

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visible')); ?>:</b>
	<?php echo CHtml::encode($data->visible); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('action')); ?>:</b>
	<?php echo CHtml::encode($data->action); ?>
	<br />

	*/ ?>
   </div>    
    <div class="clear"></div> 
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