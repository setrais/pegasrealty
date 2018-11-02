<?php
$this->breadcrumbs=array(
	'Space Vids'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SpaceVids', 'url'=>array('index')),
	array('label'=>'Create SpaceVids', 'url'=>array('create')),
	array('label'=>'Update SpaceVids', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SpaceVids', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SpaceVids', 'url'=>array('admin')),
);
?>

<h1>View SpaceVids #<?php echo $model->id; ?></h1>

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
