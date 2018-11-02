<?php
$this->breadcrumbs=array(
	'Email Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List EmailTypes', 'url'=>array('index')),
	array('label'=>'Create EmailTypes', 'url'=>array('create')),
	array('label'=>'Update EmailTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EmailTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmailTypes', 'url'=>array('admin')),
);
?>

<h1>View EmailTypes #<?php echo $model->id; ?></h1>

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
