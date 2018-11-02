<?php
$this->breadcrumbs=array(
	'Space Fotoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SpaceFotos', 'url'=>array('index')),
	array('label'=>'Create SpaceFotos', 'url'=>array('create')),
	array('label'=>'Update SpaceFotos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SpaceFotos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SpaceFotos', 'url'=>array('admin')),
);
?>

<h1>View SpaceFotos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'space_id',
		'space_foto_type_id',
		'file_id',
	),
)); ?>
