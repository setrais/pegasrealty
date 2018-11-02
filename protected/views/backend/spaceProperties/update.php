<?php
$this->breadcrumbs=array(
	'Space Properties'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SpaceProperties', 'url'=>array('index')),
	array('label'=>'Create SpaceProperties', 'url'=>array('create')),
	array('label'=>'View SpaceProperties', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SpaceProperties', 'url'=>array('admin')),
);
?>

<h1>Update SpaceProperties <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>