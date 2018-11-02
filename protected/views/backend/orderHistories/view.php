<?php
$this->breadcrumbs=array(
	'Order Histories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OrderHistories', 'url'=>array('index')),
	array('label'=>'Create OrderHistories', 'url'=>array('create')),
	array('label'=>'Update OrderHistories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete OrderHistories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrderHistories', 'url'=>array('admin')),
);
?>

<h1>View OrderHistories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'order_id',
		'createdate',
		'updatedate',
		'createuser',
		'updateuser',
		'act',
		'del',
		'sort',
		'operation_id',
		'price_from',
		'price_to',
		'area_from',
		'area_to',
		'realestate_type_id',
		'realestate_vid_id',
		'realestate_class_id',
		'district_id',
		'valute_id',
		'unit_id',
		'remoteness',
		'unit_value',
		'poligon',
	),
)); ?>
