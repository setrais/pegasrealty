<?php
$this->breadcrumbs=array(
	Yii::t('all','Iblocks')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('menu','List Iblocks'), 'url'=>array('index')),
	array('label'=>Yii::t('menu','Manage Iblocks'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('menu','Create Iblocks');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>