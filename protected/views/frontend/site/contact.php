<?php
$this->pageTitle=Yii::t('menu','Contact').' - '.Yii::t('all',Yii::app()->name);
$this->pageDescription = 'Форма обратной связи портала '.Yii::t('all',Yii::app()->name);
$this->breadcrumbs=array(
	Yii::t('menu','Contact'),
);
?>

<h1>
<?=Yii::t('menu','Contact')?>
</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>
<div class="fl w-50p">
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

	<?php echo $form->errorSummary($model,'Исправьте, пожалуйста, следующие ошибки:'); ?>

	<div class="row">
		<?php echo str_replace( 'Name', Yii::t('form','Name'), $form->labelEx($model,'name')); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

        <div class="row">
                <?php echo str_replace( 'Phone', Yii::t('form','Phone'), $form->labelEx($model,'phone')); ?>
		<?php echo $form->textField($model,'phone'); ?>
		<?php echo $form->error($model,'phone'); ?>
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
	<div class="row capt">
                <?php echo str_replace( 'Verification Code', Yii::t('form','VerifyCode'), $form->labelEx($model,'verifyCode')); ?>
		<div>
		<?php $this->widget('CCaptcha',array('buttonLabel'=>CHtml::image('/images/icons/refresh-24x24.png', Yii::t("form","Refresh"), array('title'=>Yii::t('form','Get a new code'),'style'=>'vertical-align:middle;margin:0.2em 0 0.5em')),'buttonType'=>'link')); ?>
		<?php echo $form->textField($model,'verifyCode',array('size'=>4/*'style'=>"width:60px")*/)); ?>
		</div>
                <?php echo $form->error($model,'verifyCode'); ?>
		<div class="hint"><?=Yii::t('form','Captcha plentletter');?>
		<br/><?=Yii::t('form','Letters are not case-sensitive.');?></div>		
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('form','Submit')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
   </div>
   <div class="fl">
       <div>
         <h2 class="fs-18">Карта проезда</h2>
         <?php echo CHtml::link(CHtml::image( '/images/maps/карта-small.png','', 
                        array('title'=>'Карта проезда')), 
                              '/images/maps/карта.png', 
                              array('class'=>'fancyImage')); ?>
         <h2 class="fs-18">Наши реквезиты</h2>
         <div class="row">
             <label class="c-333 bold p-r10" for="myname">Название:</label>ООО "Пегас недвижимость" (Ltd. Pegas Realty)</div>
         <div class="row">
             <label class="c-333 bold p-r10" for="myphone">Телефон:</label>+7 (495) 222-95-20
         </div>
         <div class="row">
             <label class="c-333 bold p-r10" for="myemail">Электронная почта:</label> info@pegasrealty.ru
         </div>
         <div class="row">
             <label class="c-333 bold p-r10" for="myaddress">Адрес:</label>117449, Россия, г.Москва, ул. Орджоникидзе, д. 11, стр. 7, офис №6
         </div>
         <div class="row">
             <label class="c-333 bold p-r10" for="myaddress">ИНН:</label>7727779569
             <label class="c-333 bold p-r10" for="myaddress">ОГРН:</label>1127746406996
         </div>         
         <div class="row">
             <label class="c-333 bold p-r10" for="mytime">Часы работы:</label>пн.-пт.  с 10:00-20.00, сб., вс. - вых.
         </div>  
       </div>      
   </div>
   <div class="clear"></div>

<?php endif; ?>
<script>
    $(document).ready(function() {
    $(".fancyImage").fancybox(
       {'overlayShow': true, 'hideOnContentClick': false});
    }); 
</script> 