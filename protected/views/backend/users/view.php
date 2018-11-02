<?php
$this->breadcrumbs=array(
	Yii::t('all','Users')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Users'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Users'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','Update Users'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Delete Users'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('adm-menu','Manage Users'), 'url'=>array('admin')),
);
?>

<?php       
      $listRoles = '';
      foreach ($model->usersRoles as $key=>$role) {           
          if ($key) {
            $listRoles.= '/'.$role->name;
          } else {
            $listRoles.= $role->name;  
          }
      }
?>     

<h1><? echo Yii::t('adm-menu','View Users'); ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'nullDisplay'=>Yii::t('all','Not set'),
	'attributes'=>array(
		array( 'name'=>'id',
                       'visible'=>true,
                ),
                array( 'name'=>'uid',
                       'visible'=>true,
                ),
                array( 'name'=>'title',
                       'visible'=>true,
                ),
                array( 'name'=>'username',
                       'visible'=>true,
                ),
                array( 'name'=>'password',
                       'visible'=>true,
                ),
                array( 'name'=>'usersRoles',
                       'visible'=>true,
                       'type'=>'html',
                       'value'=>$listRoles,                    
                ),            
                array( 'name'=>'email',
                       'visible'=>true,
                ),
                array( 'name'=>'send_email',
                       'visible'=>true,
                ),
                array( 'name'=>'register_date',
                       'visible'=>true,
                ),
                array( 'name'=>'lastvisit_date',
                       'visible'=>true,
                ),
                array( 'name'=>'description',
                       'visible'=>true,
                ),
                array( 'name'=>'sort',
                       'visible'=>true,
                ),
                array( 'name'=>'act',
                       'value'=>($model->act ? 'да' : 'нет'),
                ),            
                array( 'name'=>'del',
                       'value'=>($model->act ? 'да' : 'нет'),
                ),                        
                array( 'name'=>'create_date',
                       'visible'=>true,
                ),                                    
                array( 'name'=>'update_date',
                       'visible'=>true,
                ),                           
                array( 'name'=>'param_id',
                       'visible'=>false,
                ),                                       
                array( 'name'=>'param_uid',
                       'visible'=>false,
                ),                                  
                array( 'name'=>'phpBBLogin',
                       'visible'=>false,
                ),                                  
	),
)); ?>
