<?php
$this->breadcrumbs=array(
	'Client Realestates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClientRealestates', 'url'=>array('index')),
	array('label'=>'Create ClientRealestates', 'url'=>array('create')),
	array('label'=>'View ClientRealestates', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ClientRealestates', 'url'=>array('admin')),
);
?>

<h1>Update ClientRealestates <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>