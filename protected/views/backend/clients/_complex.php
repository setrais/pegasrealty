
<? /* Begin About of tabs   the client */ ob_start(); ?>   
<div class="tabs about">  
    <?php $this->renderPartial('_form',array(
                    'model'=>$model
          ));?>  
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