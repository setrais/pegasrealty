<?php
$this->breadcrumbs=array(
	'Parkings'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Parkings', 'url'=>array('index')),
	array('label'=>'Create Parkings', 'url'=>array('create')),
	array('label'=>'Update Parkings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Parkings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Parkings', 'url'=>array('admin')),
);
?>

<h1>View Parkings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'abbr',
		'title',
		'sort',
		'act',
		'del',
		'create_date',
		'update_date',
		'desc',
	),
)); ?>
