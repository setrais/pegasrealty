<?php
$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->id.' - '.$model->language=>array('view','id'=>$model->id, 'language'=>$model->language),
	'Update',
);

$this->menu=array(
	array('label'=>'List Messages', 'url'=>array('index')),
	array('label'=>'Create Messages', 'url'=>array('create')),
	array('label'=>'View Messages', 'url'=>array('view', 'id'=>$model->id, 'language'=>$model->language)),
	array('label'=>'Manage Messages', 'url'=>array('admin')),
);
?>

<h1>Update Messages <?php echo $model->id.' - '.$model->language; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>