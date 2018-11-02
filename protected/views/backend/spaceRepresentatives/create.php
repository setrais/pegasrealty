<?php
$this->breadcrumbs=array(
	'Space Representatives'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SpaceRepresentatives', 'url'=>array('index')),
	array('label'=>'Manage SpaceRepresentatives', 'url'=>array('admin')),
);
?>

<h1>Create SpaceRepresentatives</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>