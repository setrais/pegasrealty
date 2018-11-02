<?php
/* @var $this AuthItemController */
/* @var $model AuthItem */

$this->breadcrumbs=array(
	Yii::t('all','Auth Items')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List AuthItem'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage AuthItem'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Create AuthItem'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>