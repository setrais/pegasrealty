<?php Yii::import('zii.widgets.grid.CGridView');

class RGridView extends CGridView 
{
    
   public $groupActions = array();
   
   public function init()
   {
           array_unshift($this->columns, array(
              'class'=>'CCheckBoxColumn',
              'selectableRows'=>2,
              'checkBoxHtmlOptions'=>array(
              'name'=>'group-checkbox-column[]',
              ),
              'htmlOptions'=>array(
                 'class'=>'group-checkbox-column',
              ),
           ));
          return parent::init();
   }
   
   public function renderPager()
   {
       echo "<div class='pre-header' style='float:left;'>";
       if(count($this->groupActions)) {
           echo CHtml::dropDownList('group-actions', null, array(null=>null)+$this->groupActions, array('style'=>' font-family: Arial; font-size: 1em; line-height: 100%; margin: 0;padding: 0;'));
       }
   
       $ind = '_'.str_replace(' ','',ucwords(str_replace('-',' ',$this->id)));
       
       echo CHtml::button(Yii::t('form','Выполнить'/*'Submit'*/), array(
           'id'=>'group-operation-submit'.$this->id,
           'style'=>' font-family: Arial; font-size: 1em; line-height: 100%; margin: 0;padding: 0;',
           'onclick'=>'groupOperation'.$ind.'()',
       ));
       echo "</div>";
           
       $actionLinks = array();
       foreach($this->groupActions as $k=>$v) {
           $actionLinks[$k] = Yii::app()->controller->createUrl($k);
       }
       $actionLinks = json_encode($actionLinks);
           
       Yii::app()->clientScript->registerScript('go'.$ind, "
             var actionLinks".$ind." = $actionLinks;
             function groupOperation".$ind."(){
                var select = $('#".$this->id." #group-actions');
                var action = select.val();
                var submit = $('#".$this->id." #group-operation-submit');
                submit.attr('disabled', 'disabled');
                $.ajax({
                   url: actionLinks".$ind."[action],
                   type: 'POST',
                   data: $('#".$this->id." .group-checkbox-column input').serializeArray(),
                   dataType: 'json',
                   complete: function(){
                      submit.removeAttr('disabled');
                   },
                   success: function(data){
                       //alert(data.mess);
                       if ( !data.error ) {                                               
                            $.fn.yiiGridView.update('".$this->id."', {
                                    data: $(this).serialize()
                            });

                            //$('#".$this->id."').yiiGridView('update');
                                                            
                            /*var effect_in = 'scale';
                            var easing_in = 'easeOutElastic';
                            var effect_out = 'same';
                            var easing_out = 'same';
                            if (effect_out == 'same') effect_out = effect_in;
                            if (easing_out == 'same') easing_out = easing_in;
                            var speed = '700';
                            if (speed.match(/^\d+$/)) speed = parseInt(speed);
                            var options_in = {
                                easing: easing_in
                            };
                            var options_out = {
                                easing: easing_out
                            };
                            if (effect_in == 'scale') options_in.percent = 100;
                            if (effect_out == 'scale') options_out.percent = 0;
                            $.pnotify({
                                pnotify_title: 'Информация',
                                pnotify_text: data.mess,
                                pnotify_animate_speed: speed,
                                pnotify_animation: {
                                    'effect_in': 'scale',
                                    'options_in': options_in,
                                    'effect_out': effect_out,
                                    'options_out': options_out
                                }
                            });*/                            
                            $.pnotify({
                                pnotify_width: 100,
                                pnotify_nonblock: true,
                                pnotify_title: 'Информация', 
                                pnotify_text: data.mess,
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
                          
                          return false;      
                       }else{                           
                          alert(data.mess);
                       }
                   },
                   error: function(XMLHttpRequest, textStatus, errorThrown) {
                                             alert(XMLHttpRequest.responseText);
                   }
               });
          }
          ", CClientScript::POS_HEAD);
           parent::renderPager();
   }
}
