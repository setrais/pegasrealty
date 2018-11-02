<?php
class WebTicker extends CWidget {
    private $jsFile='';
    public $cssFile='';    
    public  $contOptions = array(
               'class'=>'inline-valn',
               'width'=>'950px',
               'height'=>'300px'
    );
    
    public $data = array ();
    public $id = 'webTicker';
       
    public $options = array (
        'duplicate'=>true, 
        'speed'=>40, 
        'direction'=>'right', 
        'rssurl'=>'http://yourwebsite.com/rss/', 
        'rssfrequency'=>1, 
        'startEmpty'=>false, 
        'hoverpause'=>false
    );
    

    public function init() {                
        
        $baseUrl = CHtml::asset(dirname (__FILE__).'/assets');

        # load css
        if($this->cssFile === null) {
            Yii::app()->getClientScript()->registerCssFile($baseUrl.'/css/webticker.css');
        } else {
            Yii::app()->getClientScript()->registerCssFile($baseUrl.'/css/'.$this->cssFile.'.css');
        }

        # load js
        if($this->jsFile === null) {
            if (YII_DEBUG) Yii::app()->getClientScript()->registerScriptFile($baseUrl.'/js/jquery.webticker.js');
            else Yii::app()->getClientScript()->registerScriptFile($baseUrl.'/js/jquery.webticker.min.js');
                
        }

        parent::init();
    }
    
    public function run () {
        $list = '';
        if (is_array($this->data)&&!empty($this->data)) {
            foreach ($this->data as $key => $value) {
                $list.=CHtml::tag('li',array(),$value);
            }
        }else{
            $list= $this->data; 
        }
        echo CHtml::tag('div', $this->contOptions, CHtml::tag('ul', array('id'=>$this->id),$list));        
        
        $config = array ();
        foreach ($this->options as $key => $value) {
            if (is_bool($value) === true) 
                $config[] .= $key.':'.($value ? 'true' : 'false');
            else if (is_string($value)) 
                $config[] .= $key.":'".$value."'";                
            else 
                $config[] .= $key.':'.$value;    
        }
        //$js = '$(document).ready(function(){';
        $js = '$("#'.$this->id.'").webTicker({'.implode (',', $config).'})';                        
        //$js = '});';
        Yii::app()->clientScript->registerScript('WebTicker'.$this->getId(),$js,CClientScript::POS_READY);   
    }
}
?>
