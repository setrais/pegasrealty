<?php
$this->breadcrumbs=array(
	'Order Metroses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OrderMetros', 'url'=>array('index')),
	array('label'=>'Create OrderMetros', 'url'=>array('create')),
	array('label'=>'Update OrderMetros', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OrderMetros', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrderMetros', 'url'=>array('admin')),
);
?>

<h1>View OrderMetros #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'order_id',
		'metro_id',
	),
)); ?>
