<?php
$this->breadcrumbs=array(
	'Space Similarities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SpaceSimilarities', 'url'=>array('index')),
	array('label'=>'Manage SpaceSimilarities', 'url'=>array('admin')),
);
?>

<h1>Create SpaceSimilarities</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>