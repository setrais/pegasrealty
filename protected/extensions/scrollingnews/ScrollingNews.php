<?php
/**
 * @author Rafael Garcia <rafa.inforamtica@gmail.com>
 * @abstract Siple Scrolling News wrapper for JQuery Carousel
 * @version 1.0
 */
class ScrollingNews extends CWidget
{
    public
            $htmlOptionsContainer = array(),
            $scriptOptions = array(),
            $baseUrl = '';

    public  function init(){
        $htmlOptionsContainerDefault['id'] = uniqid('YiiSN');
        $this->htmlOptionsContainer = CMap::mergeArray($htmlOptionsContainerDefault, (array)$this->htmlOptionsContainer);
        $scriptOptionsDefault = array(
            'vertical'=>true,
            'hoverPause'=>true,
            'visible'=>3,
            'auto'=>500,
            'speed'=>1000,
        );
        $this->scriptOptions = CJavaScript::encode(CMap::mergeArray($scriptOptionsDefault, (array)$this->scriptOptions));
      	$this->baseUrl = Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'script').DIRECTORY_SEPARATOR;
        $ClientScript = Yii::app()->getClientScript();
        $ClientScript->registerCoreScript('jquery');
        $ClientScript->registerScriptFile("{$this->baseUrl}jcarousellite_1.0.1c4.js");
        $ClientScript->registerScript($this->htmlOptionsContainer['id'],"
        $('#{$this->htmlOptionsContainer['id']}').jCarouselLite({$this->scriptOptions});",CClientScript::POS_READY);
        echo CHtml::tag('div', $this->htmlOptionsContainer);
    }

    public function run(){
        echo '</div>';
    }
}
?>
