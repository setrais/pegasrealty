<?php
$this->breadcrumbs=array(
	'Realestate Presentations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RealestatePresentations', 'url'=>array('index')),
	array('label'=>'Create RealestatePresentations', 'url'=>array('create')),
	array('label'=>'Update RealestatePresentations', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RealestatePresentations', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RealestatePresentations', 'url'=>array('admin')),
);
?>

<h1>View RealestatePresentations #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'realestate_id',
		'file_id',
	),
)); ?>
