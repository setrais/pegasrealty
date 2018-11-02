<?php
$this->breadcrumbs=array(
	'Space Foto Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SpaceFotoTypes', 'url'=>array('index')),
	array('label'=>'Create SpaceFotoTypes', 'url'=>array('create')),
	array('label'=>'View SpaceFotoTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SpaceFotoTypes', 'url'=>array('admin')),
);
?>

<h1>Update SpaceFotoTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>