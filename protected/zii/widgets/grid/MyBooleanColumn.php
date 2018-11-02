<?php

class MyBooleanColumn extends CDataColumn
{
    public $name;
    public $value;

    protected function renderDataCellContent($row, $data)
    {
        if (!isset($this->value)) {
            $value = $data->{$this->name};
        } else {
            $value = $this->evaluateExpression($this->value, array('data' => $data));
        }
        $img = empty($value) ? 'cross.png' : 'tick.png';
        echo CHtml::image(Yii::app()->request->baseUrl . '/images/icons/fugue/' . $img);
    }
}
