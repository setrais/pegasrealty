<?php
$this->breadcrumbs=array(
	Yii::t('adm-menu','Representatives')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Representatives'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Representatives'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','Update Representatives'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Delete Representatives'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('adm-menu','Manage Representatives'), 'url'=>array('admin')),
);
?>

<h1><?=Yii::t('adm-menu','View Representatives');?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'fio',
                array( 'name'=>'site',
                       'type'=>'html',
                       'value'=>CHtml::link($model->site)
                ), 
                array( 'name'=>'email',
                       'type'=>'html',
                       'value'=>CHtml::mailto($model->email)
                ),                                 
		'telephone',            
                'fax',                  
		'telephone_1',            
                'telephone_2',            
                'telephone_3',                    
		'desc',            
		'sort',
                array( 'name'=>'act',
                       'value'=>($model->act ? 'да' : 'нет') ), 
                array( 'name'=>'del',
                       'value'=>($model->del ? 'да' : 'нет') ), 
                array( 'name'=>'create_date',
                       'label'=>Yii::t('label','Create Date'),                                        
                       'value'=>( $model->create_date==null ? null : date('d.m.Y', strtotime($model->create_date))),
                ),
                array( 'name'=>'update_date',
                       'label'=>Yii::t('label','Update Date'),                                        
                       'value'=>( $model->update_date==null ? null : date('d.m.Y', strtotime($model->update_date))),
                ),            
	),
)); ?>
