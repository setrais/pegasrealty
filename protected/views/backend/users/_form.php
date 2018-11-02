<div class="wide form l150">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?=Yii::t('form','*');?></p>

	<?php echo $form->errorSummary($model); ?>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>*/?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
        
         <div class="row">
		<?php echo $form->labelEx($model,'usersRoles'); ?> 
                <?php $data = CHtml::listData(AuthItem::model()->findAll(), 'id', 'name'); ?> 
                <?php $this->widget('ext.widgets.EchMultiSelect', array(
                          // the data model associated with this widget:
                          'model' => $model,
                          // the attribute associated with drop down list of this widget:
                          'dropDownAttribute' => 'usersRoles',     
                          // data for generating the options of the drop down list:
                          'data' => $data,                            
                          // the name of the drop down list (this must be set if 'model' and 'dropDownAttribute' are not set):
                          'name' => 'Realestates_usersRoles',    
                          // additional HTML attributes for the drop down list: 
                          'dropDownHtmlOptions'=> array(
                            'style'=>'width:auto'/*'width:378px;'*/,
                            'multiple'=>true,
                            //'options'=>(isset($selProperties) ? $selProperties : array()),                              
                          ),
                          // options for the jQuery UI MultiSelect Widget
                          // (see the project page for available options):
                          'options' => array( 
                            'selectedList'=>5,
                            'header'=>false,
                            // set this to true, if you want to use the Filter Plugin
                            'filter'=>false,
                            'height'=>100,                               
                          ),
                )); ?>            
                
		<?php echo $form->error($model,'usersRoles'); ?>
	</div>        
        
	<div class="row">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'del'); ?>
                <?php echo $form->checkBox($model,'del'); ?>
		<?php echo $form->error($model,'del'); ?>
	</div>

        <div class="row">
                <?php echo $form->labelEx($model,'act'); ?>
                <?php echo $form->checkBox($model,'act'); ?>
                <?php echo $form->error($model,'act'); ?>
        </div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>40,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>25,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>37,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'send_email'); ?>
		<?php echo $form->textField($model,'send_email',array('size'=>37,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'send_email'); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'register_date'); ?>
		<?php echo $form->textField($model,'register_date'); ?>
		<?php echo $form->error($model,'register_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastvisit_date'); ?>
		<?php echo $form->textField($model,'lastvisit_date'); ?>
		<?php echo $form->error($model,'lastvisit_date'); ?>
	</div>*/?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
		<?php echo $form->error($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_date'); ?>
		<?php echo $form->textField($model,'update_date'); ?>
		<?php echo $form->error($model,'update_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'param_id'); ?>
		<?php echo $form->textField($model,'param_id'); ?>
		<?php echo $form->error($model,'param_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'param_uid'); ?>
		<?php echo $form->textField($model,'param_uid',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'param_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phpBBLogin'); ?>
		<?php echo $form->textField($model,'phpBBLogin',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'phpBBLogin'); ?>
	</div>*/?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('form','Create') : Yii::t('form','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->