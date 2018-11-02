<?php
$this->breadcrumbs=array(
	'Fcost Offers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FcostOffers', 'url'=>array('index')),
	array('label'=>'Manage FcostOffers', 'url'=>array('admin')),
);
?>

<h1>Create FcostOffers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>