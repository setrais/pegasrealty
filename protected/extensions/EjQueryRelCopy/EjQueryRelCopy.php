<?php

class EjQueryRelCopy extends CWidget
{
    /**
     * The text for the remove link
     * Can be an image tag too.
     * Leave empty to disable removing.
     *
     * @var string $removeText
     */
    public $removeText;

    /**
     * The htmlOptions for the remove link
     *
     * @var array $removeHtmlOptions
     */
    public $removeHtmlOptions = array();

    /**
     * Available options
     *
     * string excludeSelector - A jQuery selector used to exclude an element and its children
     * integer limit - The number of allowed copies. Default: 0 is unlimited
     * string append - Additional HTML to attach at the end of each copy.
     * string copyClass - A class to attach to each copy
     * boolean clearInputs - Option to clear each copies text input fields or textarea
     *
     * @var array $options
     */
    public $options = array();

    /**
     * The assets url
     *
     * @var string $_assets
     */
    private $_assets;

    public function init()
    {
        $this->_assets = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets');

        Yii::app()->clientScript->registerCoreScript('jquery')
                ->registerScriptFile($this->_assets . '/jquery.relcopy.min.js');

        if (!empty($this->removeText)) {
            $onClick = '$(this).parent().remove(); return false;';
            $htmlOptions = array_merge($this->removeHtmlOptions, array('onclick' => $onClick));
            $append = CHtml::link($this->removeText, '#', $htmlOptions);

            $this->options['append'] = empty($this->options['append']) ? $append : $append . ' ' . $this->options['append'];
        }

        $options = CJavaScript::encode($this->options);
        Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $this->id, "jQuery('#{$this->id}').relCopy($options);");
        parent::init();
    }
}
