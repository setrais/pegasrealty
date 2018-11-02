<?php
$this->breadcrumbs=array(
	Yii::t('all','Realestate Classes')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List RealestateClasses'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage RealestateClasses'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Create RealestateClasses');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>