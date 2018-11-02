<?php
$this->breadcrumbs=array(
	'Fsimilar Offers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FsimilarOffers', 'url'=>array('index')),
	array('label'=>'Create FsimilarOffers', 'url'=>array('create')),
	array('label'=>'View FsimilarOffers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FsimilarOffers', 'url'=>array('admin')),
);
?>

<h1>Update FsimilarOffers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>