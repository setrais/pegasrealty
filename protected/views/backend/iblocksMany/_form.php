<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'iblocks-many-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'iblock_id'); ?>
		<?php echo $form->textField($model,'iblock_id'); ?>
		<?php echo $form->error($model,'iblock_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_iblock_id'); ?>
		<?php echo $form->textField($model,'type_iblock_id'); ?>
		<?php echo $form->error($model,'type_iblock_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->