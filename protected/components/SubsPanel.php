<?php

class SubsPanel extends CWidget {
    public $typesubs_id=8;
    
    public function run() {
        $model = new Subscribe; 
        $this->render('SubsPanel',array('model' => $model,'typesubs_id'=>$this->typesubs_id));
    }
}