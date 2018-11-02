<?php
$this->breadcrumbs=array(
	'Client Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ClientOrders', 'url'=>array('index')),
	array('label'=>'Create ClientOrders', 'url'=>array('create')),
	array('label'=>'Update ClientOrders', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClientOrders', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClientOrders', 'url'=>array('admin')),
);
?>

<h1>View ClientOrders #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'client_id',
		'order_id',
	),
)); ?>
