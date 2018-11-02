<?php
$this->breadcrumbs=array(
	'Parkings'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Parkings', 'url'=>array('index')),
	array('label'=>'Create Parkings', 'url'=>array('create')),
	array('label'=>'View Parkings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Parkings', 'url'=>array('admin')),
);
?>

<h1>Update Parkings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>