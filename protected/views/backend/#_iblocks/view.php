<?php
$this->breadcrumbs=array(
	'Iblocks'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Iblocks', 'url'=>array('index')),
	array('label'=>'Create Iblocks', 'url'=>array('create')),
	array('label'=>'Update Iblocks', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Iblocks', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Iblocks', 'url'=>array('admin')),
);
?>

<h1>View Iblocks #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'grid',
		'name',
		'visname',
		'title',
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
	),
)); ?>
