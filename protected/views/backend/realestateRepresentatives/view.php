<?php
$this->breadcrumbs=array(
	'Realestate Representatives'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RealestateRepresentatives', 'url'=>array('index')),
	array('label'=>'Create RealestateRepresentatives', 'url'=>array('create')),
	array('label'=>'Update RealestateRepresentatives', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RealestateRepresentatives', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RealestateRepresentatives', 'url'=>array('admin')),
);
?>

<h1>View RealestateRepresentatives #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'realestate_id',
		'representative_id',
	),
)); ?>
