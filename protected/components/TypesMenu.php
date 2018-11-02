<?php

/**
 * Создадим виджет, содержащий ссылки на страницы жанров игр.
 */
class TypesMenu extends CWidget
{
    public function run() {
        $types = TypesIblocks::model()->findAll();
        $this->render('typesmenu',array('types'=>$types));
    }
}