<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tax-reference-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'num'); ?>
		<?php echo $form->textField($model,'num'); ?>
		<?php echo $form->error($model,'num'); ?>
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
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
		<?php echo $form->error($model,'sort'); ?>
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
		<?php echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
		<?php echo $form->error($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_date'); ?>
		<?php echo $form->textField($model,'update_date'); ?>
		<?php echo $form->error($model,'update_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'grid'); ?>
		<?php echo $form->textField($model,'grid'); ?>
		<?php echo $form->error($model,'grid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'district_id'); ?>
		<?php echo $form->textField($model,'district_id'); ?>
		<?php echo $form->error($model,'district_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'index'); ?>
		<?php echo $form->textField($model,'index',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'index'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'index_fact'); ?>
		<?php echo $form->textField($model,'index_fact',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'index_fact'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address_fact'); ?>
		<?php echo $form->textField($model,'address_fact',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address_fact'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'metro_id'); ?>
		<?php echo $form->textField($model,'metro_id'); ?>
		<?php echo $form->error($model,'metro_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proezd'); ?>
		<?php echo $form->textField($model,'proezd',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'proezd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_2'); ?>
		<?php echo $form->textField($model,'phone_2',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'phone_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_3'); ?>
		<?php echo $form->textField($model,'phone_3',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'phone_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site'); ?>
		<?php echo $form->textField($model,'site',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'site'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
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
		<?php echo $form->labelEx($model,'seo_title'); ?>
		<?php echo $form->textField($model,'seo_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'seo_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seo_desc'); ?>
		<?php echo $form->textArea($model,'seo_desc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seo_keywords'); ?>
		<?php echo $form->textArea($model,'seo_keywords',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_keywords'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->