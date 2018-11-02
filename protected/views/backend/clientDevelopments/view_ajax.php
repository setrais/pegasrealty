<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array( 'name'=>'id',
                       'visible'=>true,
                ),
                array( 'name'=>'client_id',
                       'visible'=>true,                       
                       'value'=>($model->client_id ? $model->client->name : 'не известен')
                ),
                array( 'name'=>'development_id',
                       'visible'=>true,                       
                       'value'=>($model->development_id ? $model->development->title : 'не определено')
                ),            
                array( 'name'=>'sort',
                       'visible'=>true,                       
                ),            
                array( 'name'=>'act',
                       'value'=>($model->act ? 'да' : 'нет') ), 
                array( 'name'=>'del',
                       'value'=>($model->del ? 'да' : 'нет') ),             
                array( 'name'=>'createdate',
                       'visible'=>true,                       
                ),                          
                array( 'name'=>'createuser',
                   'value'=>($model->createuser ? $model->createUser->email : '')
                ),            
                array( 'name'=>'updatedate',
                       'visible'=>true,                       
                ),                                                     
                array( 'name'=>'updateuser',
                   'value'=>($model->updateuser ? $model->updateUser->email : '')
                ),                                                                                             
                array( 'name'=>'desc',
                       'visible'=>true,                       
                ),                                                                             
	),
)); ?>
