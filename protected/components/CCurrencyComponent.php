<?php
class CCurrencyComponent extends CApplicationComponent {
    
    //В какую валюту конвертируем
    public $to;
    //Из какой валюты конвертируем
    public $from;
    //Имя CFileCache компонента
    public $nameCacheComp;
    // Время кеша
    public $timeCacheComp=0;//43200;//0;//43200;
    //Результат конвертации валюты в формате 'currencyName' => 'currencyValue'
    private $_converted;
    
    public function init() {        
        //$cache = Yii::app()->{$this->nameCacheComp}->get('currency');        
        //if( !$cache ) {                      
            foreach($this->from as $currency) {                
                $url = sprintf('http://www.google.com/ig/calculator?q=%d%s=?%s',$currency['amount'],$currency['name'],$this->to);
                $info = @file_get_contents($url);
                if( $info === FALSE) {                    
                    //throw new Exception('Currency - Error: Couldn\'t open igoogle currency service file.');                    
                    $this->_converted[$currency['name']]=$currency['curs'];
                }else{
                    //echo $info;
                    preg_match("/(\d+\.\d+)/",$info,$matches);
                    if (is_array($matches[0])) {
                        $this->_converted[$currency['name']] = $matches[0];                                        
                    }else{    
                        $this->_converted[$currency['name']]=$currency['curs'];                                                               
                    }    
                }
            }                               
            Yii::app()->{$this->nameCacheComp}->set('currency',serialize($this->_converted),$this->timeCacheComp); // 12 часов
        //} else {
        //    $this->_converted = unserialize($cache);
        //}        
    }

    public function __get($name) {
        if(isset($this->_converted[$name])) {
            return $this->_converted[$name];
        } else {
            return parent::__get($name);
        }
    }
}
?>