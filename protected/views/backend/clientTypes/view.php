<?php
$this->breadcrumbs=array(
	'Client Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ClientTypes', 'url'=>array('index')),
	array('label'=>'Create ClientTypes', 'url'=>array('create')),
	array('label'=>'Update ClientTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClientTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClientTypes', 'url'=>array('admin')),
);
?>

<h1>View ClientTypes #<?php echo $model->id; ?></h1>

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
