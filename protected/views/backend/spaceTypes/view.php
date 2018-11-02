<?php
$this->breadcrumbs=array(
	'Space Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SpaceTypes', 'url'=>array('index')),
	array('label'=>'Create SpaceTypes', 'url'=>array('create')),
	array('label'=>'Update SpaceTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SpaceTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SpaceTypes', 'url'=>array('admin')),
);
?>

<h1>View SpaceTypes #<?php echo $model->id; ?></h1>

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
