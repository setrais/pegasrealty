<?php
$this->breadcrumbs=array(
	Yii::t('all','Users')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Users'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage Users'), 'url'=>array('admin')),
);
?>

<h1><? echo Yii::t('adm-menu','Create Users'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>