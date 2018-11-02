<?php
$this->breadcrumbs=array(
	'Valutes'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Valutes', 'url'=>array('index')),
	array('label'=>'Create Valutes', 'url'=>array('create')),
	array('label'=>'View Valutes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Valutes', 'url'=>array('admin')),
);
?>

<h1>Update Valutes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>