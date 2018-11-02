<?php

class PageTitle extends CFilter
{
    protected function preFilter($filterChain)
    {
        return true;
    }

    protected function postFilter($filterChain)
    {
        $controller = $filterChain->controller;

        if (!Yii::app()->request->isAjaxRequest && empty($controller->pageTitle)) {
            throw new CException('Название страницы пустое');
        }
    }
}
