<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'realestate-fotos-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'realestate_id'); ?>
		<?php echo $form->textField($model,'realestate_id'); ?>
		<?php echo $form->error($model,'realestate_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'realestate_foto_type_id'); ?>
		<?php echo $form->textField($model,'realestate_foto_type_id'); ?>
		<?php echo $form->error($model,'realestate_foto_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'file_id'); ?>
		<?php echo $form->textField($model,'file_id'); ?>
		<?php echo $form->error($model,'file_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->