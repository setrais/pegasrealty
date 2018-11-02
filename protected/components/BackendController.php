<?php

class BackendController extends MyController {

    public $tabs = array();

    public function init() {
        
        parent::init();
        
        $app = Yii::app();
        /*$app->language = 'ru';*/
        $cs = Yii::app()->getClientScript();
        if ( !$cs->scriptMap['jquery.js'] )  $app->clientScript->registerCoreScript('jquery');        
        if ( !$cs->scriptMap['jquery.ui.js'] ) $app->clientScript->registerCoreScript('jquery.ui');                            
                
        
        //$app->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/backend/widgets/jui/themes/cupertino/jquery-ui.css');
        //$baseScriptUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets.gridview'));
        //$app->clientScript->registerScriptFile( $baseScriptUrl.'/jquery.yiigridview.js');
        
        /*if ( !$cs->scriptMap['jquery.fancybox-1.3.4.pack.js'] ) $app->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.fancybox-1.3.4.pack.js');
        if ( !$cs->scriptMap['jquery.easing-1.3.pack.js'] ) $app->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.easing-1.3.pack.js');
        if ( !$cs->scriptMap['jquery.jquery.easytabs.min.js'] ) $app->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/easytabs/jquery.easytabs.min.js');
        if ( !$cs->scriptMap['jquery.hashchange.min.js'] ) $app->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/easytabs/jquery.hashchange.min.js');

        if ( !$cs->scriptMap['jquery.fancybox-1.3.4.css'] ) $app->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/fancybox/jquery.fancybox-1.3.4.css');
        if ( !$cs->scriptMap['jquery.pnotify.min.js'] ) $app->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/backend/jquery.pnotify/jquery.pnotify.min.js');
        if ( !$cs->scriptMap['jquery.pnotify.default.css'] ) $app->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/backend/jquery.pnotify/jquery.pnotify.default.css');*/           
                
        //$app->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/frontend/cengine.js');

        /*date_default_timezone_set('Europe/Moscow');
        setlocale(LC_ALL, 'ru_RU');*/
        
    }

    public function filters() {
        return array(
            'accessControl',
            array('application.components.backend.filters.PageTitle - login, delete'),
            array('application.components.backend.filters.Breadcrumbs - login, delete'),
            array('application.components.backend.filters.Menu - login, delete'),
            array('application.components.backend.filters.Tabs'),
        );
    }

    public function accessRules() {
        throw new CException('Не определен метод accessRules в контроллере "' . get_class($this) . '"');
    }

    public function loadModel($id) {
        $model = CActiveRecord::model($this->_class)->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
    
    public function beforeAction($action)
    {                
        
        if( Yii::app()->request->isAjaxRequest ) {
            $this->_clearScriptMap();            
        }else{
            $this->_registerScriptMap();
        }
        
        $cs=Yii::app()->getClientScript();
        if(null!==($scriptMap=Yii::app()->request->getParam('scriptMap')) && is_string($scriptMap)){
             
             foreach(explode(',', $scriptMap) as $script) {
              if ( !in_array($script,array("jquery.multiselect.css","jquery.multiselect.filter.css"))) {      
                        $cs->scriptMap[$script]=false;                        
              }
             }
        }     
               
        /*$normalizedUrl = CHtml::normalizeUrl(array_merge(array("/".$this->route), $_GET));
        if (Yii::app()->request->url != $normalizedUrl && strpos($normalizedUrl, Yii::app()->errorHandler->errorAction) === false) {
            $this->redirect($normalizedUrl, true, 301);
        }*/
 
        return parent::beforeAction($action);
    }  
    
    protected  function _registerScriptMap () {
            Yii::app()->clientScript->registerScriptFile("http://www.google.com/jsapi");
            Yii::app()->clientScript->registerScriptFile("http://maps.googleapis.com/maps/api/js?v=3&sensor=false&language=ru_RU");
            $js_map = " /*<![CDATA[*/ google.load('maps','3',{'other_params':'sensor=false&language=ru_RU'}); var EGMap0 = null; /*]]>*/ ";
            Yii::app()->clientScript->registerScript('loadmap', $js_map
                                                     ,CClientScript::POS_HEAD);
    }
    
    protected function _clearScriptMap() {
            $cs=Yii::app()->getClientScript();
            //$cs->scriptMap['jquery.yiiactiveform.js']=false;
            $cs->scriptMap['jquery.js']=false;
            $cs->scriptMap['jquery-ui.js']=false;
            $cs->scriptMap['jquery-ui.min.js']=false;
            $cs->scriptMap['jquery-ui-i18n.min.js']=false;
            $cs->scriptMap['jquery.yiigridview.js']=false;
            $cs->scriptMap['jquery.ba-bbq.js']=false;  
            $cs->scriptMap['jquery.ui.widget.min.js']=false;  
            
            $cs->scriptMap['jquery.fancybox-1.3.4.pack.js']=false;
            $cs->scriptMap['jquery.easing-1.3.pack.js']=false;
            $cs->scriptMap['jquery.easytabs.min.js']=false;
            $cs->scriptMap['jquery.hashchange.min.js']=false;

            $cs->scriptMap['jquery.fancybox-1.3.4.css']=false;
            $cs->scriptMap['jquery.pnotify.min.js']=false;
            $cs->scriptMap['jquery.pnotify.default.css']=false;
            //$cs->scriptMap['jquery.multiselect.js']=false;             
    }    
}
