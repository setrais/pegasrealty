<?php
$this->breadcrumbs=array(
	'Valutes'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Valutes', 'url'=>array('index')),
	array('label'=>'Create Valutes', 'url'=>array('create')),
	array('label'=>'Update Valutes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Valutes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Valutes', 'url'=>array('admin')),
);
?>

<h1>View Valutes #<?php echo $model->id; ?></h1>

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
