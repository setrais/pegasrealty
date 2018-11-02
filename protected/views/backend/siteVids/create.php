<?php
$this->breadcrumbs=array(
	'Site Vids'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SiteVids', 'url'=>array('index')),
	array('label'=>'Manage SiteVids', 'url'=>array('admin')),
);
?>

<h1>Create SiteVids</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>