<?php
$this->breadcrumbs=array(
	'Space Representatives'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SpaceRepresentatives', 'url'=>array('index')),
	array('label'=>'Create SpaceRepresentatives', 'url'=>array('create')),
	array('label'=>'Update SpaceRepresentatives', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SpaceRepresentatives', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SpaceRepresentatives', 'url'=>array('admin')),
);
?>

<h1>View SpaceRepresentatives #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'space_id',
		'representative_id',
	),
)); ?>
