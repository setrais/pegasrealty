<?php
$this->breadcrumbs=array(
	'Client Contacts'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClientContacts', 'url'=>array('index')),
	array('label'=>'Create ClientContacts', 'url'=>array('create')),
	array('label'=>'View ClientContacts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ClientContacts', 'url'=>array('admin')),
);
?>

<h1>Update ClientContacts <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>