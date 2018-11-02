<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'types-iblocks-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?=Yii::t('form','*');?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'grid'); ?>
		<?php echo $form->textField($model,'grid'); ?>
		<?php echo $form->error($model,'grid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textField($model,'desc',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'act'); ?>
		<?php echo $form->textField($model,'act'); ?>
		<?php echo $form->error($model,'act'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'del'); ?>
		<?php echo $form->textField($model,'del'); ?>
		<?php echo $form->error($model,'del'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('all','Create') : Yii::t('all','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->