<div id="sendorder" class="popup" style="display:none;">    
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'sendfav-form',
            'htmlOptions'=>array('class'=>'sendfav'), 
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                    'validateOnSubmit'=>true,
            ),
    )); ?>        
    <p class="note">
            <?=Yii::t('form','*');?>
    </p>        
    <?php echo $form->errorSummary($model); ?>
    <div>
        <?php echo $form->hiddenField($model,'nid'); ?>
    </div>
    <table width="315" cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <tr>
           <td colspan="2" valign="top"><?php echo $form->labelEx($model,'fio'); ?>:</td>                    
        </tr>
        <tr>
           <td colspan="2" valign="top">
               <?php echo $form->textField($model,'fio',array('style'=>'width:100%','maxlength'=>225)); ?>
               <?php echo $form->error($model,'fio'); ?>
           </td>
        </tr>
        <tr>
           <td valign="top"><?php echo $form->labelEx($model,'phone'); ?>:</td>
           <td valign="top"><?php echo $form->labelEx($model,'email'); ?>:</td>
        </tr>
        <tr>
           <td valign="top">
                <?php echo $form->textField($model,'phone',array('style'=>'width:100%','maxlength'=>14)); ?>
		<?php echo $form->error($model,'phone'); ?>
           </td>
           <td valign="top">
                <?php echo $form->textField($model,'email',array('style'=>'width:100%','maxlength'=>75)); ?>
		<?php echo $form->error($model,'email'); ?>
           </td>
        </tr>
        <tr>
           <td colspan="2" valign="top"><?php echo $form->labelEx($model,'company'); ?>:</td>
        </tr>
        <tr>
           <td colspan="2" valign="top">
                <?php echo $form->textField($model,'company',array('style'=>'width:100%','maxlength'=>225)); ?>
		<?php echo $form->error($model,'company'); ?>
           </td>
        </tr>
        <tr>
           <td colspan="2" valign="top">
                <?php echo $form->labelEx($model,'info'); ?>:
           </td>           
        </tr>
        <tr>
           <td colspan="2" valign="top">
		<?php echo $form->textArea($model,'info',array('style'=>'width:100%','maxlength'=>225)); ?>
		<?php echo $form->error($model,'info'); ?>               
           </td>
        </tr>                
    </tbody>
  </table>
  <p>
    <?php echo $form->checkBox($model,'savemydata',array('style'=>'heigth:20px;vertical-align:top;margin-left:5px;')); ?>      
    <?php echo $form->labelEx($model,'savemydata'); ?>     
  </p>
  <p>
      <?php echo CHtml::ajaxSubmitButton(Yii::t('form','Submit'),
                    Yii::app()->controller->createUrl("realestates/favsend"),
                    array('success'=>"js:function(data){
                                      $('#sendorder').dialog('close');
                                      $.pnotify({
                                            pnotify_width: 100,
                                            pnotify_nonblock: true,
                                            pnotify_title: 'Информация', 
                                            pnotify_text: 'Заявка на недвижемость №'+data+'<br/>успешно отправлена!',
                                            pnotify_animation: {
                                                effect_in: function(status, callback, pnotify) {
                                                    var source_note = 'Always call the callback when the animation completes.';
                                                    var cur_angle = 0;
                                                    var cur_opacity_scale = 0;
                                                    var timer = setInterval(function() {
                                                        cur_angle += 10;
                                                        if (cur_angle == 360) {
                                                            cur_angle = 0;
                                                            cur_opacity_scale = 1;
                                                            clearInterval(timer);
                                                        } else {
                                                            cur_opacity_scale = cur_angle / 360;
                                                        }
                                                        pnotify.css({
                                                            '-moz-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                                                            '-webkit-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                                                            '-o-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                                                            '-ms-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                                                            'filter': ('progid:DXImageTransform.Microsoft.BasicImage(rotation=' + (cur_angle / 360 * 4) + ')')
                                                        }).fadeTo(0, cur_opacity_scale);
                                                        if (cur_angle == 0) callback();
                                                    }, 20);
                                                },
                                                effect_out: function(status, callback, pnotify) {
                                                    var source_note = 'Always call the callback when the animation completes.';
                                                    var cur_angle = 0;
                                                    var cur_opacity_scale = 1;
                                                    var timer = setInterval(function() {
                                                        cur_angle += 10;
                                                        if (cur_angle == 360) {
                                                            cur_angle = 0;
                                                            cur_opacity_scale = 0;
                                                            clearInterval(timer);
                                                        } else {
                                                            cur_opacity_scale = cur_angle / 360;
                                                            cur_opacity_scale = 1 - cur_opacity_scale;
                                                        }
                                                        pnotify.css({
                                                            '-moz-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                                                            '-webkit-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                                                            '-o-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                                                            '-ms-transform': ('rotate(' + cur_angle + 'deg) scale(' + cur_opacity_scale + ')'),
                                                            'filter': ('progid:DXImageTransform.Microsoft.BasicImage(rotation=' + (cur_angle / 360 * 4) + ')')
                                                        }).fadeTo(0, cur_opacity_scale);
                                                        if (cur_angle == 0) {
                                                            pnotify.hide();
                                                            callback();
                                                        }
                                                    }, 20);
                                                }
                                            }
                                        });
                                        document.onselectstart=function(){return false}                                            
                                        document.onmousedown=function(){return false}
                                    }",'name'=>'save','style'=>'width:80px;')); ?>
      <?/*<input type="reset" value="Очистить" style="width:80px;">*/?>
  </p>
<?php $this->endWidget(); ?>
</div>


