<?php

class MyButtonColumn extends CButtonColumn
{
    public function init() {
        $template = array();

        $controller = Yii::app()->controller;
        $controller_actions = $controller->actions();

        if (key_exists('view', $controller_actions) || method_exists($controller, 'actionView')) {
            $template[] = '{view}';
        }
        if (key_exists('update', $controller_actions) || method_exists($controller, 'actionUpdate')) {
            $template[] = '{update}';
        }
        if (key_exists('delete', $controller_actions) || method_exists($controller, 'actionDelete')) {
            $template[] = '{delete}';
        }

        $this->template = implode(' ', $template);

        parent::init();
    }
}
