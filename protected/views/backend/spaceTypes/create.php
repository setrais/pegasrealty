<?php
$this->breadcrumbs=array(
	'Space Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SpaceTypes', 'url'=>array('index')),
	array('label'=>'Manage SpaceTypes', 'url'=>array('admin')),
);
?>

<h1>Create SpaceTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>