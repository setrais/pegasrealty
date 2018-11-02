<?php
$this->breadcrumbs=array(
	'Valutes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Valutes', 'url'=>array('index')),
	array('label'=>'Manage Valutes', 'url'=>array('admin')),
);
?>

<h1>Create Valutes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>