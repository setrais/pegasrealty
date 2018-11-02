<?php
$this->breadcrumbs=array(
	'Fstavka Offers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FstavkaOffers', 'url'=>array('index')),
	array('label'=>'Create FstavkaOffers', 'url'=>array('create')),
	array('label'=>'View FstavkaOffers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FstavkaOffers', 'url'=>array('admin')),
);
?>

<h1>Update FstavkaOffers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>