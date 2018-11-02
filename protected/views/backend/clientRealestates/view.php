<?php
$this->breadcrumbs=array(
	'Client Realestates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ClientRealestates', 'url'=>array('index')),
	array('label'=>'Create ClientRealestates', 'url'=>array('create')),
	array('label'=>'Update ClientRealestates', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClientRealestates', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClientRealestates', 'url'=>array('admin')),
);
?>

<h1>View ClientRealestates #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'client_id',
		'realestate_id',
                'status_id',
	),
)); ?>
