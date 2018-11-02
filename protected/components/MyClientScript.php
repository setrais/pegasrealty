<?php

class MyClientScript extends EClientScript {
    
    public function registerCoreScript($name) {
        if (Yii::app()->request->isAjaxRequest && $name == 'jquery') {
            return $this;
        }
        return parent::registerCoreScript($name);
    }

    public function registerScriptFile($url, $position = self::POS_HEAD)
    {
        if (Yii::app()->request->isAjaxRequest && strstr($url, 'maps.google.com')) {
            return $this;
        }
        return parent::registerScriptFile($url, $position);
    }
    
    /**
     * Inserts the scripts in the head section.
     * @param string $output the output to be inserted with scripts.
     */
    public function renderHead(&$output)
    {
	$html='';
	foreach($this->metaTags as $meta)
		$html.=CHtml::metaTag($meta['content'],null,null,$meta)."\n";
	foreach($this->linkTags as $link)
		$html.=CHtml::linkTag(null,null,null,null,$link)."\n";
	foreach($this->cssFiles as $url=>$media)
		$html.=CHtml::cssFile($url,$media)."\n";
	foreach($this->css as $css)
		$html.=CHtml::css($css[0],$css[1])."\n";
	if($this->enableJavaScript)
	{
            if(isset($this->scriptFiles[self::POS_HEAD]))
            {
		foreach($this->scriptFiles[self::POS_HEAD] as $scriptFile)
                    $html.=CHtml::scriptFile($scriptFile)."\n";
            }

            if(isset($this->scripts[self::POS_HEAD]))
		$html.=CHtml::script(implode("\n",$this->scripts[self::POS_HEAD]))."\n";
            }

            if($html!=='')
            {
		$count=0;
		//$output=preg_replace('/(<title\b[^>]*>|<\\/head\s*>)/is','<###head###>$1',$output,1,$count);
                $output=preg_replace('/(<\\/title\s*>)|(<\\/head\s*>)/is','$1<###head###>$2',$output,1,$count);
		if($count)
                    //$output=str_replace('<###head###>',$html,$output);
                    $output=str_replace('<###head###>',"\n".$html,$output);                            
		else
                    $output=$html.$output;
            }
    }
    
    public function render(&$output)
    {
		parent::render($output);
		// conditional js/css for IE
		if ($this->hasScripts) 
                    $output = preg_replace('#(<(?:link|script) .+?) media="([\w\,\s]+):([lg]te? IE \d+)"(.*?>(?:</script>)?)#', '<!--[if \3]>\1 media="\2" \4<![endif]-->', $output);     
    }

}
