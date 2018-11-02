<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl.'/css/frontend/jquery.formstyler.css');
?>     
<div class="wide form l183">
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'subs-form',
            'enableClientValidation'=>true,
            'enableAjaxValidation'=>true,
            'method'=>'post',
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
            //'action'=>Yii::app()->createUrl($this->route),
            //'htmlOptions'=>array('enctype'=>'multipart/form-data', /*'style'=>'display:inline-block;margin-bottom: -20px;'*/),
    )); ?>    
    <div class="row">    
        <?php  echo $form->labelEx($model,'email',array('label'=>'Подписаться на объявления')); ?>
        <?php  echo $form->textField($model,'email',array('class'=>'styler','placeholder'=>'email','value'=>Yii::app()->user->getModel()->email)); ?>
        <?php  echo $form->hiddenField($model,'typesubs_id',array('value'=>$typesubs_id)); ?> 
        <?php  echo CHtml::ajaxButton('Подписаться',
            Yii::app()->createUrl('/subscribe/add'),
                                          array( 'method'=>'post',
                                                 'dataType'=>'json',
                                                 'data'=>'js:$("#subs-form").serialize()',    
                                                 'beforeSend'=>'function(){                                                                                                                               
                                                 }', 
                                                 'complete' => 'function(){                                                
                                                 }',
                                                 'success'=>"js:function(data){
                                                       if (!data.error) {
                                                           $('#alert.popup').html(data.mess);                                                           
                                                           $('#alert').dialog({dialogClass:'alert'});                                                                 
                                                           $('#alert').dialog({open:function() { $(this).parents('.ui-dialog:first').find('.ui-dialog-titlebar-close').remove();}});                                                                
                                                           $('#alert').dialog('open'); 
 
                                                       }else{                                                           
                                                           $('#alert.popup').html(data.mess);
                                                           $('#alert').dialog({dialogClass:'alert'});              
                                                           $('#alert').dialog({open:function() { $(this).parents('.ui-dialog:first').find('.ui-dialog-titlebar-close').remove();}});                                                                
                                                           $('#alert').dialog('open'); 
                                                       }
                                                }"                                              
                                                //'update'=>'#',                                                      
                                          ),
                                          array('class'=>'styler')); ?>
    </div>    
    <?php $this->endWidget(); ?>
</div> 