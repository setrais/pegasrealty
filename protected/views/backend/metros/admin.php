<?php
$this->breadcrumbs=array(
	Yii::t('all','Metroses')=>array('index'),
	Yii::t('all','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Metros'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Metros'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('metros-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('adm-menu','Manage Metroses'); ?></h1>

<p><?=Yii::t('form','You may optionally enter a comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done.');?></p>

<?php echo CHtml::link(Yii::t('all','Advanced Search'),'#',array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'metros-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText'=>Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                               $model->search()->getTotalItemCount()),
        'emptyText'=>Yii::t('core','No results found.'),    
        'pager'=>array(
              'header' => Yii::t('grid','Перейти к странице:'),
              //'firstPageLabel' => '&lt;&lt;',
              'prevPageLabel'  => Yii::t('grid','< Вперед'),//'<img src="images/pagination/left.png">',
              'nextPageLabel'  => Yii::t('grid','Назад >'),//'<img src="images/pagination/left.png">',
              //'nextPageLabel'  => '<img src="images/pagination/right.png">',
              //'lastPageLabel'  => '&gt;&gt;',
        ),      
	'columns'=>array(
            array( 'name'=>'id', 'type'=>'text',
                   'headerHtmlOptions'=>array('width'=>'60'),
                   'htmlOptions'=>array('style'=>'width:60px;'),
                   'visible'=>true,
            ),  
            array( 'name'=>'sid', 'type'=>'text',
                   'headerHtmlOptions'=>array('width'=>'100'),
                   'htmlOptions'=>array('style'=>'width:100px;'),
                   'visible'=>false,
            ),   
            array( 'name'=>'uid', 'type'=>'text',
                   'headerHtmlOptions'=>array('width'=>'100'),
                   'htmlOptions'=>array('style'=>'width:100px;'),
                   'visible'=>false,
            ),              
            array( 'name'=>'title', 'type'=>'text',
                  'headerHtmlOptions'=>array('width'=>'100'),
                  'htmlOptions'=>array('style'=>'width:100px;'),
                  'visible'=>true,
            ),             
           array( 'name'=>'anons',
                  'visible'=>false),                 
           array( 'name'=>'detile',
                  'visible'=>false),            
           array( 'name'=>'description', 
                  'visible'=>false
                ),                  
           array( 'name'=>'seo_title',
                  'visible'=>false),            
           array( 'name'=>'seo_keywords',
                  'visible'=>false),
           array( 'name'=>'seo_desc',
                  'visible'=>false),     
           array( 'name'=>'city_id',
                  'visible'=>false), 
           array( 'name'=>'map_latitude',
                  'visible'=>true), 
           array( 'name'=>'map_longitude',
                  'visible'=>true),                
           array( 'name'=>'street',
                  'visible'=>false), 
           array( 'name'=>'house',
                  'visible'=>false),             
	   array(
		  'class'=>'CButtonColumn',
           ),
	),
)); ?>
