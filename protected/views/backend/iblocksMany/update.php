<?php
$this->breadcrumbs=array(
	'Iblocks Manys'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List IblocksMany', 'url'=>array('index')),
	array('label'=>'Create IblocksMany', 'url'=>array('create')),
	array('label'=>'View IblocksMany', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage IblocksMany', 'url'=>array('admin')),
);
?>

<h1>Update IblocksMany <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>