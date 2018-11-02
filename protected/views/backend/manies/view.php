<?php
$this->breadcrumbs=array(
	'Manies'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Manies', 'url'=>array('index')),
	array('label'=>'Create Manies', 'url'=>array('create')),
	array('label'=>'Update Manies', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Manies', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Manies', 'url'=>array('admin')),
);
?>

<h1>View Manies #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sid',
		'abbr',
		'title',
		'sort',
		'desc',
		'act',
		'del',
	),
)); ?>
