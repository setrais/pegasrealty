<?php

Yii::import('zii.widgets.CListView');

class MyListView extends CListView {
    public $ajaxUpdate = false;
    public $template = "{sorter}\n{items}\n{summary}\n{pager}";

    public function init() {
        $basePath = dirname(__FILE__) . '/assets/' . get_class($this);
        $this->baseScriptUrl = Yii::app()->getAssetManager()->publish($basePath);
        parent::init();
    }
}
