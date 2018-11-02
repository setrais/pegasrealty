<?php
$this->breadcrumbs=array(
	'Types Iblocks'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TypesIblocks', 'url'=>array('index')),
	array('label'=>'Create TypesIblocks', 'url'=>array('create')),
	array('label'=>'View TypesIblocks', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TypesIblocks', 'url'=>array('admin')),
);
?>

<h1>Update TypesIblocks <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>