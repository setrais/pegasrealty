<?php
$this->breadcrumbs=array(
	Yii::t('all','Realestate Classes')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List RealestateClasses'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create RealestateClasses'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View RealestateClasses'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage RealestateClasses'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Update RealestateClasses');?> № <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>