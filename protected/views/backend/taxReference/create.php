<?php
$this->breadcrumbs=array(
	'Tax References'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TaxReference', 'url'=>array('index')),
	array('label'=>'Manage TaxReference', 'url'=>array('admin')),
);
?>

<h1>Create TaxReference</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>