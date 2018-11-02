<?php
$this->breadcrumbs=array(
	Yii::t('all','Properties')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Properties'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage Properties'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Create Properties'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>