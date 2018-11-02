<?php

Yii::import('zii.widgets.jui.CJuiInputWidget');

class MyMultiSelect extends CJuiInputWidget {
    public $data;

    public function run() {
        $basePath = dirname(__FILE__) . '/assets/' . get_class($this);
        $baseUrl = Yii::app()->getAssetManager()->publish($basePath);

        list($name, $id) = $this->resolveNameID();

        if (isset($this->htmlOptions['id']))
            $id = $this->htmlOptions['id'];
        else
            $this->htmlOptions['id'] = $id;
        if (isset($this->htmlOptions['name']))
            $name = $this->htmlOptions['name'];
        else
            $this->htmlOptions['name'] = $name;
        $this->htmlOptions['multiple'] = 'multiple';

        if (!preg_match('/\[\]$/', $this->htmlOptions['name'])) {
            $this->htmlOptions['name'] = $this->htmlOptions['name'] . '[]';
        }

        if ($this->hasModel())
            echo CHtml::activeListBox($this->model, $this->attribute, $this->data, $this->htmlOptions);
        else
            echo CHtml::listBox($name, $this->value, $this->htmlOptions);

        $js = "$('#{$id}').multiselect().multiselectfilter();";

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl . '/jquery.multiselect.css');
        $cs->registerCssFile($baseUrl . '/jquery.multiselect.filter.css');
        $cs->registerScriptFile($baseUrl . '/jquery.multiselect.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/jquery.multiselect.filter.js', CClientScript::POS_END);

        $cs->registerScript(__CLASS__ . '#' . $this->id, $js);
    }
}
