<?php
$this->breadcrumbs=array(
	'Parkings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Parkings', 'url'=>array('index')),
	array('label'=>'Manage Parkings', 'url'=>array('admin')),
);
?>

<h1>Create Parkings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>