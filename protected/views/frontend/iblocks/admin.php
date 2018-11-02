<?php
$this->breadcrumbs=array(
	Yii::t('all','Iblocks')=>array('index'),
	Yii::t('all','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('menu','List Iblocks'), 'url'=>array('index')),
	array('label'=>Yii::t('menu','Create Iblocks'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('iblocks-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?=Yii::t('menu','Manage Iblocks');?></h1>

<p><?=Yii::t('form','You may optionally enter a comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done.');?></p>

<?php echo CHtml::link(Yii::t('all','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'iblocks-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText'=>Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                               $model->search()->getTotalItemCount()),
        'emptyText'=>Yii::t('core','No results found.'),   
	'columns'=>array(              
            array( 'name'=>'id',
                   'visible'=>false
            ),
            array( 'name'=>'uid',
                   'header'=>'УиД',
                   'headerHtmlOptions'=>array('width'=>'25'),
                   'htmlOptions'=>array('style'=>'width:25px;text-align:right;vertical-align: middle;'),
                   'visible'=>false
            ),          
            array( 'name'=>'nid',
                   'headerHtmlOptions'=>array('width'=>'25'),
                   'htmlOptions'=>array('style'=>'width:25px;text-align:right;vertical-align: middle;'),
                   'visible'=>true
            ),                           
            array( 'name'=>'sid',
                   'headerHtmlOptions'=>array('width'=>'25'),
                   'htmlOptions'=>array('style'=>'width:25px;text-align:right;vertical-align: middle;'),
                   'visible'=>false
            ),                      
            array( 'name'=>'pic_scr_id',
                   //'htmlOptions'=>array("width"=>60),
                   'type'=>'raw',
                   'value'=> 'CHtml::link(CHtml::image( 
                                   "/".( trim($data->picScr->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picScr->original_name)))
                                     ? str_replace("_original","_src",trim($data->picScr->original_name))
                                     : ( trim($data->picOreginal->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_src",trim($data->picOreginal->original_name)))
                                         ? str_replace("_original","_src",trim($data->picOreginal->original_name)) 
                                         : "images/no_foto_small.png" )),"", 
                                         array("title"=>$data->picOreginal->name )), 
                                         "/".$data->picOreginal->original_name, array("class"=>"fancyImage"))',
                    'filter'=>'',
                    'headerHtmlOptions'=>array('width'=>'60'),
                    'htmlOptions'=>array('style'=>'width:60px;text-align: center;vertical-align: middle;'),
                    'visible'=>true,
                 ),	            
           array( 'name'=>'grid',
                  'header'=>Yii::t('label','Section'),
                  'type'=>'text',
                  'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                  'value'=>'$data->section->name;',                   
                  'filter'=>CHtml::listData(Iblocks::model()->findAll("(TYPES_IBLOCKS_ID<>1)AND(GRID IS NULL OR GRID=0)AND (ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'name'),
                  'headerHtmlOptions'=>array('width'=>'50'),
                  'visible'=>true,
               ),                    
           'name',
           array( 'name'=>'sort', 
                  'header'=>'Сорт.'),
           array( 'name'=>'act',
                  'header'=>Yii::t('all','A'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'act',array('style'=>'width:10px;text-align:center;')),
                  'value'=>'($data->act ? "x" : "")',                     
                  'htmlOptions'=>array('width'=>10,'style'=>'width:10px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>10,'style'=>'text-align:center;'),
                  'visible'=>true,
                ),
           array( 'name'=>'del',
                  'header'=>Yii::t('all','D'),
                  'type'=>'text',
                  'filter'=>CHtml::activecheckBox($model,'del',array('style'=>'width:10px;text-align:center;')),
                  'value'=>'($data->del ? "x" : "")',                     
                  'htmlOptions'=>array('width'=>10,'style'=>'width:8px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>10,'style'=>'text-align:center;'),
                  'visible'=>true,
                ),                   
           array( 'name'=>'cid',
                  'visible'=>false
           ),
           array( 'name'=>'title',
                  'visible'=>false),            
           array( 'name'=>'keywords',
                  'visible'=>false),
           array( 'name'=>'description',
                  'visible'=>false),
           array( 'name'=>'anons',
                  'visible'=>false),
           array( 'name'=>'pic_anons',
                  'visible'=>false ),
           array( 'name'=>'pic_detile', 
                  'visible'=>false ),
           array( 'name'=>'createusers',                  
                  'type'=>'text',
                  'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                  'value'=>'$data->createUser->username;',                   
                  'filter'=>CHtml::listData(Users::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'username'),
                  'headerHtmlOptions'=>array('width'=>'50'),
                  'visible'=>true,
               ),                         
          array(  'name'=>'createdate',
                  'header'=>Yii::t('all','Дата создания'),
                  'type'=>'text',
                  'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                    array( 'language'=> Yii::app()->params->language,                                        
                           'model'=>$model,
                           'attribute'=>'createdate',   
                           'theme'=>'ui-lightness',
                           'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'dd.mm.yy',                                 
                                'defaultDate'=>date('d.m.Y'),                                                
                                'showButtonPanel'=>true,
                                /*'showOn'=> "button",
                                'buttonImage'=> "/images/calendar.gif",
                                'buttonImageOnly'=> true,*/
                                //set calendar z-index higher then UI Dialog z-index 
                                'beforeShow'=>"js:function() {
                                  $('.ui-datepicker').css('font-size', '0.8em');
                                  $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                                }",
                           ),   
                           'htmlOptions'=>array('size'=>8 ),
                    ),true),                                    
                  'value'=>'date("d.m.Y",strtotime($data->createdate))',
                  'htmlOptions'=>array('style'=>'width:'/*110*/.'70px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'70'/*'110'*/),
                  'visible'=>true,
                ),   
           array( 'name'=>'updateusers',                  
                  'type'=>'text',
                  'htmlOptions'=>array('style'=>'text-align:center;width:50px;'),
                  'value'=>'$data->updateUser->username;',                   
                  'filter'=>CHtml::listData(Users::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                array("order"=>"sort")), 'id', 'username'),
                  'headerHtmlOptions'=>array('width'=>'50'),
                  'visible'=>true,
               ),             
           array(  'name'=>'updatedate',
                  'header'=>Yii::t('all','Дата обновления'),
                  'type'=>'text',
                  'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                    array( 'language'=> Yii::app()->params->language,                                        
                           'model'=>$model,
                           'attribute'=>'updatedate',   
                           'theme'=>'ui-lightness',
                           'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'dd.mm.yy',                                 
                                'defaultDate'=>date('d.m.Y'),                                                
                                'showButtonPanel'=>true,
                                /*'showOn'=> "button",
                                'buttonImage'=> "/images/calendar.gif",
                                'buttonImageOnly'=> true,*/
                                //set calendar z-index higher then UI Dialog z-index 
                                'beforeShow'=>"js:function() {
                                  $('.ui-datepicker').css('font-size', '0.8em');
                                  $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                                }",
                           ),   
                           'htmlOptions'=>array('size'=>8 ),
                    ),true),                                    
                  'value'=>'date("d.m.Y",strtotime($data->updatedate))',
                  'htmlOptions'=>array('style'=>'width:'/*110*/.'70px;text-align:center;'),
                  'headerHtmlOptions'=>array('width'=>'70'/*'110'*/),
                  'visible'=>true,
                ),                                                    
           /*'detile',
           'cid',
           'is_main',
           'is_pay',
           'is_arhiv',
           'is_use',
           'maps_id',
           'types_iblocks_id',
           'iurl',
           'url',
           'city',
           'visible',
           'action',
	*/
           array(
               'class'=>'CButtonColumn',
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