<?php
$this->breadcrumbs=array(
	'Space Fotoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SpaceFotos', 'url'=>array('index')),
	array('label'=>'Create SpaceFotos', 'url'=>array('create')),
	array('label'=>'View SpaceFotos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SpaceFotos', 'url'=>array('admin')),
);
?>

<h1>Update SpaceFotos <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>