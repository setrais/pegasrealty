<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'realestate-filters-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'aid'); ?>
		<?php echo $form->textField($model,'aid',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'aid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_title'); ?>
		<?php echo $form->textField($model,'name_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_many'); ?>
		<?php echo $form->textField($model,'name_many',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name_many'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_that'); ?>
		<?php echo $form->textField($model,'name_that',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name_that'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fomula'); ?>
		<?php echo $form->textArea($model,'fomula',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fomula'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->