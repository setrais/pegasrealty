<?php
$this->breadcrumbs=array(
	'Fstavka Offers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FstavkaOffers', 'url'=>array('index')),
	array('label'=>'Manage FstavkaOffers', 'url'=>array('admin')),
);
?>

<h1>Create FstavkaOffers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>