<?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('if','Contact Us');
$this->breadcrumbs=array(
	Yii::t('if','Contact Us'),
);
?>

<h1>
<?=Yii::t('if','Contact Us')?>
</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
  <?=Yii::t('if','if you have business'); ?>
  <?/*If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.*/?>
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">
            <?=Yii::t('form','*');?>
        </p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo str_replace( 'Name', Yii::t('form','Name'), $form->labelEx($model,'name')); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
                <?php echo str_replace( 'Email', Yii::t('form','Email'), $form->labelEx($model,'email')); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
                <?php echo str_replace( 'Subject', Yii::t('form','Subject'), $form->labelEx($model,'subject')); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo str_replace( 'Body', Yii::t('form','Body'), $form->labelEx($model,'body')); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50, 'style'=>'width:382px;')); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
                <?php echo str_replace( 'Verification Code', Yii::t('form','VerifyCode'), $form->labelEx($model,'verifyCode')); ?>
		<div>
		<?php $this->widget('CCaptcha',array('buttonLabel'=>Yii::t('form','Get a new code'))); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint"><?=Yii::t('form','Captcha plentletter');?>
		<br/><?=Yii::t('form','Letters are not case-sensitive.');?></div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('form','Submit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>