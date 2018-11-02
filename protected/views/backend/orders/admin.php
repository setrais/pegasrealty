<?php
$this->breadcrumbs=array(
	Yii::t('all','Orders')=>array('index'),
	Yii::t('all','Manage'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Orders'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Orders'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('orders-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('all','Manage Orders'); ?></h1>

<p><?=Yii::t('form','You may optionally enter a comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done.');?></p>

<?php echo CHtml::link(Yii::t('all','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orders-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'summaryText'=>Yii::t('core',                 
                              'Displaying Items {start} - {end} of {count} results', 
                               $model->search()->getTotalItemCount()),
        'emptyText'=>Yii::t('core','No results found.'),       
	'columns'=>array(
		'id',
		'createdate',
		'updatedate',
		'createuser',
		'updateuser',
		'act',
		/*
		'del',
		'sort',
		'operation_id',
		'price_from',
		'price_to',
		'area_from',
		'area_to',
		'realestate_type_id',
		'realestate_vid_id',
		'realestate_class_id',
		'district_id',
		'valute_id',
		'unit_id',
		'remoteness',
		'unit_value',
		'poligon',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
