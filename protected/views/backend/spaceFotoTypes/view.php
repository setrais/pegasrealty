<?php
$this->breadcrumbs=array(
	'Space Foto Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SpaceFotoTypes', 'url'=>array('index')),
	array('label'=>'Create SpaceFotoTypes', 'url'=>array('create')),
	array('label'=>'Update SpaceFotoTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SpaceFotoTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SpaceFotoTypes', 'url'=>array('admin')),
);
?>

<h1>View SpaceFotoTypes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'abbr',
		'title',
		'sort',
		'act',
		'del',
		'desc',
		'date_create',
		'date_update',
	),
)); ?>
