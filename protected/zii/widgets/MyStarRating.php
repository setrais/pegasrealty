<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexk984
 * Date: 24.10.11
 * Time: 11:13
 */

class MyStarRating extends CStarRating
{
    public function registerClientScript($id)
    {
        $jsOptions = $this->getClientOptions();
        $jsOptions = empty($jsOptions) ? '' : CJavaScript::encode($jsOptions);
//        $js = "jQuery('#{$id} > input').rating({$jsOptions});";
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('rating');
//        $cs->registerScript('Yii.CStarRating#' . $id, $js);
        echo "<script type=\"text/javascript\">
            jQuery('#{$id} > input').rating({$jsOptions});
        </script>";
        if ($this->cssFile !== false)
            self::registerCssFile($this->cssFile);
    }
}