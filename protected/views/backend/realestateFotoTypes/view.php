<?php
$this->breadcrumbs=array(
	'Realestate Foto Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List RealestateFotoTypes', 'url'=>array('index')),
	array('label'=>'Create RealestateFotoTypes', 'url'=>array('create')),
	array('label'=>'Update RealestateFotoTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RealestateFotoTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RealestateFotoTypes', 'url'=>array('admin')),
);
?>

<h1>View RealestateFotoTypes #<?php echo $model->id; ?></h1>

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
