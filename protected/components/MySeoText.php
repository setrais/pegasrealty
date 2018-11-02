<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexk984
 * Date: 18.11.11
 * Time: 15:04
 */

class MySeoText
{
    /**
     * @static
     * @param string $type
     * @return string
     */
    public static function GetSeoText($type){
        if ($type == 'restaurants' || empty($type) || $type==null) {
            return Yii::app()->config->get('seo_text');
        } else if ($type == 'supermarket') {
            return Yii::app()->config->get('seo_text2');
        } else if ($type == 'ekomarket') {
            return Yii::app()->config->get('seo_text3');
        } else if ($type == 'premium') {
            return Yii::app()->config->get('seo_text4');
        }         
        
    }
}
