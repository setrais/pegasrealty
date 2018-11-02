<?php
$this->breadcrumbs=array(
	'Space Fotoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SpaceFotos', 'url'=>array('index')),
	array('label'=>'Manage SpaceFotos', 'url'=>array('admin')),
);
?>

<h1>Create SpaceFotos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>