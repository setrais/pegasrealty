<?php
$this->breadcrumbs=array(
	'Types Iblocks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TypesIblocks', 'url'=>array('index')),
	array('label'=>'Manage TypesIblocks', 'url'=>array('admin')),
);
?>

<h1>Create TypesIblocks</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>