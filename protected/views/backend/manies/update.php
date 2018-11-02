<?php
$this->breadcrumbs=array(
	'Manies'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Manies', 'url'=>array('index')),
	array('label'=>'Create Manies', 'url'=>array('create')),
	array('label'=>'View Manies', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Manies', 'url'=>array('admin')),
);
?>

<h1>Update Manies <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>