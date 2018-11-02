<?php  // Подключаем скрипт посчета поля textarea
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/cnttextarea.css');      
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/cnttextarea.js');  
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/charCount.js');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/kwcount/kwcount.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/kwcount/kwcount.js');   
?>
<div class="wide form l150">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'partners-form',
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note"><?=Yii::t('form','Fields marked <span color="red">*</span> are required for entry.');?></p>
    <?php echo $form->errorSummary($model,'Исправьте, пожалуйста, следующие ошибки:'); ?>  

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'abbr'); ?>
		<?php echo $form->textField($model,'abbr',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'abbr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>*/?>

        <div class="row">
                   <?php echo $form->labelEx($model,'title'); ?>
                   <?php echo $form->textField($model,'title',array('style'=>'width:380px','size'=>60,'maxlength'=>255)); ?>
                   <?php echo $form->error($model,'title'); ?>
        </div>
 
        <div class="row">
                   <?php echo $form->labelEx($model,'act'); ?>
                   <?php echo $form->checkBox($model,'act'); ?>
                   <?php echo $form->error($model,'act'); ?>
        </div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'del'); ?>
		<?php echo $form->checkBox($model,'del'); ?>
		<?php echo $form->error($model,'del'); ?>
	</div>

        <div class="row">
                    <?php echo $form->labelEx($model,'sort'); ?>
                    <?php echo $form->textField($model,'sort', array('style'=>'width:34px;', 'maxlength'=>'4')); ?>
                    <?php echo $form->error($model,'sort'); ?>
        </div>

        <div class="row <?/*editor anons*/?>">
		<?php echo $form->labelEx($model,'anons'); ?>
		<?php echo $form->textArea($model,'anons',array('rows'=>6, 'cols'=>65,'style'=>"width:540px;", 'OnKeyUp'=>'createStat(this, 200, 450);', 'OnChange'=>'createStat(this, 200, 450);')); ?>		
                <?php/* $this->widget('application.extensions.eckeditor.ECKEditor', array(
                        'model'=>$model,
                        'attribute'=>'anons',
                        'config' => array(
                        'toolbar'=>array(
                            array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
                            array( 'Image', 'Link', 'Unlink', 'Anchor' ) ,
                        ),
                      ),                    
                     )); */?>
                <?php echo $form->error($model,'anons'); ?>
                <script>
                    createTextAreaWidget('Areas_anons', 200, 450);
                </script>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'infocode'); ?>
		<?php echo $form->textArea($model,'infocode',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'infocode'); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'ddog'); ?>
		<?php echo $form->textField($model,'ddog'); ?>
		<?php echo $form->error($model,'ddog'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ndog'); ?>
		<?php echo $form->textField($model,'ndog',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'ndog'); ?>
	</div>*/?>

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
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact'); ?>
		<?php echo $form->textField($model,'contact',array('size'=>60,'maxlength'=>125)); ?>
		<?php echo $form->error($model,'contact'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mypage'); ?>
		<?php echo $form->textField($model,'mypage',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mypage'); ?>
	</div>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
		<?php echo $form->error($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_user'); ?>
		<?php echo $form->textField($model,'create_user'); ?>
		<?php echo $form->error($model,'create_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_date'); ?>
		<?php echo $form->textField($model,'update_date'); ?>
		<?php echo $form->error($model,'update_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_user'); ?>
		<?php echo $form->textField($model,'update_user'); ?>
		<?php echo $form->error($model,'update_user'); ?>
	</div>*/?>

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'desc', array('label'=>'Заметки')); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>1, 'cols'=>50)); ?>
		<?php echo $form->error($model,'desc'); ?>
	</div>*/?>  
    
        <div class="row editor desc" style="padding-top:10px;" >
		<center class="plashka" ><?php echo $form->labelEx($model,'desc', array('label'=>'Заметки')); ?></center>  
                <div>
                <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
                        'model'=>$model,
                        'attribute'=>'desc',   
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
                                array('Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'),
                                array('OrderedList','UnorderedList','-','Outdent','Indent','Blockquote','CreateDiv'),
                                array('JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'),
                                array('Link','Unlink','Anchor'),
                                array('TextColor','BGColor'),
                                array('Style','FontFormat','FontName','FontSize'),
                                
                            ),
                        ),    
                     )); ?>            
		<?php echo $form->error($model,'desc'); ?>
                </div>    
	</div>    

	<?/*<div class="row">
		<?php echo $form->labelEx($model,'logo_id'); ?>
		<?php echo $form->textField($model,'logo_id'); ?>
		<?php echo $form->error($model,'logo_id'); ?>
	</div>*/?>

        <div class="row">
            <?php echo $form->labelEx($model,'client_type_id'); ?>
            <?php echo $form->dropDownList($model,'client_type_id',   
                         CHtml::listData(ClientTypes::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                           array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select')."...")); ?>                                     
            <?php// echo $form->textField($model,'client_type_id'); ?>
            <?php echo $form->error($model,'client_type_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'client_id'); ?>
            <?php echo $form->dropDownList($model,'client_id',   
                         CHtml::listData(Clients::model()->findAll(array("condition"=>"(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                                                         "select"=>"t.sort, t.id, CONCAT_WS(' - ',t.name,t.contact_person,t.email) as contact",
                                                                         "order"=>"t.sort")), 'id', 'contact'), array('prompt'=>Yii::t('all','Select')."...")); ?>                                     
            <?php// echo $form->textField($model,'client_type_id'); ?>
            <?php echo $form->error($model,'client_id'); ?>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('form','Create') : Yii::t('form','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->