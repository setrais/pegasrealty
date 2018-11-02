<?php
$this->breadcrumbs=array(
	'Objects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Objects', 'url'=>array('index')),
	array('label'=>'Manage Objects', 'url'=>array('admin')),
);
?>

<h1>Create Objects</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>