<?php
$this->breadcrumbs=array(
	Yii::t('all','Client Developments')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('label','List ClientDevelopments'), 'url'=>array('index')),
	array('label'=>Yii::t('label','Manage ClientDevelopments'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('all','Create ClientDevelopments');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>