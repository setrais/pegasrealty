<?php
$this->breadcrumbs=array(
	'Metro Manies'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MetroManies', 'url'=>array('index')),
	array('label'=>'Create MetroManies', 'url'=>array('create')),
	array('label'=>'Update MetroManies', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MetroManies', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MetroManies', 'url'=>array('admin')),
);
?>

<h1>View MetroManies #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'metro_id',
		'many_id',
	),
)); ?>
