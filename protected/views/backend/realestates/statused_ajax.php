<div class="wide form l70" >

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'client-realestates-form',
        'htmlOptions'=>array('class'=>'client-realestates'), 
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                    'validateOnSubmit'=>true,
        ),

      )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'status_id'); ?>
        <?php echo $form->dropDownList($model,'status_id',                           
                               CHtml::listData( RealestateStatus::model()->findAll("(ACT IS NULL OR ACT=1) AND (DEL IS NULL OR DEL=0)",
                                 array("order"=>"sort")), 'id', 'title'), array('prompt'=>Yii::t('all','Select')."...")); ?>                                                                     
        <?php echo $form->error($model,'status_id'); ?>
    </div>

    <div class="row buttons">
            <?php echo CHtml::ajaxSubmitButton( Yii::t('form','Save'),
                    Yii::app()->controller->createUrl("/realestates/ajaxstatusedinclient",array("id"=> $model->realestate_id, "cid"=> $model->client_id)),
                    array('success'=>"js:function(data){
                                      $('#list-realestates').dialog('close');
                                      /*$(function(){
                                            $.fn.yiiGridView.update('realestates-client-grid', {
                                                  data: $(this).serialize()
                                            });
                                      });*/      
                                      /*var val = $.parseJSON(data);
                                      if (val.mess) { 
                                      $.pnotify({
                                            pnotify_width: 100,
                                            pnotify_nonblock: true,
                                            pnotify_title: 'Информация', 
                                            pnotify_text: val.mess+( val.error ?  '<br/>Ошибка сохранения!' : '<br/>успешно сохранено!'),
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
                                        })
                                        };*/
                                        //document.onselectstart=function(){return false}                                            
                                        //document.onmousedown=function(){return false}
                                    }",'name'=>'save','style'=>'width:100px;')); ?>
            
		<?php// echo CHtml::submitButton($model->isNewRecord ? Yii::t('form','Create') : Yii::t('form','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->