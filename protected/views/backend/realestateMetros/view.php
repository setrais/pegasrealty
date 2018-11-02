<?php
$this->breadcrumbs=array(
	'Realestate Metroses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RealestateMetros', 'url'=>array('index')),
	array('label'=>'Create RealestateMetros', 'url'=>array('create')),
	array('label'=>'Update RealestateMetros', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RealestateMetros', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RealestateMetros', 'url'=>array('admin')),
);
?>

<h1>View RealestateMetros #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'realestate_id',
		'metro_id',
		'remoteness',
		'unit_id',
	),
)); ?>
