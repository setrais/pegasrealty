<?php
$this->breadcrumbs=array(
	'Plannings'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Plannings', 'url'=>array('index')),
	array('label'=>'Create Plannings', 'url'=>array('create')),
	array('label'=>'Update Plannings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Plannings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Plannings', 'url'=>array('admin')),
);
?>

<h1>View Plannings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'abbr',
		'title',
		'sort',
		'act',
		'del',
		'desc',
		'date_create',
		'date_update',
	),
)); ?>
