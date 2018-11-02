<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-histories-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_id'); ?>
		<?php echo $form->textField($model,'order_id'); ?>
		<?php echo $form->error($model,'order_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createdate'); ?>
		<?php echo $form->textField($model,'createdate'); ?>
		<?php echo $form->error($model,'createdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updatedate'); ?>
		<?php echo $form->textField($model,'updatedate'); ?>
		<?php echo $form->error($model,'updatedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createuser'); ?>
		<?php echo $form->textField($model,'createuser'); ?>
		<?php echo $form->error($model,'createuser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->textField($model,'updateuser'); ?>
		<?php echo $form->error($model,'updateuser'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'operation_id'); ?>
		<?php echo $form->textField($model,'operation_id'); ?>
		<?php echo $form->error($model,'operation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_from'); ?>
		<?php echo $form->textField($model,'price_from',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_to'); ?>
		<?php echo $form->textField($model,'price_to',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'area_from'); ?>
		<?php echo $form->textField($model,'area_from'); ?>
		<?php echo $form->error($model,'area_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'area_to'); ?>
		<?php echo $form->textField($model,'area_to'); ?>
		<?php echo $form->error($model,'area_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'realestate_type_id'); ?>
		<?php echo $form->textField($model,'realestate_type_id'); ?>
		<?php echo $form->error($model,'realestate_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'realestate_vid_id'); ?>
		<?php echo $form->textField($model,'realestate_vid_id'); ?>
		<?php echo $form->error($model,'realestate_vid_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'realestate_class_id'); ?>
		<?php echo $form->textField($model,'realestate_class_id'); ?>
		<?php echo $form->error($model,'realestate_class_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'district_id'); ?>
		<?php echo $form->textField($model,'district_id'); ?>
		<?php echo $form->error($model,'district_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valute_id'); ?>
		<?php echo $form->textField($model,'valute_id'); ?>
		<?php echo $form->error($model,'valute_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit_id'); ?>
		<?php echo $form->textField($model,'unit_id'); ?>
		<?php echo $form->error($model,'unit_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remoteness'); ?>
		<?php echo $form->textField($model,'remoteness',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'remoteness'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit_value'); ?>
		<?php echo $form->textField($model,'unit_value',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'unit_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'poligon'); ?>
		<?php echo $form->textArea($model,'poligon',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'poligon'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->