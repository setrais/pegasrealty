<?php
$this->breadcrumbs=array(
	'Client Realestates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClientRealestates', 'url'=>array('index')),
	array('label'=>'Manage ClientRealestates', 'url'=>array('admin')),
);
?>

<h1>Create ClientRealestates</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>