<?php
$this->breadcrumbs=array(
	'Client Spaces'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ClientSpaces', 'url'=>array('index')),
	array('label'=>'Create ClientSpaces', 'url'=>array('create')),
	array('label'=>'Update ClientSpaces', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClientSpaces', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClientSpaces', 'url'=>array('admin')),
);
?>

<h1>View ClientSpaces #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'client_id',
		'space_id',
	),
)); ?>
