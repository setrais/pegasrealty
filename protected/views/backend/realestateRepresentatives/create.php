<?php
$this->breadcrumbs=array(
	'Realestate Representatives'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RealestateRepresentatives', 'url'=>array('index')),
	array('label'=>'Manage RealestateRepresentatives', 'url'=>array('admin')),
);
?>

<h1>Create RealestateRepresentatives</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>