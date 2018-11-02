<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'realestate-destinations-form',
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
		<?php echo $form->labelEx($model,'destination_id'); ?>
		<?php echo $form->textField($model,'destination_id'); ?>
		<?php echo $form->error($model,'destination_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->