<?php
$this->breadcrumbs=array(
	'Contract Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ContractTypes', 'url'=>array('index')),
	array('label'=>'Create ContractTypes', 'url'=>array('create')),
	array('label'=>'Update ContractTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ContractTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContractTypes', 'url'=>array('admin')),
);
?>

<h1>View ContractTypes #<?php echo $model->id; ?></h1>

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
