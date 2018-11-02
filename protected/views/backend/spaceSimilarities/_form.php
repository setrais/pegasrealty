<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'space-similarities-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'space_id'); ?>
		<?php echo $form->textField($model,'space_id'); ?>
		<?php echo $form->error($model,'space_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'similaries_id'); ?>
		<?php echo $form->textField($model,'similaries_id'); ?>
		<?php echo $form->error($model,'similaries_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->