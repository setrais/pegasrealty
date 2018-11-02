<?php
$this->breadcrumbs=array(
	Yii::t('all','Realestate Vids')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List RealestateVids'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create RealestateVids'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','View RealestateVids'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Manage RealestateVids'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','Update RealestateVids');?> № <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>