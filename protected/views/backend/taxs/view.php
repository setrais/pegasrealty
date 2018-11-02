<?php
$this->breadcrumbs=array(
	'Taxs'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Taxs', 'url'=>array('index')),
	array('label'=>'Create Taxs', 'url'=>array('create')),
	array('label'=>'Update Taxs', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Taxs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Taxs', 'url'=>array('admin')),
);
?>

<h1>View Taxs #<?php echo $model->id; ?></h1>

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
