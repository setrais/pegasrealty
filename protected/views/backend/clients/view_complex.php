<?php
$this->breadcrumbs=array(
	Yii::t('all','Clients')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('adm-menu','List Clients'), 'url'=>array('index')),
	array('label'=>Yii::t('adm-menu','Create Clients'), 'url'=>array('create')),
	array('label'=>Yii::t('adm-menu','Update Clients'), 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>Yii::t('adm-menu','View Clients'), 'url'=>array('view', 'id'=>$model->id)),
        //array('label'=>Yii::t('adm-menu','Complex Update Clients'), 'url'=>array('complexupdate', 'id'=>$model->id)),
	array('label'=>Yii::t('adm-menu','Delete Clients'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('adm-menu','Manage Clients'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('adm-menu','View Clients'); ?> #<?php echo $model->id; ?></h1>

<? /* Begin About of tabs   the client */ ob_start(); ?>   
<div class="tabs about">  
    <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                    array('name'=>'id'),                          
                    array('name'=>'sid'),
                    array('name'=>'name'),                                    
                    array('name'=>'contact_person'),                                                                        
                    array('name'=>'phone'),                                                            
                    array('name'=>'email',
                          'type'=>'email',
                         ),                                                                                    
                    array('name'=>'site',
                          'type'=>'html',
                          'value'=>CHtml::link($model->site, $model->site)),                                                                                                            
                    array('name'=>'address'),                                                                                                                                    
                    array('name'=>'contacts'),                                                                                                                                                              
                    array('name'=>'status_id',
                          'value'=>($model->status_id ? $model->status->title : 'не установлен'), 
                    ),
                    array('name'=>'scope_id',
                          'value'=>($model->scope_id ? $model->scope->title : 'не установлен')
                    ),
                    array('name'=>'site_vids_id',
                          'value'=>($model->site_vids_id ? $model->siteVids->title : 'не установлен')
                    ),
                    array('name'=>'client_type_id',
                          'value'=>($model->client_type_id ? $model->clientType->title : 'не установлен')
                    ),                        
                    array('name'=>'email_types_id',
                          'value'=>($model->email_types_id ? $model->emailTypes->title : 'не установлен')
                    ),                                                
                    array('name'=>'phone_types_id',
                          'value'=>($model->phone_types_id ? $model->phoneTypes->title : 'не установлен')
                    ),                                                                        
                    array('name'=>'sort'),
                    array('name'=>'act',    
                          'value'=>($model->act ? 'да' : 'нет')
                    ),    
                    array('name'=>'del',    
                          'value'=>($model->del ? 'да' : 'нет')
                    ),                            
                    array('name'=>'desc'),          
                    array('name'=>'create_date',
                          'value'=>($model->create_date) ? $model->create_date : "" 
                    ),    
                    array('name'=>'update_date',
                          'value'=>($model->update_date) ? $model->update_date : ""                         
                    ),                                                                                         
            ),
    )); ?> 
</div>    
<?/* End About of tabs   the infoblock */ $cl_about = ob_get_contents(); ob_end_clean(); ?>  
        
<? /* Begin Developments of tabs the client */ ob_start(); ?>               
<div class="tabs client-developments">
    <?php $this->renderPartial('_client_devs',array(
                    'model'=>$model_client_developments, 'model_client'=>$model
          ));?>    
</div>
<?/* End Developments of tabs the client */ $cl_developments = ob_get_contents(); ob_end_clean(); ?>                    
<?/* Begin Orders of tabs the order */ ob_start(); ?>                
<div class="tabs orders"> 
    <div class="list-orders">
            <?php $this->renderPartial('_list_orders',array(
                    'model'=>$model_orders, 'model_client'=>$model                    
            ));?>
    </div>       
    <?/*<div class="about-orders">
        
        <?/* Begin Data of tabs the order  ob_start(); ?>                
        
        <div class="tabs data">    
            <?php $this->renderPartial('/orders/_form',array(
                    'model'=>$model_order,
            ));?>
        </div>
        <?/* End Data of tabs the order  $or_data = ob_get_contents(); ob_end_clean(); ?>                
        
        <?/* Begin Suitable of tabs the order  ob_start(); ?>                        
        <div class="tabs suitable" >
            <?php $this->renderPartial('_suitable',array(
                      'model'=>$model_suitable_area
            ));?>                
        </div>
        <?/* End Data of tabs the order  $or_suitable = ob_get_contents(); ob_end_clean(); ?>                        
        
        <?/* Begin Histories of tabs the order  ob_start(); ?>                                
        <div class="tabs histories" >
            <?php $this->renderPartial('_history_order',array(
                      'model'=>$model_history_order
            ));?> 
        </div>    
        <?/* End Histories of tabs the order  $or_histories = ob_get_contents(); ob_end_clean(); ?>                                
        <? 
            $this->widget('zii.widgets.jui.CJuiTabs', array(
                    //'name'=>'tabpanel-client-orders',  
                    'tabs'=>array(
                         Yii::t('all','Данные заявки')       =>array('content'=>$or_data,        'id'=>'order-data'),
                         Yii::t('all','Подходящие площади')  =>array('content'=>$or_suitable,    'id'=>'order-suitable'),
                         Yii::t('all','История заявки')      =>array('content'=>$or_histories,   'id'=>'order-histories'),
                         // panel 3 contains the content rendered by a partial view
                         //'AjaxTab'=>array('ajax'=>$ajaxUrl),
                    ),
                    // additional javascript options for the tabs plugin
                    'options'=>array(
                        'collapsible'=>true,
                        'selected'=>0,
                    ),
                  ));
        ?>                
    </div>*/?>
    <div class="clear" ></div>
</div>   
<?/* End Orders of tabs the client */ $cl_orders= ob_get_contents(); ob_end_clean(); ?> 

<?/* Begin Orders of tabs the order */ ob_start(); ?>                
<div class="tabs realestates"> 
    <div class="list-realestates">
            <?php $this->renderPartial('_list_spaces',array(
                    'model'=>$model_realestates, 'model_client'=>$model                    
            ));?>
    </div>  
    <div class="clear" ></div>
</div>    
<?/* End Orders of tabs the client */ $cl_realestates= ob_get_contents(); ob_end_clean(); ?> 

<? 
    $this->widget('zii.widgets.jui.CJuiTabs', array(
            //'name'=>'tabpanel-client',  
            'tabs'=>array(
                 Yii::t('all','Основное')       =>array('content'=>$cl_about,        'id'=>'client-about'),
                 //Yii::t('all','Комментарии')    =>array('content'=>$cl_desc,         'id'=>'client-desc'),
                 //Yii::t('all','Контакты')       =>array('content'=>$cl_contacts,     'id'=>'client-contacts'),
                 Yii::t('all','События')        =>array('content'=>$cl_developments, 'id'=>'client-developments'),                
                 Yii::t('all','Заявки')         =>array('content'=>$cl_orders,       'id'=>'client-orders'),                
                 Yii::t('all','Недвижимость')   =>array('content'=>$cl_realestates,       'id'=>'client-realestates'),                
                 // panel 3 contains the content rendered by a partial view
                 //'AjaxTab'=>array('ajax'=>$ajaxUrl),
            ),
            // additional javascript options for the tabs plugin
            'options'=>array(
                'collapsible'=>true,
                'selected'=>0,
            ),
          ));
?>
<script>
    //$('a[href="#client-realestates"]').click(function() { $.fn.yiiGridView.update('realestates-client-grid',{ data: $(this).serialize()});});
</script>
