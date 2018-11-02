<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'objects-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sid'); ?>
		<?php echo $form->textField($model,'sid',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'sid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'abbr'); ?>
		<?php echo $form->textField($model,'abbr',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'abbr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'anons'); ?>
		<?php echo $form->textArea($model,'anons',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'anons'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detile'); ?>
		<?php echo $form->textArea($model,'detile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sort_main'); ?>
		<?php echo $form->textField($model,'sort_main'); ?>
		<?php echo $form->error($model,'sort_main'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'grid'); ?>
		<?php echo $form->textField($model,'grid'); ?>
		<?php echo $form->error($model,'grid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seo_keywords'); ?>
		<?php echo $form->textArea($model,'seo_keywords',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seo_title'); ?>
		<?php echo $form->textArea($model,'seo_title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seo_desc'); ?>
		<?php echo $form->textArea($model,'seo_desc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
		<?php echo $form->error($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_date'); ?>
		<?php echo $form->textField($model,'update_date'); ?>
		<?php echo $form->error($model,'update_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->