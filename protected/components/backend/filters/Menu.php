<?php

class Menu extends CFilter
{
    protected function preFilter($filterChain)
    {
        $controller = $filterChain->controller;
        $params = $controller->getActionParams();
        $action_id = $controller->getAction()->getId();

        switch($action_id) {
            case 'admin':
                $create_url = array('create');
                if (isset($params[$controller->_class])) {
                    $create_url[$controller->_class] = $params[$controller->_class];
                }

                $controller->menu = array(
                    array(
                        'label' => Yii::t('application', 'Create'),
                        'url' => $create_url,
                        'itemOptions' => array('class' => 'create')
                    ),
                );
            break;

            case 'create':
                $controller->menu = array(
                    array(
                        'label' => Yii::t('application', 'Admin'),
                        'url' => array('admin'),
                        'itemOptions' => array('class' => 'manage')
                    ),
                );
            break;

            case 'update':
                $controller->menu = array();

                if(key_exists('view', $controller->actions())) {
                    $controller->menu[] = array(
                        'label' => Yii::t('application', 'View'),
                        'url' => array('view', 'id' => $params['id']),
                        'itemOptions' => array('class' => 'view')
                    );
                }

                $controller->menu[] = array(
                    'label' => Yii::t('application', 'Admin'),
                    'url' => array('admin'),
                    'itemOptions' => array('class' => 'manage')
                );
            break;

            case 'view':
                $controller->menu = array(
                    array(
                        'label' => Yii::t('application', 'Update'),
                        'url' => array('update', 'id' => $params['id']),
                        'itemOptions' => array('class' => 'update')
                    ),
                    array(
                        'label' => Yii::t('application', 'Admin'),
                        'url' => array('admin'),
                        'itemOptions' => array('class' => 'manage')
                    ),
                );
            break;
        }

        return true;
    }

    protected function postFilter($filterChain)
    {
        $controller = $filterChain->controller;

//        if (!Yii::app()->request->isAjaxRequest && empty($controller->menu)) {
//            throw new CException('Меню действий не должен быть пустым');
//        }
    }
}
