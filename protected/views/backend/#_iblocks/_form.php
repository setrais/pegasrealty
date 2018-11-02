<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'iblocks-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

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

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'visname'); ?>
		<?php echo $form->textField($model,'visname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'visname'); ?>
	</div>*/?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keywords'); ?>
		<?php echo $form->textArea($model,'keywords',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'anons'); ?>
		<?php echo $form->textField($model,'anons',array('size'=>60,'maxlength'=>257)); ?>
		<?php echo $form->error($model,'anons'); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'pic_anons'); ?>
		<?php echo $form->textField($model,'pic_anons',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'pic_anons'); ?>
	</div>*/?>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'pic_detile'); ?>
		<?php echo $form->textArea($model,'pic_detile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'pic_detile'); ?>
	</div>*/?>

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

	<div class="row">
		<?php echo $form->labelEx($model,'createusers'); ?>
		<?php echo $form->textField($model,'createusers'); ?>
		<?php echo $form->error($model,'createusers'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createdate'); ?>
		<?php echo $form->textField($model,'createdate'); ?>
		<?php echo $form->error($model,'createdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updateusers'); ?>
		<?php echo $form->textField($model,'updateusers'); ?>
		<?php echo $form->error($model,'updateusers'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updatedate'); ?>
		<?php echo $form->textField($model,'updatedate'); ?>
		<?php echo $form->error($model,'updatedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detile'); ?>
		<?php echo $form->textArea($model,'detile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cid'); ?>
		<?php echo $form->textField($model,'cid',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_main'); ?>
		<?php echo $form->textField($model,'is_main'); ?>
		<?php echo $form->error($model,'is_main'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_pay'); ?>
		<?php echo $form->textField($model,'is_pay'); ?>
		<?php echo $form->error($model,'is_pay'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_arhiv'); ?>
		<?php echo $form->textField($model,'is_arhiv'); ?>
		<?php echo $form->error($model,'is_arhiv'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_use'); ?>
		<?php echo $form->textField($model,'is_use'); ?>
		<?php echo $form->error($model,'is_use'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maps_id'); ?>
		<?php echo $form->textField($model,'maps_id',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'maps_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'types_iblocks_id'); ?>
		<?php echo $form->textField($model,'types_iblocks_id'); ?>
		<?php echo $form->error($model,'types_iblocks_id'); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'iurl'); ?>
		<?php echo $form->textField($model,'iurl',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'iurl'); ?>
	</div>*/?>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textArea($model,'url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city'); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visible'); ?>
		<?php echo $form->textField($model,'visible',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'visible'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'action'); ?>
		<?php echo $form->textField($model,'action',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'action'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->