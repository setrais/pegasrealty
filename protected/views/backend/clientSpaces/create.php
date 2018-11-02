<?php
$this->breadcrumbs=array(
	'Client Spaces'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClientSpaces', 'url'=>array('index')),
	array('label'=>'Manage ClientSpaces', 'url'=>array('admin')),
);
?>

<h1>Create ClientSpaces</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>