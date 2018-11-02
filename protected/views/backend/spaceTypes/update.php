<?php
$this->breadcrumbs=array(
	'Space Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SpaceTypes', 'url'=>array('index')),
	array('label'=>'Create SpaceTypes', 'url'=>array('create')),
	array('label'=>'View SpaceTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SpaceTypes', 'url'=>array('admin')),
);
?>

<h1>Update SpaceTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>