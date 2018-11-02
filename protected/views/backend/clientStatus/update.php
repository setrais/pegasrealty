<?php
$this->breadcrumbs=array(
	'Client Statuses'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClientStatus', 'url'=>array('index')),
	array('label'=>'Create ClientStatus', 'url'=>array('create')),
	array('label'=>'View ClientStatus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ClientStatus', 'url'=>array('admin')),
);
?>

<h1>Update ClientStatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>