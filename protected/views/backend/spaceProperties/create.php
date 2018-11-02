<?php
$this->breadcrumbs=array(
	'Space Properties'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SpaceProperties', 'url'=>array('index')),
	array('label'=>'Manage SpaceProperties', 'url'=>array('admin')),
);
?>

<h1>Create SpaceProperties</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>