<?php
$this->breadcrumbs=array(
	'Realestate Fotoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RealestateFotos', 'url'=>array('index')),
	array('label'=>'Create RealestateFotos', 'url'=>array('create')),
	array('label'=>'Update RealestateFotos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RealestateFotos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RealestateFotos', 'url'=>array('admin')),
);
?>

<h1>View RealestateFotos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'realestate_id',
		'realestate_foto_type_id',
		'file_id',
	),
)); ?>
