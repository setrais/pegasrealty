<?php
$this->breadcrumbs=array(
	'Types Iblocks'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TypesIblocks', 'url'=>array('index')),
	array('label'=>'Create TypesIblocks', 'url'=>array('create')),
	array('label'=>'Update TypesIblocks', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TypesIblocks', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TypesIblocks', 'url'=>array('admin')),
);
?>

<h1>View TypesIblocks #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'grid',
		'name',
		'desc',
		'act',
		'del',
	),
)); ?>
