<?php

class HImage {
    const WIDTH = 1;
    const HEIGHT = 2;

    public static function resizeByWidth($path, $w, $imageAlt='', $imageHtmlOptions=array(), $returnPath=false) {
        return self::resized(self::WIDTH, $path, $w, $imageAlt, $imageHtmlOptions, $returnPath);
    }

    public static function resizeByHeight($path, $h, $imageAlt='', $imageHtmlOptions=array(), $returnPath=false) {
        return self::resized(self::HEIGHT, $path, $h, $imageAlt, $imageHtmlOptions, $returnPath);
    }

    public static function getHeightResizedByWidth($path, $w) {
        $image = new MySimpleImage;
        $image->load(Yii::app()->basePath . '/../' . $path);
        $image->resizeToWidth($w);

        return $image->getHeight();
    }

    protected static function resized($resizeBy=self::WIDTH, $path, $dimension, $imageAlt='', $imageHtmlOptions=array(), $returnPath=false) {
        $name = substr($path, 0, strrpos($path, '.'));
        $ext = substr($path, strrpos($path, '.')+1);
        $newFilename = md5($name) . '_' . $dimension . '.' . $ext;
        $saveTo = Yii::app()->basePath . '/../cache/' . $newFilename;

        if (!file_exists($saveTo)) {
            $image = new MySimpleImage;
            $image->load(Yii::app()->basePath . '/../' . $path);

            switch($resizeBy) {
                case self::WIDTH:
                    $image->resizeToWidth($dimension);
                break;

                case self::HEIGHT:
                    $image->resizeToHeight($dimension);
                break;
            }

            $image->save($saveTo);
        }

        $src = Yii::app()->request->baseUrl . '/cache/' . $newFilename;
        if ($returnPath == true) {
            return $src;
        }
        return CHtml::image($src, $imageAlt, $imageHtmlOptions);
    }
}
