<?php
$this->breadcrumbs=array(
	'Space Classes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SpaceClasses', 'url'=>array('index')),
	array('label'=>'Manage SpaceClasses', 'url'=>array('admin')),
);
?>

<h1>Create SpaceClasses</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>