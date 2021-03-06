<?php

class EJustInTimeR extends CWidget {

    private $original;
    private $src;
    private $thumbPath;
    private $bigPath;
    private $newName = '';
    public $image = null;
    public $display = 'thumb';
    public $title = null;
    public $alt = null;
    public $bigWidth = 640;
    public $bigHeight = 480;
    public $thumbWidth = 400;
    public $thumbHeight = 300;

    public function init() {
        $this->checkFolders();
        $this->createUniqueName();
        $this->initPathVars();
        $this->createImagesIfNotExists();
        $this->defineSrc();
    }

    public function run() {
        echo '<img src="' . $this->src . '" title="' . $this->getTitle() . '" alt="' . $this->getAlt() . '" />';
    }

    private function defineSrc() {
        $this->src = ($this->display == 'thumb' ? 'images/jitr/thumb/' : 'images/jitr/big/') . $this->newName;
    }

    private function createImagesIfNotExists() {
        if (!file_exists($this->bigPath) || !file_exists($this->thumbPath)) {
            Yii::import('application.extensions.image.Image');
            $image = new Image($this->original);
            if (!file_exists($this->bigPath)) {
                $image->resize($this->bigWidth, $this->bigHeight);
                $image->save($this->bigPath);
            }
            if (!file_exists($this->thumbPath)) {
                $image->resize($this->thumbWidth, $this->thumbHeight);
                $image->save($this->thumbPath);
            }
        }
    }

    private function initPathVars() {
        $this->original = __DIR__ . '/../../../images/jitr/originals/' . ($this->image);
        $this->bigPath = __DIR__ . '/../../../images/jitr/big/' . $this->newName;
        $this->thumbPath = __DIR__ . '/../../../images/jitr/thumb/' . $this->newName;
    }

    private function createUniqueName() {
        $ext = explode(".", $this->image);
        $ext = $ext[count($ext) - 1];
        $this->newName = md5($this->image) . "." . $ext;
    }

    private function checkFolders() {
        foreach (array(
            __DIR__ . '/../../../images/jitr',
            __DIR__ . '/../../../images/jitr/originals',
            __DIR__ . '/../../../images/jitr/big',
            __DIR__ . '/../../../images/jitr/thumb',
        ) as $path)
        if (!file_exists($path))
                throw new Exception($path . ' do not exists!');
        if (!$this->image)
            throw new Exception('Image cannot be null!');
    }

    private function getTitle() {
        return $this->title ? $this->title : $this->image;
    }

    private function getAlt() {
        return $this->alt ? $this->alt : $this->image;
    }

}