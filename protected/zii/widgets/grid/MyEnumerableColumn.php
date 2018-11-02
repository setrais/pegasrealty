<?php

class MyEnumerableColumn extends CDataColumn {
    public $name;

    protected function renderDataCellContent($row, $data) {
        $attribute_enums = $data->getAttributeEnums($this->name);
        echo $attribute_enums[$data->{$this->name}];
    }
}
