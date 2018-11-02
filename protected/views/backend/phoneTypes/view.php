<?php
$this->breadcrumbs=array(
	'Phone Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List PhoneTypes', 'url'=>array('index')),
	array('label'=>'Create PhoneTypes', 'url'=>array('create')),
	array('label'=>'Update PhoneTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PhoneTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PhoneTypes', 'url'=>array('admin')),
);
?>

<h1>View PhoneTypes #<?php echo $model->id; ?></h1>

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
