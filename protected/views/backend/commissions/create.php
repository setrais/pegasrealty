<?php
$this->breadcrumbs=array(
	'Commissions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Commissions', 'url'=>array('index')),
	array('label'=>'Manage Commissions', 'url'=>array('admin')),
);
?>

<h1>Create Commissions</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>