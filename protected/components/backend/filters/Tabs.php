<?php

class Tabs extends CFilter
{
    protected function preFilter($filterChain)
    {
        $controller = $filterChain->controller;

        /*if (method_exists($controller, 'tabs')) {
            $tabs_visible = array_filter($controller::tabs(), function($tab) {
                return !isset($tab['visible']) || $tab['visible'] == true;
            });

            if (count($tabs_visible) > 1) {
                $controller->tabs = $tabs_visible;
            }
        }*/

        return true;
    }
}
