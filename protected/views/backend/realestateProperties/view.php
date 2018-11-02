<?php
$this->breadcrumbs=array(
	'Realestate Properties'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RealestateProperties', 'url'=>array('index')),
	array('label'=>'Create RealestateProperties', 'url'=>array('create')),
	array('label'=>'Update RealestateProperties', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RealestateProperties', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RealestateProperties', 'url'=>array('admin')),
);
?>

<h1>View RealestateProperties #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'realestate_id',
		'property_id',
	),
)); ?>
