<?php
$this->breadcrumbs=array(
	'Space Classes'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SpaceClasses', 'url'=>array('index')),
	array('label'=>'Create SpaceClasses', 'url'=>array('create')),
	array('label'=>'View SpaceClasses', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SpaceClasses', 'url'=>array('admin')),
);
?>

<h1>Update SpaceClasses <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>