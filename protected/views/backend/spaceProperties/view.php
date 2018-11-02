<?php
$this->breadcrumbs=array(
	'Space Properties'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SpaceProperties', 'url'=>array('index')),
	array('label'=>'Create SpaceProperties', 'url'=>array('create')),
	array('label'=>'Update SpaceProperties', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SpaceProperties', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SpaceProperties', 'url'=>array('admin')),
);
?>

<h1>View SpaceProperties #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'space_id',
		'property_id',
	),
)); ?>
