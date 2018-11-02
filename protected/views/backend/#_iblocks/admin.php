<?php
$this->breadcrumbs=array(
	'Iblocks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Iblocks', 'url'=>array('index')),
	array('label'=>'Create Iblocks', 'url'=>array('create')),
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

<h1>Manage Iblocks</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'iblocks-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'uid',
		'grid',
		'name',
		/*'visname',*/
		'title',
		/*
		'keywords',
		'description',
		'anons',
		'pic_anons',
		'pic_detile',
		'act',
		'del',
		'createusers',
		'createdate',
		'updateusers',
		'updatedate',
		'detile',
		'sort',
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
