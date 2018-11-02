<?php
$this->breadcrumbs=array(
	Yii::t('all','Realestate Vids')=>array('index'),
	Yii::t('all','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List RealestateVids'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Manage RealestateVids'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Create RealestateVids');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>