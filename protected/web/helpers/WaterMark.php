<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexk984
 * Date: 26.10.11
 * Time: 22:51
 */

class WaterMark
{
    public static function MySetWatermark($filename, $ext)
    {
        $im = null;
        if ($ext == 'jpeg' || $ext = 'jpg')
            $im = imagecreatefromjpeg($filename);
        if ($ext == 'png')
            $im = imagecreatefrompng($filename);
        if ($ext == 'gif')
            $im = imagecreatefromgif($filename);
        self::SetWatermark($im, $ext, Yii::app()->basePath . '\..\images\watermark.png', $filename);
    }

    //create watermark
    //$sType output format jpeg,jpg,gif,png
    //$sfWatermark path to 24b – png
    private static function SetWatermark($rImg, $sType, $sfWatermark, $filename)
    {
        $iDelta = 5;
        $xImg = imagesx($rImg);
        $yImg = imagesy($rImg);

        $r = imagecreatefrompng($sfWatermark);
        $x = imagesx($r);
        $y = imagesy($r);

        $xDest = $xImg - ($x + $iDelta);
        $yDest = $yImg - ($y + $iDelta);
        imageAlphaBlending($rImg, TRUE);
        imagecopy($rImg, $r, $xDest, $yDest, 0, 0, $x, $y);
        if ('png' == $sType) imagepng($rImg, $filename);
        if ('jpeg' == $sType || 'jpg' == $sType) imagejpeg($rImg, $filename);
        if ('gif' == $sType) imagegif($rImg, $filename);
        imagedestroy($r);
        imagedestroy($rImg);
    }
}
