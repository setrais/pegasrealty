<?php
$this->breadcrumbs=array(
	'Realestate Metroses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RealestateMetros', 'url'=>array('index')),
	array('label'=>'Create RealestateMetros', 'url'=>array('create')),
	array('label'=>'View RealestateMetros', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RealestateMetros', 'url'=>array('admin')),
);
?>

<h1>Update RealestateMetros <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>