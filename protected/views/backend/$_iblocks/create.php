<?php
$this->breadcrumbs=array(
	'Iblocks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Iblocks', 'url'=>array('index')),
	array('label'=>'Manage Iblocks', 'url'=>array('admin')),
);
?>

<h1>Create Iblocks</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>