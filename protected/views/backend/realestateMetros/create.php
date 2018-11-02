<?php
$this->breadcrumbs=array(
	'Realestate Metroses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RealestateMetros', 'url'=>array('index')),
	array('label'=>'Manage RealestateMetros', 'url'=>array('admin')),
);
?>

<h1>Create RealestateMetros</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>