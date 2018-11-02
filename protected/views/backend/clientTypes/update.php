<?php
$this->breadcrumbs=array(
	'Client Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClientTypes', 'url'=>array('index')),
	array('label'=>'Create ClientTypes', 'url'=>array('create')),
	array('label'=>'View ClientTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ClientTypes', 'url'=>array('admin')),
);
?>

<h1>Update ClientTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>