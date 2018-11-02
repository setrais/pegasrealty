<?php
$this->breadcrumbs=array(
	'Iblocks Manys'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IblocksMany', 'url'=>array('index')),
	array('label'=>'Manage IblocksMany', 'url'=>array('admin')),
);
?>

<h1>Create IblocksMany</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>