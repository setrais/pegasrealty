<?php
$this->breadcrumbs=array(
	'Client Spaces'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClientSpaces', 'url'=>array('index')),
	array('label'=>'Create ClientSpaces', 'url'=>array('create')),
	array('label'=>'View ClientSpaces', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ClientSpaces', 'url'=>array('admin')),
);
?>

<h1>Update ClientSpaces <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>