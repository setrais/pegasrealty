<?php
$this->breadcrumbs=array(
	'Space Classes'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SpaceClasses', 'url'=>array('index')),
	array('label'=>'Create SpaceClasses', 'url'=>array('create')),
	array('label'=>'Update SpaceClasses', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SpaceClasses', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SpaceClasses', 'url'=>array('admin')),
);
?>

<h1>View SpaceClasses #<?php echo $model->id; ?></h1>

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
