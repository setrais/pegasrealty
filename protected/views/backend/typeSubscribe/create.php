<?php
/* @var $this TypeSubscribeController */
/* @var $model TypeSubscribe */

$this->breadcrumbs=array(
	Yii::t('all','Шаблоны рассылки'/*'Type Subscribes'*/)=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','Cписок шаблонов рассылки'/*'List TypeSubscribe'*/), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Управление шаблонами рассылки'/*'Manage TypeSubscribe'*/), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('adm-menu','Создание шаблона рассылки'/*'Create TypeSubscribe'*/);?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>