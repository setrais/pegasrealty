<?php
$this->breadcrumbs=array(
	'Client Statuses'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ClientStatus', 'url'=>array('index')),
	array('label'=>'Create ClientStatus', 'url'=>array('create')),
	array('label'=>'Update ClientStatus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClientStatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClientStatus', 'url'=>array('admin')),
);
?>

<h1>View ClientStatus #<?php echo $model->id; ?></h1>

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
