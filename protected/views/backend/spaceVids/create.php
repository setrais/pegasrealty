<?php
$this->breadcrumbs=array(
	'Space Vids'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SpaceVids', 'url'=>array('index')),
	array('label'=>'Manage SpaceVids', 'url'=>array('admin')),
);
?>

<h1>Create SpaceVids</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>