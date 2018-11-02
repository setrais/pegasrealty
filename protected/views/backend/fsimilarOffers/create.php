<?php
$this->breadcrumbs=array(
	'Fsimilar Offers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FsimilarOffers', 'url'=>array('index')),
	array('label'=>'Manage FsimilarOffers', 'url'=>array('admin')),
);
?>

<h1>Create FsimilarOffers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>