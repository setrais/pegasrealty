<?php
$this->breadcrumbs=array(
	Yii::t('all','Streets')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Streets'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Streets'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','Update Streets'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Delete Streets'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('adm-menu','Manage Streets'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','View Streets');?> №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sid',            
		'code',
		'name',
		'SOCR',
		'index',
		'GNINMB',
		'UNO',
		'OCATD',
                array( 'name'=>'anons',
                       'type'=>'text', 
                     ),
                array( 'name'=>'detile',
                       'type'=>'html', 
                     ),            
                array( 'name'=>'description',
                       'type'=>'html', 
                     ),
                array( 'name'=>'seo_title',
                       'label'=>'SEO заголовок', 
                       'type'=>'text', 
                     ),                        
                array( 'name'=>'seo_desc',
                       'label'=>'SEO описание',                    
                       'type'=>'text', 
                     ),                          
                array( 'name'=>'seo_keywords',
                       'label'=>'SEO ключевые слова',                                        
                       'type'=>'text', 
                     )                              
	),
)); ?>
