<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */

$this->breadcrumbs=array(
	'Subscribes'=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Subscribe'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage Subscribe'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('menu-adm',Yii::t('adm-menu','Create Subscribe'));?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>