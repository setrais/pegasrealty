<?php
$this->breadcrumbs=array(
	'Realestate Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List RealestateTypes', 'url'=>array('index')),
	array('label'=>'Create RealestateTypes', 'url'=>array('create')),
	array('label'=>'Update RealestateTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RealestateTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RealestateTypes', 'url'=>array('admin')),
);
?>

<h1>View RealestateTypes #<?php echo $model->id; ?></h1>

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
