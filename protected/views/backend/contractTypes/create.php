<?php
$this->breadcrumbs=array(
	'Contract Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ContractTypes', 'url'=>array('index')),
	array('label'=>'Manage ContractTypes', 'url'=>array('admin')),
);
?>

<h1>Create ContractTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>