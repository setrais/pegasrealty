<?php
$this->breadcrumbs=array(
	'Realestate Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RealestateStatus', 'url'=>array('index')),
	array('label'=>'Manage RealestateStatus', 'url'=>array('admin')),
);
?>

<h1>Create RealestateStatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>