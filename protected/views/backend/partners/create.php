<?php
$this->breadcrumbs=array(
	Yii::t('all','Partners')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Partners'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage Partners'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Create Partners');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>