<?php
$this->breadcrumbs=array(
	'Space Foto Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SpaceFotoTypes', 'url'=>array('index')),
	array('label'=>'Manage SpaceFotoTypes', 'url'=>array('admin')),
);
?>

<h1>Create SpaceFotoTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>