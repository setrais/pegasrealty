<?php
/* @var $this TypeSubscribeController */
/* @var $model TypeSubscribe */
/* @var $form CActiveForm */
?>

<div class="wide form l130">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'type-subscribe-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?=Yii::t('form','Fields marked <span color="red">*</span> are required for entry.');?></p>

	<?php echo $form->errorSummary($model); ?>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'grid'); ?>
		<?php echo $form->textField($model,'grid'); ?>
		<?php echo $form->error($model,'grid'); ?>
	</div>*/?>

        <div class="row">
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo $form->textField($model,'name',array('style'=>'width:120px','size'=>60,'maxlength'=>75)); ?>
            <?php echo $form->error($model,'name'); ?>
	</div>
        
       	<div class="row">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>75)); ?>
            <?php echo $form->error($model,'title'); ?>
	</div>
        
	<?/*<div class="row">
            <?php echo $form->labelEx($model,'keywords'); ?>
            <?php echo $form->textArea($model,'keywords',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'keywords'); ?>
	</div>*/?>

        <div class="row editor detile" style="padding-top:10px;">
                <center class="plashka" >
                    <?php echo $form->labelEx($model,'template'); ?>
                    <div class="p-t5">
                        <div class="p-l10 p-b6 halign-l">    
                          <span class="c-red">*</span> В шаблоне на данный момент возможно использовать следующие маски:   
                        </div>
                        <ul class="p-l10 halign-l" style="list-style-type: none;">
                            <li><span class="c-red p-l10">%NAME%</span> - Наименование новости, статьи, объявления</li>
                            <li><span class="c-red p-l10">%TITLE%</span> - Заголовок новости, статьи, объявления</li>
                            <li><span class="c-red p-l10">%URL%</span> -   URL новости, статьи, объявления</li>                            
                            <li><span class="c-red p-l10">%ANONS%</span> - Краткое описание новости, статьи, обявления</li>
                            <li><span class="c-red p-l10">%DATE%</span>  - Дата создания новости, статьи, обявления</li>
                            <li><span class="c-red p-l10">%DETILE%</span>- Детальное описание новости, статьи, обявления</li>
                            <li><span class="c-red p-l10">%PIC_ANONS%</span> - Картинка краткого описания новости, статьи, обявления</li>
                            <li><span class="c-red p-l10">%PIC_DETILE%</span> - Картинка краткого описания новости, статьи, обявления</li>      
                        </ul>
                   </div>
                </center>  
                <div>
                <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                        'model'=>$model,
                        'attribute'=>'template',
                        'config' => array(
                            'language'=> $langs[Yii::app()->language],
                            'uiColor' => '#ebebeb',//#ededed',// '#AADC6E',
                            'toolbar'=>array(
                                array('Source','DocProps','-','NewPage','Preview','-','Templates'),
                                array('Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'),
                                array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
                                array('FitWindow','ShowBlocks','-','About'),
                                array('Image','Flash','Table','Rule','Smiley','SpecialChar','PageBreak'),
                                '/',
                                array('Bold','Italic','Underline','StrikeThrough'/*,'-','Subscript','Superscript'*/),
                                //array('OrderedList','UnorderedList','-','Outdent','Indent','Blockquote','CreateDiv'),
                                array('JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'),
                                array('Link','Unlink','Anchor'),
                                array('TextColor','BGColor'),
                                array('Styles','Format','Font','FontSize'),
                                
                                /* Full button
                                { name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
                                { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                                { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
                                { name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
                                'HiddenField' ] },
                                '/',
                                { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                                { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
                                '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
                                { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                                { name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
                                '/',
                                { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
                                { name: 'colors', items : [ 'TextColor','BGColor' ] },
                                { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }*/
                                
                            ),                            
                            /*'toolbar'=>array(
                                array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
                                array( 'Image', 'Link', 'Unlink', 'Anchor' ) ,
                            ),*/
                        ),
                     )); ?>
		<?php// echo $form->textArea($model,'detile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'template'); ?>
                </div> 
        </div>        
	<?/*<div class="row">
            <?php echo $form->labelEx($model,'template'); ?>
            <?php echo $form->textArea($model,'template',array('rows'=>6, 'cols'=>50, 'style'=>'width:580px;')); ?>
            <?php echo $form->error($model,'template'); ?>
	</div>*/?>        
        
	<div class="row">
            <?php echo $form->labelEx($model,'icon',array('label'=>'Путь к иконке')); ?>
            <?php echo $form->textField($model,'icon',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'icon'); ?>
	</div>

      	<div class="row">
            <?php echo $form->labelEx($model,'sort'); ?>
            <?php echo $form->textField($model,'sort', array('style'=>'width:80px;')); ?>
            <?php echo $form->error($model,'sort'); ?>
	</div>                

	<div class="row">
            <?php echo $form->labelEx($model,'description'); ?>
            <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model,'act'); ?>
            <?php echo $form->checkBox($model,'act', ( $model->act===null && $model->act==1 ? "" : array("checked"=>"checked") )); ?>
            <?php echo $form->error($model,'act'); ?>
	</div>
        
        <div class="row">
            <?php echo $form->labelEx($model,'del'); ?>
            <?php echo $form->checkBox($model,'del', ( $model->del===null && $model->del==0 ? "" :  array("checked"=>"checked"))); ?>
            <?php echo $form->error($model,'del'); ?>
	</div>

	<div class="row buttons l130">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('form','Create') : Yii::t('form','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->