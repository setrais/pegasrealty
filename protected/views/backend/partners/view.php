<?php
$this->breadcrumbs=array(
	Yii::t('all','Partners')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Partners'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Partners'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','Update Partners'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Delete Partners'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('all','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('adm-menu','Manage Partners'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','View Partners');?> №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                    array('name'=>'id'),    
            	//	'uid',
                    array('name'=>'abbr'),
                    array('name'=>'title'),                                    
                    array('name'=>'contact'),                                                                        
                    array('name'=>'phone'),                                                            
                    array('name'=>'email',
                          'type'=>'email',
                         ),                                                                                    
                    array('name'=>'site',
                          'type'=>'html',
                          'value'=>CHtml::link($model->site, $model->site)),         
                    array('name'=>'infocode',                          
                          'type'=>'raw',
                          'cssClass'=>'infocode',
                          'value'=>$model->infocode),
                    array('name'=>'address'),                                                                                                                                    
                    array('name'=>'anons'),                                                                                                                                                              
                    array('name'=>'client_type_id',
                          'value'=>($model->client_type_id ? $model->clientType->title : 'не установлен')
                    ),                                                                                              
                    array('name'=>'client_id',
                          'value'=>($model->client_id ? $model->client->name.' : '.$model->client->contact.' > '.$model->client->email : 'не установлен')
                    ), 
                    array('name'=>'sort'),
                    array('name'=>'act',    
                          'value'=>($model->act ? 'да' : 'нет')
                    ),    
                    array('name'=>'del',    
                          'value'=>($model->del ? 'да' : 'нет')
                    ),      
                    array('name'=>'desc',                        
                          'type'=>'html',
                          'value'=>$model->desc
                    ),          
                    array('name'=>'create_date',
                          'value'=>($model->create_date) ? $model->create_date : "" 
                    ),    
                    array('name'=>'create_user',
                          'value'=>($model->create_user ? $model->createUser->username : 'не установлен')
                    ), 
                    array('name'=>'update_date',
                          'value'=>($model->update_date) ? $model->update_date : ""                         
                    ),    
                    array('name'=>'update_user',
                          'value'=>($model->update_user ? $model->updateUser->username : 'не установлен')
                    ),             
                  /*'ddog',
                    'ndog',
                    'login',
                    'password',*/
                    array('name'=>'mypage',
                          'type'=>'html',
                          'value'=>CHtml::link($model->mypage, $model->mypage)),
                    /*'logo_id'*/
	), 
)); ?>
<?php
    // Прикрытие инфо кода
    include __DIR__ . '/include/_var_infocode.php';
?> 