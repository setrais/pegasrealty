<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'metro-manies-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'metro_id'); ?>
		<?php echo $form->textField($model,'metro_id'); ?>
		<?php echo $form->error($model,'metro_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'many_id'); ?>
		<?php echo $form->textField($model,'many_id'); ?>
		<?php echo $form->error($model,'many_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->