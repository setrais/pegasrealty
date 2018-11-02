<?php
$this->breadcrumbs=array(
	'Site Vids'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SiteVids', 'url'=>array('index')),
	array('label'=>'Create SiteVids', 'url'=>array('create')),
	array('label'=>'Update SiteVids', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SiteVids', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SiteVids', 'url'=>array('admin')),
);
?>

<h1>View SiteVids #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'abbr',
		'title',
		'sort',
		'act',
		'del',
		'create_date',
		'update_date',
		'desc',
	),
)); ?>
