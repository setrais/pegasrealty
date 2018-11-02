<?php
$this->breadcrumbs=array(
	'Client Scopes'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClientScopes', 'url'=>array('index')),
	array('label'=>'Create ClientScopes', 'url'=>array('create')),
	array('label'=>'View ClientScopes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ClientScopes', 'url'=>array('admin')),
);
?>

<h1>Update ClientScopes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>