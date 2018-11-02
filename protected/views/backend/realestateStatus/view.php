<?php
$this->breadcrumbs=array(
	'Realestate Statuses'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List RealestateStatus', 'url'=>array('index')),
	array('label'=>'Create RealestateStatus', 'url'=>array('create')),
	array('label'=>'Update RealestateStatus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RealestateStatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RealestateStatus', 'url'=>array('admin')),
);
?>

<h1>View RealestateStatus #<?php echo $model->id; ?></h1>

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
