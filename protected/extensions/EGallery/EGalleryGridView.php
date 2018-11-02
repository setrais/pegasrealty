<?php

Yii::import('zii.widgets.grid.CGridView');

class EGalleryGridView extends CGridView {

    public $hideHeader = true;
    public $selectableRows = 0;
    public $template = '{items}';

    public function init() {
        $basePath = dirname(__FILE__) . '/assets/gridview';
        $this->baseScriptUrl = Yii::app()->getAssetManager()->publish($basePath);
        parent::init();
    }
}
