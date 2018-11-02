<?php
$this->breadcrumbs=array(
	'Fcost Offers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FcostOffers', 'url'=>array('index')),
	array('label'=>'Create FcostOffers', 'url'=>array('create')),
	array('label'=>'View FcostOffers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FcostOffers', 'url'=>array('admin')),
);
?>

<h1>Update FcostOffers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>