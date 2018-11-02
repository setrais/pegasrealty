<?php
$this->breadcrumbs=array(
	Yii::t('all','Clients')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Clients'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage Clients'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Create Clients');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>