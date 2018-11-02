<?php
$this->breadcrumbs=array(
	'Client Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClientTypes', 'url'=>array('index')),
	array('label'=>'Manage ClientTypes', 'url'=>array('admin')),
);
?>

<h1>Create ClientTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>