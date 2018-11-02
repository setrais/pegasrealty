<?php
$this->breadcrumbs=array(
	Yii::t('all','Iblocks')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('menu','List Iblocks'), 'url'=>array('index')),
	array('label'=>Yii::t('menu','Create Iblocks'), 'url'=>array('create')),
	array('label'=>Yii::t('menu','Update Iblocks'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('menu','Delete Iblocks'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('menu','Manage Iblocks'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('menu','View Iblocks');?> №<?php echo $model->id; ?></h1>

<?php 
      if ( trim($model->pic_oreginal_id)<>"" && $model->is_resize ) 
      {       
         $picScr = '/'.str_replace('_original'.substr($model->picOreginal->original_name,-4,4),
                     '_src'.substr($model->picOreginal->original_name,-4,4), $model->picOreginal->original_name); 
                
         $HpicScr = CHtml::link(CHtml::image( $picScr,'', array('title'=>$model->picOreginal->name )), 
                    '/'.$model->picOreginal->original_name, array('class'=>'fancyImage'));

      } else if( trim($model->pic_scr_id)<>"" && !$model->is_resize )
      {           
         $picScr = '/'.str_replace('_original'.substr($model->picScr->original_name,-4,4),
                     '_src'.substr($model->picScr->original_name,-4,4), $model->picScr->original_name); 
                
         $HpicScr = CHtml::link(CHtml::image( $picScr,'', array('title'=>$model->picScr->name )), 
                    '/'.$model->picOreginal->original_name, array('class'=>'fancyImage'));
                
      } else 
      {          
         $HpicScr = CHtml::link(CHtml::image( '/images/no_foto.png','', array('title'=>Yii::t('all','Без фото'),
                                        'style'=>"height:40px;") ));          
      }
?>  

<?php 
      if ( trim($model->pic_oreginal_id)<>"" && $model->is_resize ) 
      {       
         $picAnons = '/'.str_replace('_original'.substr($model->picOreginal->original_name,-4,4),
                     '_small'.substr($model->picOreginal->original_name,-4,4), $model->picOreginal->original_name); 
                
         $HpicAnons = CHtml::link(CHtml::image( $picAnons,'', array('title'=>$model->picOreginal->name )), 
                        '/'.$model->picOreginal->original_name, array('class'=>'fancyImage'));

      } else if( trim($model->pic_anons_id)<>"" && !$model->is_resize )
      {           
         $picAnons = '/'.str_replace('_original'.substr($model->picAnons->original_name,-4,4),
                     '_small'.substr($model->picAnons->original_name,-4,4), $model->picAnons->original_name); 
                
         $HpicAnons = CHtml::link(CHtml::image( $picAnons,'', array('title'=>$model->picAnons->name )), 
                        '/'.$model->picOreginal->original_name, array('class'=>'fancyImage'));
                
      } else 
      {          
         $HpicAnons = CHtml::link(CHtml::image( '/images/no_foto.png','', array('title'=>Yii::t('all','Без фото'),
                                        'style'=>"height:80px;") ));          
      }
?>  

<?php 
      if ( trim($model->pic_oreginal_id)<>"" && $model->is_resize ) 
      {       
         $picDetile = '/'.str_replace('_original'.substr($model->picOreginal->original_name,-4,4),
                     '_big'.substr($model->picOreginal->original_name,-4,4), $model->picOreginal->original_name); 
                
         $HpicDetile = CHtml::link(CHtml::image( $picDetile,'', array('title'=>$model->picOreginal->name,
                                                                      'style'=>'width:480px;' )), 
                        '/'.$model->picOreginal->original_name, array('class'=>'fancyImage'));

      } else if( trim($model->pic_detile_id)<>"" && !$model->is_resize )
      {           
         $picDetile = '/'.str_replace('_original'.substr($model->picDetile->original_name,-4,4),
                     '_big'.substr($model->picDetile->original_name,-4,4), $model->picDetile->original_name); 
                
         $HpicDetile = CHtml::link(CHtml::image( $picDetile,'', array('title'=>$model->picDetile->name,
                                                                      'style'=>'width:480px;' )), 
                        '/'.$model->picOreginal->original_name, array('class'=>'fancyImage'));
                
      } else 
      {          
         $HpicDetile = CHtml::link(CHtml::image( '/images/no_foto.png','', array('title'=>Yii::t('all','Без фото'),
                                        'style'=>"width:480px;") ));          
      }
  ?>  

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'id',
            'uid',
            'nid',
            'sid',
            'name',
            array( 'name'=>'act',
                   'value'=>($model->act ? 'да' : 'нет') ), 
            array( 'name'=>'del',
                   'value'=>($model->del ? 'да' : 'нет') ),             
            'sort',
	    array( 'name'=>'is_main',
                   'value'=>($model->is_main ? 'да' : 'нет') ), 
	    array( 'name'=>'is_pay',
                   'value'=>($model->is_pay ? 'да' : 'нет') ),                 
	    array( 'name'=>'is_arhiv',
                   'value'=>($model->is_arhiv ? 'да' : 'нет') ),                                 
	    array( 'name'=>'is_use',
                   'value'=>($model->is_use ? 'да' : 'нет') ),                                                         
            array( 'name'=>'types_iblocks_id',
                   'label'=>Yii::t('label','Type of the infoblock'), 
                   'value'=>($model->types_iblocks_id ? $model->typesIblock->desc : 'не указан')
                 ),
            array( 'name'=>'grid',                   
                   'label'=>Yii::t('label','Section'), 
                   'value'=>($model->grid ? $model->section->title : 'не указан')
                 ),
             array( 'name'=>'picScr',
                    'type'=>'html',
                    'value'=>$HpicScr 
             ),
            'anons',
            array( 'name'=>'picAnons',
                       'type'=>'html',
                       'value'=>$HpicAnons 
                ),     
            array( 'name'=>'detile',
                    'type'=>'html',
                    'value'=>$model->detile 
            ),
            array( 'name'=>'picDetile',
                   'type'=>'html',
                   'value'=>$HpicDetile 
                ),                        
            array( 'name'=>'pic_oreginal_id',
                   'visible'=>false, ),                
            'title',
	    'keywords',
	    'description',	
            array( 'name'=>'createusers',
                   'value'=>($model->createusers ? $model->createUser->email : 'не указан')
                 ),
            array( 'label'=>Yii::t('label','Createdate'),                                        
                   'value'=>( $model->createdate==null ? null : date('d.m.Y', strtotime($model->createdate)))),
            array( 'name'=>'updateusers',
                   'value'=>($model->updateusers ? $model->updateUser->email : 'не указан')
                 ),            
            array( 'label'=>Yii::t('label','Updatedate'),                                        
                   'value'=>( $model->updatedate==null ? null : date('d.m.Y', strtotime($model->updatedate)))),                
            array( 'name'=>'url',
                   'value'=>($model->url ? $model->url : 'не указан')),
            array( 'name'=>'url_detile',
                   'value'=>($model->url_detile ? $model->url_detile : 'не указан'),
                   'visible'=>false
                 ),            
            array( 'name'=>'url_list',
                   'value'=>($model->url_list ? $model->url_list : 'не указан'),
                   'visible'=>false
                 ),                        
            array( 'name'=>'visible',
                   'value'=>($model->visible ? $model->visible : 'не указано')),                                    
            array( 'name'=>'action',
                   'value'=>($model->action ? $model->action : 'не указана')),                                                
            array( 'name'=>'city_id',
                   'value'=>($model->city_id ? $model->city_id : 'не указан'),
                   'visible'=>false
                 ),                                                            
            array( 'name'=>'maps_id',
                   'value'=>($model->maps_id ? $model->maps_id : 'не указан'),
                   'visible'=>false
                 ),  
            array( 'name'=>'cid',
                   'value'=>($model->cid ? $model->cid : 'не указан'),
                   'visible'=>false
                 ),  
	),
)); ?>

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