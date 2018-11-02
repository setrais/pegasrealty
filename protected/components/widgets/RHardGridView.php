<?php Yii::import('zii.widgets.grid.CGridView');

// http://progergirl.blogspot.com/2012/05/cgridview.html
// Вызов этого компонента осуществляется следующим образом:

/*$this->widget('RHardGridView', array(
    'id'=>'obj',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
                   'id',
                   'title',
                   'address',
                   'kray_id',
                   'city_id' => array(
                       'name'=>'city_id',
                       'value'=>'$data->city->title', //вот это важно
                       'filter'=>CHtml::listData(City::model()->findAll(), 'id', 'title'),                    
                   ),
               ),
    'headers'=>array(
                   'id',
                   'title',
                   'data' => array(
                       'label'=>Yii::t('main', 'Данные'), // если label отсутствует, то будет выведен ключ элемента (в данном случае 'data')
                       'childs'=>array(
                           'address',
                           'geo' => array(
                               'label'=>Yii::t('main', 'Местоположение'),
                               'childs'=> array(
                                   'city_id',
                                   'kray_id',
                               ),
                           ),
                       ),
                   ),
               ),
   )); 
*/

class RHardGridView extends CGridView 
{
    
   public $groupActions = array();
   public $joinColumns = array();
   
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
   
   // Переопределяем класс CGridView и его методы: initColumns() и renderTableHeader().
   
   /** ProgerGirl
    * Инициализация колонок
    */
   protected function initColumns() {
        if ($this->columns === array()) {
            if ($this->dataProvider instanceof CActiveDataProvider) {
                $this->columns = $this->dataProvider->model->attributeNames();
            } else if ($this->dataProvider instanceof IDataProvider) {
                // use the keys of the first row of data as the default columns
                $data = $this->dataProvider->getData();
                if (isset($data[0]) && is_array($data[0]))
                    $this->columns = array_keys($data[0]);
            }
        }

        /* Получаем массив ключей колонок */
        $columns = array();
        foreach ($this->columns as $k => $v) {
            $columns[is_array($v) ? $v['name'] : $v] = $v;
        }

        /* Формируем шапку таблицы */
        $this->renderHeaderRow($this->headers, $columns);

        /* Исключаем колонки, не присутствующие в шапке */
        $this->columns = array();
        foreach ($this->headerColumns as $v) {
            if (is_array($columns[$v])) {
                $this->columns[] = $columns[$v];
            } else {
                $this->columns[] = $columns[$v];
            }
        }

        $this->headerColumns = array();
        $id = $this->getId();
        foreach ($this->columns as $i => $column) {
            if (is_string($column))
                $column = $this->createDataColumn($column);
            else {
                if (!isset($column['class']))
                    $column['class'] = 'CDataColumn';
                $column = Yii::createComponent($column, $this);
            }
            if (!$column->visible) {
                unset($this->columns[$i]);
                continue;
            }
            if ($column->id === null)
                $column->id = $id . '_c' . $i;
            $this->columns[$i] = $column;
            $this->headerColumns[$column->name] = $i;
        }

        foreach ($this->columns as $column) {
            $column->init();
        }
   }
   
   private function renderHeaderRow($row, $columns, $level = 0) {
        $colspan = 0;
        foreach ($row as $k => $item) {
            if (is_array($item)) {
                if (isset($item['childs'])) {
                    if (count($this->headerRows)) {

                    }
                    $count = $this->renderHeaderRow($item['childs'], $columns, $level + 1);
                    if ($count) {
                        $this->headerRows[$level][] = array(
                            'colspan' => $count,
                            'header' => isset($item['label']) ? $item['label'] : $k
                        );
                        $colspan += $count - 1;
                    } else {
                        unset($row[$k]);
                    }
                }
            } else {
                if (array_key_exists($item, $columns)) {
                    $this->headerRows[$level][] = array(
                        'name' => $item
                    );
                    $this->headerColumns[] = $item;
                } else {
                    unset($row[$k]);
                }
            }
        }
        return count($row) + $colspan;
   }
    
   /**
    * Renders a table body row.
    * @param integer $row the row number (zero-based).
    /
   public function renderTableRow($row)
   {
	if($this->rowCssClassExpression!==null)
	{
        	$data=$this->dataProvider->data[$row];
		echo '<tr class="'.$this->evaluateExpression($this->rowCssClassExpression,array('row'=>$row,'data'=>$data)).'">';
	}
	else if(is_array($this->rowCssClass) && ($n=count($this->rowCssClass))>0)
		echo '<tr class="'.$this->rowCssClass[$row%$n].'">';
	else
		echo '<tr>';
        
        foreach($this->columns as $v => $column)
            if (count($this->joinColumns)&&in_array(is_array($v) ? $v['name'] : $v,$this->joinColumns[0]) 
                echo '<td><tr>';
                $column->renderDataCell($row);

	echo "</tr>\n";
   }*/
        
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
   
   /**
    * Renders the table header.
    */
    public function renderTableHeader()
    {
	if(!$this->hideHeader)
	{
		echo "<thead>\n";
                
		if($this->filterPosition===self::FILTER_POS_HEADER)
			$this->renderFilter();

		echo "<tr>\n";
                
		/*foreach($this->columns as $column)
			$column->renderHeaderCell();*/
                for ($r = 0; $r < count($this->headerRows); $r++) {
                     $row = $this->headerRows[$r];
                     echo '';
                     foreach ($row as $k => $v) {
                         $htmlOptions = array();
                         $colspan = (isset($v['colspan'])) ? $v['colspan'] : false;
                         if ($colspan > 1) {
                             $htmlOptions['colspan'] = $colspan;
                         }
                         $rowspan = ($r < count($this->headerRows) && !$colspan) ? count($this->headerRows) - $r : false;
                         if ($rowspan) {
                             $htmlOptions['rowspan'] = $rowspan;
                         }

                         if (isset($v['name'])) {
                             $column = $this->columns [$this->headerColumns[$v['name']]];
                             $column->headerHtmlOptions = $htmlOptions;
                             $column->renderHeaderCell();
                         } else {
                             echo $this->renderHeaderCellSimple(isset($v['header']) ? $v['header'] : " ", $htmlOptions);
                         }
                     }
                     echo '';
                }                
                
		echo "</tr>\n";

		if($this->filterPosition===self::FILTER_POS_BODY)
			$this->renderFilter();

			echo "</thead>\n";
	}
	else if($this->filter!==null && ($this->filterPosition===self::FILTER_POS_HEADER || $this->filterPosition===self::FILTER_POS_BODY))
	{
			echo "<thead>\n";
			$this->renderFilter();
			echo "</thead>\n";
	}
    }
}
