<?php
$this->breadcrumbs=array(
	'Phone Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PhoneTypes', 'url'=>array('index')),
	array('label'=>'Create PhoneTypes', 'url'=>array('create')),
	array('label'=>'View PhoneTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PhoneTypes', 'url'=>array('admin')),
);
?>

<h1>Update PhoneTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>