<div class="wide form l150">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fio'); ?>
		<?php echo $form->textField($model,'fio',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'site'); ?>
		<?php echo $form->textField($model,'site',array('size'=>60,'maxlength'=>255)); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>    

        <div class="row">     
            <?php// echo $form->label($model,'telephone'); ?>            
            <?php// echo $form->textField($model,'telephone',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo CHtml::label(Yii::t('all','Phone Contact'),'Contact_telephone'); ?>
            <?php
                              $this->widget('CMaskedTextField', array(
                                    //'model' => $model,
                                    'name' => 'Contact_telephone',
                                    'attribute' => 'telephone',
                                    'mask' => '8(xxx)xxx-xx-xx',
                                    'charMap' => array('x'=>'[x0-9]','9'=>'[0-9]'),
                                    'htmlOptions' => array('size' => 13),
                                    'placeholder'=>'x'
                                    ));
                                    ?>           
	</div>	
    
	<div class="row">
		<?php echo $form->label($model,'fax'); ?>            
		<?php// echo $form->textField($model,'fax',array('size'=>60,'maxlength'=>255)); ?>
                            <?php                            
                              $this->widget('CMaskedTextField', array(
                                    //'model' => $model,
                                    'name' => 'Contact_fax',
                                    'attribute' => 'fax',
                                    'mask' => '8(xxx)xx9-99-99',
                                    'charMap' => array('x'=>'[x0-9]','9'=>'[0-9]'),
                                    'htmlOptions' => array('size' => 13),
                                    'placeholder'=>'x'
                                    ));
                ?>	
	</div>    
        <?/*
	<div class="row">
		<?php echo $form->label($model,'telephone_1'); ?>
		<?php echo $form->textField($model,'telephone_1',array('size'=>60,'maxlength'=>255)); ?>
	</div>    
    
	<div class="row">
		<?php echo $form->label($model,'telephone_2'); ?>
		<?php echo $form->textField($model,'telephone_2',array('size'=>60,'maxlength'=>255)); ?>
	</div>        

	<div class="row">
		<?php echo $form->label($model,'telephone_3'); ?>
		<?php echo $form->textField($model,'telephone_3',array('size'=>60,'maxlength'=>255)); ?>
	</div>    
    
	<div class="row">
		<?php echo $form->label($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
	</div>
        */?>
	<div class="row">
		<?php echo $form->label($model,'act'); ?>
                <?php// echo $form->textField($model,'act'); ?>
                <?php// echo $form->checkBox($model,'act',array('value'=>null)); ?>
                <?php echo $form->dropDownList($model,'act',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>		
	</div>

	<div class="row">
		<?php echo $form->label($model,'del'); ?>
		<?php// echo $form->textField($model,'del'); ?>
                <?php echo $form->dropDownList($model,'del',  
                                     array(""=>"все","0"=>"нет","1"=>"да")); ?>		
	</div>

	<div class="row">
             <label for="create_date-from"><?=Yii::t('all','Date of create from');?></label>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'create_date-from',
                    /*'model'=>$model,
                    'attribute'=>'create_date',*/   
                    'theme'=>'ui-lightness',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',  
                        'defaultDate'=>date('d.m.Y'),                                                
                        'showButtonPanel'=>true,
                        'showOn'=> "button",
			'buttonImage'=> "/images/calendar.gif",
			'buttonImageOnly'=> true,
                        //set calendar z-index higher then UI Dialog z-index 
                        'beforeShow'=>"js:function() {
                            $('.ui-datepicker').css('font-size', '0.8em');
                            $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                }",

                     ),   
                    'htmlOptions'=>array('size'=>8 ),
                )); ?>                
            <b> <?=Yii::t('all','on');?> </b>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'create_date-to',
                    /*'model'=>$model,
                    'attribute'=>'create_date',*/   
                    'theme'=>'ui-lightness',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',  
                        'defaultDate'=>date('d.m.Y'),                                                
                        'showButtonPanel'=>true,
                        'showOn'=> "button",
			'buttonImage'=> "/images/calendar.gif",
			'buttonImageOnly'=> true,
                        //set calendar z-index higher then UI Dialog z-index 
                        'beforeShow'=>"js:function() {
                            $('.ui-datepicker').css('font-size', '0.8em');
                            $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                }",

                     ),   
                    'htmlOptions'=>array('size'=>8 ),
                )); ?>           
		<?php// echo $form->label($model,'create_date'); ?>
		<?php// echo $form->textField($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php// echo $form->label($model,'update_date'); ?>
		<?php// echo $form->textField($model,'update_date'); ?>
                <label for="update_date-from"><?=Yii::t('all','Date of update from');?></label>		
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'update_date-from',
                    /*'model'=>$model,
                    'attribute'=>'create_date',*/   
                    'theme'=>'ui-lightness',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',  
                        'defaultDate'=>date('d.m.Y'),                                                
                        'showButtonPanel'=>true,
                        'showOn'=> "button",
			'buttonImage'=> "/images/calendar.gif",
			'buttonImageOnly'=> true,
                        //set calendar z-index higher then UI Dialog z-index 
                        'beforeShow'=>"js:function() {
                            $('.ui-datepicker').css('font-size', '0.8em');
                            $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                }",

                     ),   
                    'htmlOptions'=>array('size'=>8 ),
                )); ?>                
            <b> <?=Yii::t('all','on');?> </b>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'language'=> Yii::app()->params->language,                                        
                    'name'=>'update_date-to',
                    /*'model'=>$model,
                    'attribute'=>'create_date',*/   
                    'theme'=>'ui-lightness',
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',  
                        'defaultDate'=>date('d.m.Y'),                                                
                        'showButtonPanel'=>true,
                        'showOn'=> "button",
			'buttonImage'=> "/images/calendar.gif",
			'buttonImageOnly'=> true,
                        //set calendar z-index higher then UI Dialog z-index 
                        'beforeShow'=>"js:function() {
                            $('.ui-datepicker').css('font-size', '0.8em');
                            $('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
                }",

                     ),   
                    'htmlOptions'=>array('size'=>8 ),
                )); ?>     
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('form','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->