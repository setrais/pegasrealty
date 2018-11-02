<?php
$this->breadcrumbs=array(
	Yii::t('all','Developments')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Developments'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage Developments'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Create Developments');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>