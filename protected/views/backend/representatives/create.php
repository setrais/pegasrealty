<?php
$this->breadcrumbs=array(
	Yii::t('adm-menu','Representatives')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Representatives'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage Representatives'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('adm-menu','Create Representatives');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>