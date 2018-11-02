<?php
$this->breadcrumbs=array(
	'Space Presentations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SpacePresentations', 'url'=>array('index')),
	array('label'=>'Manage SpacePresentations', 'url'=>array('admin')),
);
?>

<h1>Create SpacePresentations</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>