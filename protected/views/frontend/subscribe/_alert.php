<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                'id' => 'alert',
                    'options' => array(
                        'title' => 'Внимание!',
                        'autoOpen' => false,
                        'buttons'=>array('Ok'=>'js:function() {
                                                $( this ).dialog( "close" );                                                  
                                            }'),
                        'modal' => true,
                        'resizable'=> false,
                    ),
                 'theme'=> 'ui-lightness',
                 'themeUrl'=>Yii::app()->request->baseUrl.'/css/backend/widgets/jui/themes/',
                 'htmlOptions'=>array('class'=>'popup')
                ));
?>
<div class="popup"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

