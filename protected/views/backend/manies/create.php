<?php
$this->breadcrumbs=array(
	'Manies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Manies', 'url'=>array('index')),
	array('label'=>'Manage Manies', 'url'=>array('admin')),
);
?>

<h1>Create Manies</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>