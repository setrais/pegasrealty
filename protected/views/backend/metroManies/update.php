<?php
$this->breadcrumbs=array(
	'Metro Manies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MetroManies', 'url'=>array('index')),
	array('label'=>'Create MetroManies', 'url'=>array('create')),
	array('label'=>'View MetroManies', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MetroManies', 'url'=>array('admin')),
);
?>

<h1>Update MetroManies <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>