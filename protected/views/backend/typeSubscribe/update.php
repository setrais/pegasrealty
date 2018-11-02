<?php
/* @var $this TypeSubscribeController */
/* @var $model TypeSubscribe */

$this->breadcrumbs=array(
	Yii::t('all','Шаблоны рассылки'/*'Type Subscribes'*/)=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('all','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','Списки шаблонов рассылки'/*'List TypeSubscribe'*/), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Создать шаблон рассылки'/*'Create TypeSubscribe'*/), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','Просмотр шаблона рассылки'/*'View TypeSubscribe'*/), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Управление шаблонами рассылки'/*'Manage TypeSubscribe'*/), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('adm-menu','Редактирование шаблона рассылки'/*'Update TypeSubscribe*/);?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>