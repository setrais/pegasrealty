<?php
$this->breadcrumbs=array(
	'Iblocks Manys'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List IblocksMany', 'url'=>array('index')),
	array('label'=>'Create IblocksMany', 'url'=>array('create')),
	array('label'=>'Update IblocksMany', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete IblocksMany', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage IblocksMany', 'url'=>array('admin')),
);
?>

<h1>View IblocksMany #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'iblock_id',
		'type_iblock_id',
	),
)); ?>
