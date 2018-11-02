<?php
$this->breadcrumbs=array(
	'Site Vids'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SiteVids', 'url'=>array('index')),
	array('label'=>'Create SiteVids', 'url'=>array('create')),
	array('label'=>'View SiteVids', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SiteVids', 'url'=>array('admin')),
);
?>

<h1>Update SiteVids <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>