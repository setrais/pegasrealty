<div class="wide form l150">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'representatives-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?=Yii::t('form','*');?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fio'); ?>
		<?php echo $form->textField($model,'fio',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'fio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site'); ?>
		<?php echo $form->textField($model,'site',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'site'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php/* echo $form->labelEx($model,'telephone'); ?>
		<?php echo $form->textField($model,'telephone',array('size'=>60,'maxlength'=>255)); */?>
                <?php echo $form->labelEx($model,'telephone'); ?>
                <?php                            
                              $this->widget('CMaskedTextField', array(
                                    'model' => $model,
                                    'attribute' => 'telephone',
                                    'mask' => '8(xxx)xx9-99-99',
                                    'charMap' => array('x'=>'[x0-9]','9'=>'[0-9]'),
                                    'htmlOptions' => array('size' => 13),
                                    'placeholder'=>'x'
                                    ));
                                    ?>
                <?php echo $form->error($model,'telephone'); ?>
	</div>
        
	<div class="row">
                <?php echo $form->labelEx($model,'fax'); ?>
                <?php                            
                              $this->widget('CMaskedTextField', array(
                                    'model' => $model,
                                    'attribute' => 'fax',
                                    'mask' => '8(xxx)xx9-99-99',
                                    'charMap' => array('x'=>'[x0-9]','9'=>'[0-9]'),
                                    'htmlOptions' => array('size' => 13),
                                    'placeholder'=>'x'
                                    ));
                ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>        

	<div class="row">
		<?php/* echo $form->labelEx($model,'telephone_1'); ?>
		<?php echo $form->textField($model,'telephone_1',array('size'=>60,'maxlength'=>75)); */?>
                <?php echo $form->labelEx($model,'telephone_1'); ?>
                <?php                            
                              $this->widget('CMaskedTextField', array(
                                    'model' => $model,
                                    'attribute' => 'telephone_1',
                                    'mask' => '8(xxx)xx9-99-99',
                                    'charMap' => array('x'=>'[x0-9]','9'=>'[0-9]'),
                                    'htmlOptions' => array('size' => 13),
                                    'placeholder'=>'x'
                                    ));
                                    ?>            
		<?php echo $form->error($model,'telephone_1'); ?>
	</div>
        
	<div class="row">
		<?php/* echo $form->labelEx($model,'telephone_2'); ?>
		<?php echo $form->textField($model,'telephone_2',array('size'=>60,'maxlength'=>255)); */?>
                <?php echo $form->labelEx($model,'telephone_2'); ?>
                <?php                            
                              $this->widget('CMaskedTextField', array(
                                    'model' => $model,
                                    'attribute' => 'telephone_2',
                                    'mask' => '8(xxx)xx9-99-99',
                                    'charMap' => array('x'=>'[x0-9]','9'=>'[0-9]'),
                                    'htmlOptions' => array('size' => 13),
                                    'placeholder'=>'x'
                                    ));
                                    ?>            
		<?php echo $form->error($model,'telephone_2'); ?>
	</div>
        
	<div class="row">
		<?php/* echo $form->labelEx($model,'telephone_3'); ?>
		<?php echo $form->textField($model,'telephone_3',array('size'=>60,'maxlength'=>255)); */?>
                <?php echo $form->labelEx($model,'telephone_3'); ?>
                <?php                            
                              $this->widget('CMaskedTextField', array(
                                    'model' => $model,
                                    'attribute' => 'telephone_3',
                                    'mask' => '8(xxx)xx9-99-99',
                                    'charMap' => array('x'=>'[x0-9]','9'=>'[0-9]'),
                                    'htmlOptions' => array('size' => 13),
                                    'placeholder'=>'x'
                                    ));
                                    ?>            
		<?php echo $form->error($model,'telephone_3'); ?>
	</div>        

	<div class="row">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort',array('size'=>10,'maxlength'=>75, 'style'=>'width:24px;')); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>70, 'style'=>'width:540px;')); ?>
		<?php echo $form->error($model,'desc'); ?>
	</div>
        
        <? if ( Yii::app()->user->checkAccess('superadmin') /*|| Yii::app()->user->name == 'adminone'*/ ) { ?> 
        <div class="row">
		<?php echo $form->labelEx($model,'act'); ?>
		<?php echo $form->checkBox($model,'act',array('value'=>1,'uncheckValue'=>0,'checked'=>( $model->isNewRecord && $model->act==null ? "checked" : $model->act ? "checked" : "" ) )); ?>
		<?php echo $form->error($model,'act'); ?>
	</div>
        <? } ?>
        <? if ( Yii::app()->user->checkAccess('superadmin')) { ?> 
        <div class="row">
		<?php echo $form->labelEx($model,'del'); ?>
		<?php echo $form->checkBox($model,'del',array('value'=>1,'uncheckValue'=>0,'checked'=>( $model->isNewRecord && $model->act==null ? "" : $model->del ? "checked" : "") )); ?>
		<?php echo $form->error($model,'del'); ?>
	</div>        
        <? } ?>

	<div class="row">
		<?php/* echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); */?>
                <?php echo $form->labelEx($model,'create_date'); ?>
                <?php $langs = array_flip(Yii::app()->params->languages); 
                      if ($model->create_date) $model->create_date = date('d.m.Y', strtotime($model->create_date))
                ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language'=> $langs[Yii::app()->language],                                        
                        'model'=>$model,
                        'attribute'=>'create_date',   
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
                <?php echo $form->error($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_date'); ?>
		<?php// echo $form->textField($model,'update_date'); ?>
                <?php $langs = array_flip(Yii::app()->params->languages); 
                      if ($model->update_date) $model->update_date = date('d.m.Y',  strtotime($model->update_date))
                ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'language'=> $langs[Yii::app()->language],                                        
                        'model'=>$model,
                        'attribute'=>'update_date',   
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
		<?php echo $form->error($model,'update_date'); ?>
	</div>        

	<div class="row buttons">
                <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('form','Create') : Yii::t('form','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->