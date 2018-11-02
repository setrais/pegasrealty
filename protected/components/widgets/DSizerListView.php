<?php 
Yii::import('zii.widgets.CListView');
class DSizerListView extends CListView
{
    /**
     * @var string GET attribute
     */
    public $sizerAttribute = 'size';
 
    /**
     * @var array items per page sizes variants
     */
    public $sizerVariants = array(10, 20, 30);
 
    /**
     * @var string CSS class of sorter element
     */
    public $sizerCssClass = 'sizer';
 
    /**
     * @var string the text shown before sizer links. Defaults to empty.
     */
    public $sizerHeader = 'Show by: ';
 
    /**
     * @var string the text shown after sizer links. Defaults to empty.
     */
    public $sizerFooter = '';

    /**
     * @var boolen the text short. Defaults to false.
     */
    public $short = false;
    
    public $desc = false;
    
    public function renderSizer()
    {
        if ($this->dataProvider->getTotalItemCount()) {
        $pageVar = $this->dataProvider->getPagination()->pageVar;    
        $pageSize = $this->dataProvider->getPagination()->pageSize;    
 
        $links = array();    
        if ($this->sizerVariants) {
        foreach ($this->sizerVariants as $count)
        {
            $params = array_replace($_GET, array($this->sizerAttribute => $count));
 
            if (isset($params[$pageVar])) 
                unset($params[$pageVar]);
 
            if ($count == $pageSize)
                $links[] = $count;
            else            
                $links[] = CHtml::link($count, Yii::app()->controller->createUrl('', $params));
        }        
        echo CHtml::tag('div', array('class'=>$this->sizerCssClass), $this->sizerHeader . implode(', ', $links));
        echo $this->sizerFooter;
        }
        }
    }
}
