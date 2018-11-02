<?php

Yii::import('zii.widgets.grid.CGridView');
Yii::import('application.zii.widgets.grid.MyBooleanColumn');
Yii::import('application.zii.widgets.grid.MyButtonColumn');
Yii::import('application.zii.widgets.grid.MyCheckBoxColumn');
Yii::import('application.zii.widgets.grid.MyEnumerableColumn');

class MyGridView extends CGridView {

    public $showTableOnEmpty = false;
    public $ajaxUpdate = false;
    public $selectableRows = 1000;
    public $enableSorting = true;
    public $enablePagination = true;
    public $pager = array('class' => 'CLinkPager');
    public $summaryText = '{start}&mdash;{end} из {count}';
    public $template = '{items}{actions}{bottom}'; //changed

    public $groupBy;
    public $groupByValue;

    public $sortable = false;
	
	public $rowBackgroundExpression;

    protected $lastGroupBy;

    public function init() {
        $basePath = dirname(__FILE__) . '/assets/' . get_class($this);
        $this->baseScriptUrl = Yii::app()->getAssetManager()->publish($basePath);

        parent::init();
    }

    public function registerClientScript() {
        if ($this->sortable == true) {
            Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
            Yii::app()->getClientScript()->registerScript('grid-sortable', "
                $('#{$this->id}').sortable({
                    items: 'tr',
                    update: function() {
                        $.ajax({
                            url: '" . Yii::app()->controller->createUrl('sort') . "',
                            type: 'POST',
                            data: $(this).sortable('serialize')
                        });
                    }
                });
            ");
        }

        return parent::registerClientScript();
    }

    public function initColumns() {
        if ($this->sortable == true) {
            array_unshift($this->columns, array(
                'value' => 'CHtml::image(Yii::app()->request->baseUrl . "/images/icons/fugue/arrow-resize-090.png")',
                'type' => 'raw',
                'headerHtmlOptions' => array('width' => 1),
            ));
        }

        foreach($this->columns as $i=>$column) {
            if (is_string($column)) {
                $options = array();
                switch($column) {
                    case 'id':
                        $options = array('headerHtmlOptions' => array('width' => 20));
                    break;

                    case 'created_at':
                    case 'updated_at':
                        $options = array('headerHtmlOptions' => array('width' => 150));
                    break;
                }
                $column = CMap::mergeArray(array('name' => $column), $options);
                $this->columns[$i] = $column;
            }
        }
        parent::initColumns();
    }

    public function renderTableRow($row) {
        $data = $this->dataProvider->data[$row];

        if (isset($this->groupBy)) {
            $groupBy = $this->groupBy;
            if (!isset($this->lastGroupBy) || $this->lastGroupBy != $data->$groupBy) {
                echo '<tr class="even">';
                echo '<td colspan="'.count($this->columns).'"><div class="group">';
                $groupByText = $this->evaluateExpression($this->groupByValue, array('data' => $data));
                echo CHtml::link($groupByText, array('products/admin', 'Products[group_id]' => $data->group_id));
                echo '</div></td>';
                echo '</tr>';
                $this->lastGroupBy = $data->$groupBy;
            }
        }

        if($this->rowCssClassExpression!==null){
                $data=$this->dataProvider->data[$row];
				if($this->rowBackgroundExpression!==null){
					echo '<tr class="'.$this->evaluateExpression($this->rowCssClassExpression,array('row'=>$row,'data'=>$data)).'" style="background:'.$this->evaluateExpression($this->rowBackgroundExpression,array('row'=>$row,'data'=>$data)).'">';
				} else {
					echo '<tr class="'.$this->evaluateExpression($this->rowCssClassExpression,array('row'=>$row,'data'=>$data)).'">';
				}  
        }
        elseif (is_array($this->rowCssClass) && ($n = count($this->rowCssClass)) > 0) {
			if($this->rowBackgroundExpression!==null){
				echo '<tr class="' . $this->rowCssClass[$row % $n] . '" id="grid_item_' . $data->getPrimaryKey() . '" style="background:'.$this->evaluateExpression($this->rowBackgroundExpression,array('row'=>$row,'data'=>$data)).'">';
			} else {
				echo '<tr class="' . $this->rowCssClass[$row % $n] . '" id="grid_item_' . $data->getPrimaryKey() . '">';
			}      
        } else {
			if($this->rowBackgroundExpression!==null){
				echo '<tr style="background:'.$this->evaluateExpression($this->rowBackgroundExpression,array('row'=>$row,'data'=>$data)).'">';
			} else {
				echo '<tr>';
			}
        }

        foreach ($this->columns as $column) {
            $column->renderDataCell($row);
        }

        echo '</tr>';
    }

    public function renderActions() {
        if ($this->dataProvider->getItemCount() > 0) {
            $checkBoxColumn = null;
            foreach($this->columns as $column) {
                if ($column instanceof MyCheckBoxColumn) {
                    $checkBoxColumn = $column;
                    break;
                }
            }

            if ($checkBoxColumn && !empty($checkBoxColumn->actions)) {
                echo CHtml::form('', 'post', array('id' => 'form-actions'));
                echo '<div id="keys-actions" class="hidden2"></div>';
                echo '<table class="grid-actions" width="100%">';
                echo '<tr>';
                echo '<td>';
                echo 'С выделенными: ';
                echo CHtml::dropDownList('action', null, $checkBoxColumn->actions, array('prompt' => '---'));
                echo '</td>';
                echo '</tr>';
                echo '</table>';
                echo CHtml::endForm();

                Yii::app()->getClientScript()->registerScript('change-action', "
                    $('#action').bind('change', function() {
                        if ($(this).val() != '') {
                            var keysActions = $('#keys-actions');
                            var formActions = $('#form-actions');
                            var selectedKeys = $.fn.yiiGridView.getChecked('" . $this->id . "', '" . $checkBoxColumn->id . "');

                            if(selectedKeys.length > 0) {
                                keysActions.html('');
                                $.each(selectedKeys, function(k, v) {
                                    keysActions.append('<input type=\"hidden\" name=\"keys[]\" value=\"' + v + '\" />');
                                });
                                formActions.get(0).setAttribute('action', APP.baseRequestUrl + $(this).val());
                                formActions.submit();
                            } else {
                                $('#action option:first').attr('selected','selected');
                            }
                        }
                    });
                ");
            }
        }
    }

    private function _getPageSize(){
        $arr = array();
        foreach(Yii::app()->params['pageSizeGrid']['options'] as $value){
            if($value == 0){
                $arr[$value] = 'Все позиции';
            }else{
                $arr[$value] = $value;
            }
        }

        return $arr;
    }

    public function renderLimit()
    {
        $pageSize = Yii::app()->user->getState('pageSizeGridView', Yii::app()->params['pageSizeGrid']['default']);
        echo "<div style='padding: 10px;'> Количество строк в таблице: ";
        echo CHtml::dropDownList('pageSizeGridView', $pageSize, $this->_getPageSize(),
                            array(
                                 'onchange' => "$.fn.yiiGridView.update('{$this->id}',{ data:{pageSizeGridView: $(this).val() }})",
                            ));
        echo "</div>";
    }

    public function renderBottom() {
        echo '<table class="grid-bottom" width="100%"><tr><td>';
        $this->renderPager();
        echo '</td><td>';
        $this->renderSummary();
        echo '</td></tr></table>';
    }
}
