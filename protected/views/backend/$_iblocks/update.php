<?php
$this->breadcrumbs=array(
	'Iblocks'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Iblocks', 'url'=>array('index')),
	array('label'=>'Create Iblocks', 'url'=>array('create')),
	array('label'=>'View Iblocks', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Iblocks', 'url'=>array('admin')),
);
?>

<h1>Update Iblocks <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>