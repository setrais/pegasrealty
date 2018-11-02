<?php

class RealestatesController extends FrontendController
{
        public $layout='//layouts/main_new';
        
        /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex($type=null,$canonical=true,$property=null)
	{                              
            //if ( strpos(Yii::app()->request->getPathInfo(),'view' )!==false ) throw new CHttpException(404,'The requested page does not exist.');
                           
            // renders the view file 'protected/views/site/index.php'
	    // using the default layout 'protected/views/layouts/main.php'               
            //if ( /*Yii::app()->user->isGuest*/ !Yii::app()->user->checkAccess('superadmin')) { 
            //     $this->layout='//layouts/default';
            //     $this->render('site/index');
            //}else{                    
                  if( ( Yii::app()->getRequest()->getParam('Realestates_page')
                        || Yii::app()->getRequest()->getParam('Realestates_sort') 
                        || Yii::app()->getRequest()->getParam('Realestates')   
                           //['Realestates']['nid']         
                           //['Realestates']['title']   
                           //['Realestates']['operation_id'] 
                           //['Realestates']['district_id']                         
                           //['Realestates']['realestate_vid_id']                    
                           //['Realestates']['realestate_class_id']         
                           //['Realestates']['unit_id'] 
                           //['Realestates']['remoteness']                                                    
                           //['Realestates']['area']                                                    
                           //['Realestates']['price']                   
                           //['Realestates']["valute_id"]                                                        
                        || Yii::app()->getRequest()->getParam('operation_id')                                                         
                        || Yii::app()->getRequest()->getParam('district_id')                               
                        || Yii::app()->getRequest()->getParam('realestate_vid_id')  
                        || Yii::app()->getRequest()->getParam('realestate_type_id')    
                        || Yii::app()->getRequest()->getParam('realestate_class_id') 
                        || Yii::app()->getRequest()->getParam('unit_id')    
                        || Yii::app()->getRequest()->getParam('map_id')                            
                        || Yii::app()->getRequest()->getParam('remoteness-from')                                                        
                        || Yii::app()->getRequest()->getParam('remoteness-to')                                                                                                                                                                    
                        || Yii::app()->getRequest()->getParam('area-from')                                                                                                                
                        || Yii::app()->getRequest()->getParam('area-to') 
                        || Yii::app()->getRequest()->getParam('price-from')                             
                        || Yii::app()->getRequest()->getParam('price-to')                            
                        || Yii::app()->getRequest()->getParam('valute') 
                        || Yii::app()->getRequest()->getParam('coefficient_corridor') 
                        || Yii::app()->getRequest()->getParam('polygon') 
                        || Yii::app()->getRequest()->getParam('metro')                            
                        || Yii::app()->getRequest()->getParam('remoteness')     
                        || Yii::app()->getRequest()->getParam('area') 
                        || Yii::app()->getRequest()->getParam('sort')   
                        || Yii::app()->getRequest()->getParam('size')    
                        || Yii::app()->getRequest()->getParam('price') ) && $canonical      
                 ){   
                          $href = is_string($canonical) ? $canonical : Yii::app()->getBaseUrl(true).'/'.Yii::app()->request->getPathInfo();
                          Yii::app()->clientScript->registerLinkTag('canonical', null, $href);
                          unset($href); 
                 }       
                    
                 $metro_stantions = Metros::model()->findAll("(mapid is not null)and((act is null)or(act=1))and((del is null)or(del=0))", array('select'=>'id, mapid, coords_map, shape_map, pointerid, style_pointer_map') );                                                                       
                 //echo "<pre>"; print_r($metro_stantions); echo "</pre>";
                 $metro_lines_dok = Manies::model()->findAll("(groups='O')and((act is null)or(act=1))and((del is null)or(del=0))", array('select'=>'sid, coords_map, shape_map, style_map') );                                                   
                 //echo "<pre>"; print_r($metro_lines_dok); echo "</pre>";
                 $metro_lines = Manies::model()->findAll(array("condition"=>"(groups='L' or groups='K' )and((shape_map is not null) or (shape_map<>''))and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, groups, title, coords_map, shape_map, style_map','order'=>'sort') );                                                                       
                 $metro_slines = Manies::model()->findAll(array("condition"=>"(groups='L')and((shape_map is not null) or (shape_map<>''))and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, groups, title, coords_map, shape_map, style_map, linesort','order'=>'linesort') );                                                                       
                 $metro_gstations = Manies::model()->findAll(array("condition"=>"(groups='K')and((shape_map is not null) or (shape_map<>''))and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, groups, title, coords_map, shape_map, style_map, linesort','order'=>'linesort') );                                                                       
                 $metro_saos = Manies::model()->findAll(array("condition"=>"(groups='R')and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, pid, groups, title, coords_map, shape_map, style_map, linesort') );                                                                                           
                 $metro_childs = Manies::model()->findAll(array("condition"=>"(groups='P')and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, pid, groups, title, coords_map, shape_map, style_map, linesort') );                                                                                           
                 $childs = array();
                 
                 foreach ($metro_saos as $key=>$sao) {                                                                        
                    foreach ( $metro_childs as $cey=>$child ) {
                        if ( $child->pid === $sao->sid ) {
                             $childs[$sao->sid][] =  $child;
                        }
                    }   
                 }
                    
                    //$metro_lines = Manies::model()->findAll("(groups='L')and((shape_map is not null) or (shape_map<>''))and((act is null)or(act=1))and((del is null)or(del=0))", array('select'=>'sid, groups, title, coords_map, shape_map, style_map','sort'=>'sort asc') );
                    //echo "<pre>"; print_r($metro_lines_dok); echo "</pre>";
                    
                    $metros["stations"] = $metro_stantions;
                    $metros["lines_dok"]= $metro_lines_dok;
                    $metros["lines"]    = $metro_lines;
                    $metros["slines"]   = $metro_slines;
                    $metros["saos"]     = $metro_saos;
                    $metros["childs"]   = $childs;
                    $metros["gstations"]= $metro_gstations;
                    $model=new Realestates('search'); 
                    //$model->getDbCriteria()->compare('t.in_stock',1);
                    $model->getDbCriteria()->compare('t.act',1);
                    $model->getDbCriteria()->mergeWith(array( 'order'=>'t.create_date DESC'));
                            
                    if( isset($_POST['Realestates']) || isset($_POST['realestatesProperties']) || isset($_POST['area-to']) || isset($_POST['area-from']) || isset($_POST['price-to']) || isset($_POST['price-from']) ) $_GET=$_POST; 
                    else $_POST=$_GET;
                    //$_POST=$_GET; 
                    
                    //if( isset($_POST['Realestates'])) :                                                    
                                
                           // В случае разьединения параметров
                            if ( isset($_POST['operation_id']) && !empty($_POST['operation_id']) ) {
                                if (is_string($_POST['operation_id'])) $_POST['operation_id']=explode(',', $_POST['operation_id']);
                                $model->getDbCriteria()->addInCondition('operation_id',$_POST['operation_id']);  
                            }                                                         
                           
                            if ( isset($_POST['district_id']) && !empty($_POST['district_id']) ) {
                                if (is_string($_POST['district_id'])) $_POST['district_id']=explode(',', $_POST['district_id']);
                                $model->getDbCriteria()->addInCondition('t.district_id',$_POST['district_id']);  
                            }
                            
                            if ( isset($_POST['unit_id']) && !empty($_POST['unit_id']) ) {
                                if (is_string($_POST['unit_id'])) $_POST['unit_id']=explode(',', $_POST['unit_id']);
                                $model->getDbCriteria()->addInCondition('unit_id',$_POST['unit_id']);  
                            }

                            if ( isset($_POST['realestate_type_id']) && !empty($_POST['realestate_type_id']) ) {
                                if (is_string($_POST['realestate_type_id'])) $_POST['realestate_type_id']=explode(',', $_POST['realestate_type_id']);
                                $model->getDbCriteria()->addInCondition('realestate_type_id',$_POST['realestate_type_id']);  
                            }
                            
                            if ( isset($_POST['realestate_vid_id']) && !empty($_POST['realestate_vid_id']) ) {
                                if (is_string($_POST['realestate_vid_id'])) $_POST['realestate_vid_id']=explode(',', $_POST['realestate_vid_id']);
                                $model->getDbCriteria()->addInCondition('realestate_vid_id',$_POST['realestate_vid_id']);  
                            }
                                                    
                            if ( isset($_POST['realestate_class_id']) && !empty($_POST['realestate_class_id']) ) {
                                if (is_string($_POST['realestate_class_id'])) $_POST['realestate_class_id']=explode(',', $_POST['realestate_class_id']);
                                $model->getDbCriteria()->addInCondition('realestate_class_id',$_POST['realestate_class_id']);  
                            }
                            
                            
                            if ( is_array($_POST['Realestates']['operation_id']) && $_POST['Realestates']['operation_id'][0]==="") {                                                                                                  
                                 $_POST['Realestates']['operation_id']=null;
                            }   

                            if ( is_array($_POST['Realestates']['unit_id']) && $_POST['Realestates']['unit_id'][0]==="") {                                                                                                  
                                 $_POST['Realestates']['unit_id']=null;
                            }                                                                                       
                            if ( isset($_POST['Realestates']['metro_id']) && !empty($_POST['Realestates']['metro_id'])
                                 ||  isset($_POST['Realestates']['unit_id']) && !empty($_POST['Realestates']['unit_id'])  
                                 ||  isset($_POST['Realestates']['remoteness']) && !empty($_POST['Realestates']['remoteness'])   
                               ) 
                            {
                                 $model->getDbCriteria()->with['metros']  =  array(
                                                'select' => false,
                                                'together' => true,
                                    );  
                            }                                   
                            if ( isset($_POST['metro']) && !empty($_POST['metro']) ) {                                
                                $criteria_mapid=new CDbCriteria;
                                $criteria_mapid->select= 'id,mapid';                                
                                if (is_string($_POST['metro'])) $_POST['metro']=explode(',', $_POST['metro']);
                                $criteria_mapid->addInCondition('mapid',$_POST['metro']);                                
                                $mets = Metros::model()->findAll($criteria_mapid);
                                $mets_map = array();
                                foreach ( $mets as $met) {                                    
                                    $mets_map[]=$met->id;
                                }                   
                                ;
                                $model->getDbCriteria()->addInCondition('metro_id',$mets_map);
                                //$_POST['Realestates']['metro_id']=$mets_map;                                                                 
                            }
                            
                            if (isset($_POST["Realestates"]['realestateDestinations']) && !empty($_POST["Realestates"]['realestateDestinations'])) {
                                
                                if ($_POST["Realestates"]['realestateDestinations']==='all') {
                                    unset($_POST["Realestates"]["realestateDestinations"]);
                                    $model->getDbCriteria()->with['realestateDestinations'] = array(
                                                'select' => false,
                                                'together' => true,
                                                'condition' => 'realestateDestinations.id > 0'
                                    );  
                                } else {
                                    $model->getDbCriteria()->with['realestateDestinations'] = array(
                                                'select' => false,
                                                'together' => true,
                                                'condition' => 'realestateDestinations.id='.$_POST["Realestates"]['realestateDestinations']                                                              
                                                );   
                                }    
                            }                                                         
                            
                            if (isset($_POST["Realestates"]['realestatesProperties'])) {
                                $props_exp = $_POST["Realestates"]['realestatesProperties'];
                                $create_props = true;
                            }else if (isset($_POST["realestatesProperties"])) {
                                if (!is_array($props_exp) && strpos($props_exp,',')>=0) {
                                    $props_exp = $_POST["Realestates"]['realestatesProperties']= explode(',', $_POST['realestatesProperties']);
                                } else {
                                    $props_exp = $_POST["Realestates"]['realestatesProperties']=$_POST['realestatesProperties'];                                                                
                                }    
                                $create_props = true;
                            }                             
                            if ($create_props) {                                
                                if ($props_exp==='all') {
                                    unset($_POST["Realestates"]["realestatesProperties"]);
                                    unset($_POST["realestatesProperties"]);                                
                                    $model->getDbCriteria()->with['realestatesProperties'] = array(
                                                    'select' => false,
                                                    'together' => true,
                                                    'condition' => 'realestatesProperties.id IS NOT NULL'
                                    );  
                                } else if ( is_array($props_exp) || trim($props_exp)<>'') {     
                                    if (is_array($props_exp)) {  
                                        $is_no_props = in_array(0, $props_exp);
                                        $is_separate_entrance = in_array(99, $props_exp);
                                        $diff_props =array_diff($props_exp,array(0,99));                                            
                                        if ( $is_no_props || $is_separate_entrance ) {                                            

                                             if ($is_no_props && $is_separate_entrance ) { 

                                                 $condition = '(realestatesProperties.id IS NULL AND t.is_separate_entrance=1)';                                                
                                                 if ($diff_props) $condition = $condition.'OR((realestatesProperties.id IN ('.implode(',',$diff_props).')) AND  t.is_separate_entrance=1)'; 

                                             }else if ($is_no_props) {

                                                 $condition = '(realestatesProperties.id IS NULL)';
                                                 if ($diff_props) $condition = $condition.'OR(realestatesProperties.id IN ('.implode(',',$diff_props).'))'; 

                                             }else if ($is_separate_entrance) {
                                                 $condition = '(t.is_separate_entrance=1)';
                                                 if ($diff_props) $condition = $condition.'AND(realestatesProperties.id IN ('.implode(',',$diff_props).'))'; 
                                             } 

                                        } else {     
                                            $condition = 'realestatesProperties.id IN ('.implode(',',$_POST["Realestates"]['realestatesProperties']).')';                                                              
                                        }
                                        if ($condition) {
                                            $model->getDbCriteria()->with['realestatesProperties'] = array(
                                                               'select' => false,
                                                               'together' => true,
                                                               'condition' => $condition               
                                         );  
                                        }
                                    }else{                                        
                                        if (strpos($props_exp,',')===false && trim($props_exp)<>'') {
                                            if (strval($props_exp)==0) {
                                                $condition = 'realestatesProperties.id IS NULL';
                                            } else if (strval($props_exp)==99) {
                                                $condition = 't.is_separate_entrance=1';
                                            } else {                                                
                                                $condition = 'realestatesProperties.id='.strval($props_exp);                                                              
                                            }
                                            $model->getDbCriteria()->with['realestatesProperties'] = array(
                                                        'select' => false,
                                                        'together' => true,
                                                        'condition' => $condition
                                             );  
                                        } else {                                               
                                             $props_exp = explode(',',$props_exp);
                                             $is_no_props = in_array(0, $props_exp);
                                             $is_separate_entrance = in_array(99, $props_exp);
                                             $diff_props =array_diff($props_exp,array(0,99));                                            
                                             if ( $is_no_props || $is_separate_entrance ) {                                            

                                                  if ($is_no_props && $is_separate_entrance ) { 

                                                      $condition = '(realestatesProperties.id IS NULL AND t.is_separate_entrance=1)';                                                
                                                      if ($diff_props) $condition = $condition.'OR((realestatesProperties.id IN ('.implode(',',$diff_props).')) AND  t.is_separate_entrance=1)'; 

                                                  }else if ($is_no_props) {

                                                      $condition = '(realestatesProperties.id IS NULL)';
                                                      if ($diff_props) $condition = $condition.'OR(realestatesProperties.id IN ('.implode(',',$diff_props).'))'; 

                                                  }else if ($is_separate_entrance) {
                                                      $condition = '(t.is_separate_entrance=1)';
                                                      if ($diff_props) $condition = $condition.'AND(realestatesProperties.id IN ('.implode(',',$diff_props).'))'; 
                                                  } 

                                             } else {     
                                                  $condition = 'realestatesProperties.id IN ('.implode(',',$props_exp).')';                                                              
                                             }
                                             if ($condition) {
                                                 $model->getDbCriteria()->with['realestatesProperties'] = array(
                                                                        'select' => false,
                                                                        'together' => true,
                                                                        'condition' => $condition               
                                                 );  
                                             }
                                         }
                                     }
                                }  
                            }
                               
                            //print_r($_POST['Realestates']);
                            
                            $model->attributes=$_POST['Realestates'];                        
                            
                            //print_r($model->attributes);
                            
                            if ($type && Yii::app()->getController()->getAction()->getId()!='operation') $model->operation_id=1;
                            
                            if ( trim($_POST['remoteness-from'])<>'' || trim($_POST['remoteness-to'])<>'') {
                                
                                if ( empty($_POST['remoteness-from']) ) $_POST['remoteness-from']=0;
                                if ( empty($_POST['remoteness-to']) ) $_POST['remoteness-to']=20;
                                $model->getDbCriteria()->with['metros']  =  array(
                                                'select' => false,
                                                'together' => true,
                                );  
                                //$model->getDbCriteria()->addBetweenCondition('t.remoteness', 
                                $model->getDbCriteria()->addBetweenCondition('metros.remoteness', 
                                    intval($_POST['remoteness-from']), intval($_POST['remoteness-to']));                          
                            }
                            
                            if ( trim($_POST['area-from'])<>'' || trim($_POST['area-to'])<>'') {
                                
                                if ( empty($_POST['area-from']) ) $_POST['area-from']=0;
                                if ( empty($_POST['area-to']) ) $_POST['area-to']=40000;
                                
                                 $model->getDbCriteria()->addBetweenCondition('area', 
                                    intval($_POST['area-from']), intval($_POST['area-to']));    
                            }     
                            
                            if ( trim($_POST['valute'][0])<>'') {                                
                                
                                if ( trim($_POST['price-from'])<>'' || trim($_POST['price-to'])<>'') {

                                    if ( empty($_POST['price-from']) ) $_POST['price-from']=0;
                                    if ( empty($_POST['price-to']) ) $_POST['price-to']=( trim($_POST['Realestates']['realestate_price_vid'])=='mounth' ? 100000000 : 240000 );
                                
                                    $model->valute_id = $_POST['valute'][0];
                                    Yii::app()->currency->to = $model->valute->title;                                                                        
                                    
                                    $ainfo_curs = $this->__isCurs();                                    
                                    
                                    Yii::app()->currency->from =$ainfo_curs;                                      
                                    Yii::app()->currency->timeCacheComp = 0;
                                    Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
                                    Yii::app()->currency->init();


                                    if (!empty($ainfo_curs) ) {
                                        $home_sel = "";//IF( v.title='".Yii::app()->currency->to."', t.price,";
                                        $end_sel = "";
                                        foreach ( $ainfo_curs as $key=>$val) {
                                            
                                            if ( trim($_POST['Realestates']['realestate_price_vid'])=='mounth' ) {
                                                $home_sel.= "IF( v.title='".$val["name"]."', t.area*t.price*".Yii::app()->currency->$val["name"]."/12 ,";// t.price)) as `price`';
                                            } else {
                                                $home_sel.= "IF( v.title='".$val["name"]."', t.price*".Yii::app()->currency->$val["name"]." ,";// t.price)) as `price`';
                                            }
                                            $end_sel.= ")";
                                        }
                                        if ( trim($_POST['Realestates']['realestate_price_vid'])=='mounth' ) {
                                            $home_sel.= " t.area*t.price/12";                                    
                                        } else {
                                            $home_sel.= " t.price";                                    
                                        }
                                        $select = $home_sel.$end_sel;
                                        
                                        if ( trim($_POST['Realestates']["valute_id"])<>'') {
                                            $model->valute_id = $_POST['Realestates']["valute_id"];
                                        }else{
                                            $model->valute_id=null;
                                        }
                                        
                                        $condition = $select.' BETWEEN '.intval($_POST['price-from']).' AND '.intval($_POST['price-to']);
                                        $model->getDbCriteria()->addCondition($condition);                                                                        
                                        $model->getDbCriteria()->join= $model->getDbCriteria()->join.' '.' LEFT JOIN valutes v on v.id=t.valute_id ';

                                    }else{                                                                                
                                        if ( trim($_POST['Realestates']['realestate_price_vid'])=='mounth' ) {
                                            $model->getDbCriteria()->addBetweenCondition('area*price/12', $_POST['price-from'], $_POST['price-to']);               
                                        }else{
                                            $model->getDbCriteria()->addBetweenCondition('price', $_POST['price-from'], $_POST['price-to']);               
                                        }    
                                    }                                                                                                                                                              
                                }

                            }else{                                        
                                 if ( trim($_POST['price-from'])<>'' || trim($_POST['price-to'])<>'') {
                                     
                                        if ( empty($_POST['price-from']) ) $_POST['price-from']=0;
                                        if ( empty($_POST['price-to']) ) $_POST['price-to']=( trim($_POST['Realestates']['realestate_price_vid'])=='mounth' ? 100000000 : 240000 );
                                    
                                        if ( trim($_POST['Realestates']['realestate_price_vid'])=='mounth' ) {
                                            $model->getDbCriteria()->addBetweenCondition('area*price/12', intval($_POST['price-from']), intval($_POST['price-to']));               
                                        }else{
                                            $model->getDbCriteria()->addBetweenCondition('price', intval($_POST['price-from']), intval($_POST['price-to']));               
                                        }    
                                 }   
                            }

                            if ( isset($_POST['polygon']) && !empty($_POST['polygon']) ) {
                                
                                if ( $model->getMinLongCoord($_POST['polygon']) && $model->getMaxLongCoord($_POST['polygon'])) {
                                        $model->getDbCriteria()->addBetweenCondition('map_longitude',
                                        $model->getMinLongCoord($_POST['polygon']),
                                        $model->getMaxLongCoord($_POST['polygon']));              
                                }        
                                if ( $model->getMinLatCoord($_POST['polygon']) && $model->getMaxLatCoord($_POST['polygon'])) {
                                        $model->getDbCriteria()->addBetweenCondition('map_latitude',
                                        $model->getMinLatCoord($_POST['polygon']),
                                        $model->getMaxLatCoord($_POST['polygon']));
                                }
                            }
                            
                            //print_r($_POST);
                            // Search for Realestate Properties
                            /*if ( isset($_POST["Realestates"]["realestateProperties"]) && !empty($_POST["Realestates"]["realestateProperties"])) {

                                if ( !intval($_POST["is_many_properties"]) ) {
                                    $model->getDbCriteria()->with['realestateProperties'] = array(
                                                'select' => false,
                                                'together' => true,
                                                'condition' => 'realestateProperties.property_id IN ('
                                                                .implode(',', $_POST["Realestates"]["realestateProperties"]).')' ,                
                                    );                                

                                }else{
                                    $model->getDbCriteria()->with['realestateProperties'] = array(
                                                'select' => false,
                                                'together' => true,
                                                'condition' => 'realestateProperties.property_id IN ('
                                                              .implode(',', $_POST["Realestates"]["realestateProperties"]).')'
                                                              .' AND ('.'(SELECT COUNT(*) FROM realestate_properties sp '
                                                                        .' WHERE realestateProperties.realestate_id=sp.realestate_id AND sp.property_id IN ('
                                                                            .implode(',', $_POST["Realestates"]["realestateProperties"]).') GROUP BY realestate_id)='
                                                                        .count($_POST["Realestates"]["realestateProperties"]).')',                
                                                );

                                }

                            }*/

                    //endif;               
                            
                    /*/Формируем параметры для разности страниц (нужно еще раз проверить)
                    
                    // Формируем список операций
                       $cr_oper=new CDbCriteria;
                       $cr_oper->compare('id',$_POST['Realestates']['operation_id']);
                       $cr_oper->select='id,title';
                       $model_oper = Operations::model()->findAll($cr_oper);
                       if ($model_oper) $oper_onreq = mb_strtolower(implode(',',CHtml::listData($model_oper,'id','title')),'UTF-8');
                            
                    // Формируем список операций
                       $cr_dist=new CDbCriteria;
                       $cr_dist->compare('id',$_POST['Realestates']['district_id']);
                       $cr_dist->compare('id',$_POST['district_id']);
                       $cr_dist->select='id,abbr';
                       $model_dist = Districts::model()->findAll($cr_dist);
                       if ($model_dist) $dist_onreq = mb_strtolower(implode(',',CHtml::listData($model_dist,'id','abbr')),'UTF-8');
                       
                   // Формируем список добораться пешком
                       $cr_unit=new CDbCriteria;
                       $cr_unit->compare('id',$_POST['Realestates']['unit_id']);
                       $cr_unit->compare('id',$_POST['unit_id']);
                       $cr_unit->select='id,abbr';
                       $model_unit = Units::model()->findAll($cr_unit);
                       if ($model_unit) $unit_onreq = 'от 0 до '.$_POST['remoteness-to'].' '.mb_strtolower(implode(',',CHtml::listData($model_unit,'id','abbr')),'UTF-8');
                   
                   // Формируем список обьектов
                       $cr_vid=new CDbCriteria;
                       $cr_vid->compare('id',$_POST['Realestates']['realestate_vid_id']);
                       $cr_vid->compare('id',$_POST['realestate_vid_id']);
                       $cr_vid->select='id,abbr';
                       $model_vid = RealestateVids::model()->findAll($cr_vid);
                       if ($model_vid) $vid_onreq = mb_strtolower(implode(',',CHtml::listData($model_vid,'id','abbr')),'UTF-8');
                   
                   // Формируем список классов
                       $cr_class=new CDbCriteria;
                       $cr_class->compare('id',$_POST['Realestates']['realestate_class_id']);
                       $cr_class->compare('id',$_POST['realestate_class_id']);
                       $cr_class->select='id,abbr';
                       $model_class = RealestateClasses::model()->findAll($cr_class);
                       if ($model_class) $class_onreq = mb_strtolower(implode(',',CHtml::listData($model_class,'id','abbr')),'UTF-8');
                   
                   // Формируем площадь от и до                         
                       $area_onreq = ($_POST['area-from']<>'' ? ' от '.$_POST['area-from'] : '')
                                    .($_POST['area-to']<>'' ? ' до '.$_POST['area-to'] : '');
                   // Формируем стоимость от и до                  
                       $cr_valute=new CDbCriteria;
                       $cr_valute->compare('id',$_POST['valute']);                       
                       $cr_valute->select='id,abbr';
                       $model_valute = Valutes::model()->findAll($cr_class);
                       if ($model_valute) $valute_onreq = mb_strtolower(implode(',',CHtml::listData($model_valute,'id','abbr')),'UTF-8');

                       $price_onreg = ($_POST['price-from']<>'' ? ' от '.$_POST['price-from'] : '')
                                    .($_POST['price-to']<>'' ? ' до '.$_POST['price-to'] : '')
                                    .($valute_onreq ? $valute_onreq : '');
                   
                   // Внутренний nid 
                      $nid_onreq = ($_POST['Realestates']['nid']<>'' ? $_POST['Realestates']['nid'] : null);
                   
                   // Заголовок недвижимости title
                      $name_onreq = ($_POST['Realestates']['title']<>'' ? $_POST['Realestates']['title'] : null);                     
                   
                   // Формируем метро
                      $cr_metro=new CDbCriteria;
                      $cr_metro->compare('mapid',$_POST['valute']);                       
                      $cr_metro->select='id,title,mapid';
                      $model_metro = Metros::model()->findAll($cr_metro);
                      if ($model_metro) $metro_onreq = mb_strtolower(implode(',',CHtml::listData($model_metro,'id','title')),'UTF-8');                                                               
                   
                   // Добираться от метро 
                      $remoteness_onreq = ($_POST['Realestates']['remoteness']<>'' ? $_POST['Realestates']['remoteness'] : null);
                      if ($remoteness_onreq) {
                         $cr_unit=new CDbCriteria;
                         $cr_unit->compare('id',$_POST['Realestates']['unit_id']);
                         $cr_unit->compare('id',$_POST['unit_id']);
                         $cr_unit->select='id,abbr';
                         $model_unit = Units::model()->findAll($cr_unit);
                         if ($model_unit) $unit_onreq = $remoteness.' '.mb_strtolower(implode(',',CHtml::listData($model_unit,'id','abbr')),'UTF-8');
                      }
                   // Формируем площадь
                      $area_onreq = ($_POST['Realestates']['area']<>'' ? $_POST['Realestates']['area'] : null);
                   
                   // Формируем цену
                      $price_onreq = ($_POST['Realestates']['price']<>'' ? $_POST['Realestates']['price'] : null); 

                   // Формируем цену с валютой                      
                      $cr_valute=new CDbCriteria;
                      $cr_valute->compare('id',$_POST['Realestates']['valute_id']);                       
                      $cr_valute->select='id,abbr';
                      $model_valute = Valutes::model()->findAll($cr_class);
                      if ($model_valute) $valute_onreq = mb_strtolower(implode(',',CHtml::listData($model_valute,'id','abbr')),'UTF-8');
                      $price_onreq = $price_onreq.' '.$valute_onreq; 
                   
                      echo $title_onreq = ' операция - '.$oper_onreq.
                                           ' / '.' район - '.$dist_onreq.
                                           ' / '.' объект - '.$vid_onreq.
                                           ' / '.' добираться - '.$unit_onreq.
                                           ' / '.' класс - '.$class_onreq.
                                           ' / '.' площадь - '.$area_onreq.
                                           ' / '.' оплата - '.$price_onreq.
                                           ' / '.' внутренний ид - '.$nid_onreq.
                                           ' / '.' заголовок - '.$name_onreq.
                                           ' / '.' метро - '.$metro_onreq ;    
                      echo $desc_onreq = ' по запросу:'.$title_onreq;
                      echo $akeywords_onreq = array();
                                                            
                      // @TODO Добавка к заголовку при пагинации                      
                      //$title_onreq = ($title_onreq<>'' ? ( trim($_GET['Realestates_page'])<>'' ? $title_onreq.' стр.'.$_GET['Realestates_page'] : '');                                                      
                      //$title_onreq = ($title_onreq<>'' ? '('.$title_onreq.')' : null);
                    
                      // @TODO Добавка к описанию при пагинации                      
                      //$desc_onreq = ($desc_onreq<>'' ? ( trim($_GET['Realestates_page'])<>'' ? $desc_onreq.' стр.'.$_GET['Realestates_page'] : '');
                      //$desc_onreq = ($desc_onreq<>'' ? '('.$desc_onreq.')' : null);
                    
                      // @TODO Добавка к ключевым словам при пагинации
                      //if (trim($_GET['page'])<>'') $akeywords_onreq[] = 'далее';                    
                    
                      if ($oper_onreq) { array_merge($akeywords_onreq,array('операция'),explode(',',$oper_onreq)); }
                      if ($dist_onreq) { array_merge($akeywords_onreq,array('район'),explode(',',$dist_onreq)); }
                      if ($vid_onreq) { array_merge($akeywords_onreq,array('объект'),explode(',',$vid_onreq)); }
                      if ($unit_onreq) { array_merge($akeywords_onreq,array('добираться'),explode(',',mb_strtolower(implode(',',CHtml::listData($model_unit,'id','abbr')),'UTF-8')); }
                      if ($class_onreq) { array_merge($akeywords_onreq,array('класс'),explode(',',$class_onreq)); }
                      if ($area_onreq) { array_merge($akeywords_onreq,array('площадь')); }
                      if ($price_onreq) { array_merge($akeywords_onreq,array('оплата')); }
                      if ($nid_onreq) { array_merge($akeywords_onreq,array($nid_onreq)); }
                      if ($name_onreq) { array_merge($akeywords_onreq,array($name_onreq)); }
                      if ($metro_onreq) { array_merge($akeywords_onreq,array('метро'),explode(',',mb_strtolower(implode(',',CHtml::listData($model_metro,'id','title')),'UTF-8'))); }
                   */                               
        
                    
                    $map = $this->_show_map_poligon($model);                                    
                                                        
                    $model_claim=new ClaimSendForm;                    
                    $this->render( (!$type ? Yii::app()->getController()->getAction()->getId() : $type), 
                                   array( 'metros'=>$metros,                                            
                                          'map'=>$map,
                                          'mets'=>$mets,
                      		  	  'model'=>$model,
                                          'model_claim'=>$model_claim,
                                          'property'=>$property,
                                          //'page_onreg'=>$_GET['Realestates_page'], // открываем в новой версии
                                          //'title_onreg'=>$title_onreg, // открываем в новой версии
                                          //'desc_onreg'=>$desc_onreg, // открываем в новой версии
                                          //'akeywords_onreg'=>akeywords_onreg,
                                  ));
                    
                    //$this->redirect(Yii::app()->user->loginUrl);
               //}
	}

        /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	protected function actionNewIndex($type=null,$canonical=true)
	{        
            //print_r($_GET);            
            //if ( strpos(Yii::app()->request->getPathInfo(),'view' )!==false ) throw new CHttpException(404,'The requested page does not exist.');
                           
            // renders the view file 'protected/views/site/index.php'
	    // using the default layout 'protected/views/layouts/main.php'               
            //if ( /*Yii::app()->user->isGuest*/ !Yii::app()->user->checkAccess('superadmin')) { 
            //     $this->layout='//layouts/default';
            //     $this->render('site/index');
            //}else{                    
                  if( ( Yii::app()->getRequest()->getParam('Realestates_page')
                        || Yii::app()->getRequest()->getParam('Realestates_sort') 
                        || Yii::app()->getRequest()->getParam('Realestates')   
                           //['Realestates']['nid']         
                           //['Realestates']['title']   
                           //['Realestates']['operation_id'] 
                           //['Realestates']['district_id']                         
                           //['Realestates']['realestate_vid_id']                    
                           //['Realestates']['realestate_class_id']         
                           //['Realestates']['unit_id'] 
                           //['Realestates']['remoteness']                                                    
                           //['Realestates']['area']                                                    
                           //['Realestates']['price']                   
                           //['Realestates']["valute_id"]                                                        
                        || Yii::app()->getRequest()->getParam('operation_id')                                                         
                        || Yii::app()->getRequest()->getParam('district_id')                               
                        || Yii::app()->getRequest()->getParam('realestate_vid_id')  
                        || Yii::app()->getRequest()->getParam('realestate_class_id') 
                        || Yii::app()->getRequest()->getParam('unit_id')    
                        || Yii::app()->getRequest()->getParam('map_id')                            
                        || Yii::app()->getRequest()->getParam('remoteness-from')                                                        
                        || Yii::app()->getRequest()->getParam('remoteness-to')                                                                                                                                                                    
                        || Yii::app()->getRequest()->getParam('area-from')                                                                                                                
                        || Yii::app()->getRequest()->getParam('area-to') 
                        || Yii::app()->getRequest()->getParam('price-from')                             
                        || Yii::app()->getRequest()->getParam('price-to')                            
                        || Yii::app()->getRequest()->getParam('valute') 
                        || Yii::app()->getRequest()->getParam('polygon') 
                        || Yii::app()->getRequest()->getParam('metro')                            
                        || Yii::app()->getRequest()->getParam('remoteness')     
                        || Yii::app()->getRequest()->getParam('area') 
                        || Yii::app()->getRequest()->getParam('price') ) && $canonical     
                 ){   
                        
                        $href = is_string($canonical) ? $canonical : Yii::app()->getBaseUrl(true).'/'.Yii::app()->request->getPathInfo();
                        Yii::app()->clientScript->registerLinkTag('canonical', null, $href);
                        unset($href);
                 }        
                    
                 $metro_stantions = Metros::model()->findAll("(mapid is not null)and((act is null)or(act=1))and((del is null)or(del=0))", array('select'=>'id, mapid, coords_map, shape_map, pointerid, style_pointer_map') );                                                                       
                 //echo "<pre>"; print_r($metro_stantions); echo "</pre>";
                 $metro_lines_dok = Manies::model()->findAll("(groups='O')and((act is null)or(act=1))and((del is null)or(del=0))", array('select'=>'sid, coords_map, shape_map, style_map') );                                                   
                 //echo "<pre>"; print_r($metro_lines_dok); echo "</pre>";
                 $metro_lines = Manies::model()->findAll(array("condition"=>"(groups='L' or groups='K' )and((shape_map is not null) or (shape_map<>''))and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, groups, title, coords_map, shape_map, style_map','order'=>'sort') );                                                                       
                 $metro_slines = Manies::model()->findAll(array("condition"=>"(groups='L')and((shape_map is not null) or (shape_map<>''))and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, groups, title, coords_map, shape_map, style_map, linesort','order'=>'linesort') );                                                                       
                 $metro_gstations = Manies::model()->findAll(array("condition"=>"(groups='K')and((shape_map is not null) or (shape_map<>''))and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, groups, title, coords_map, shape_map, style_map, linesort','order'=>'linesort') );                                                                       
                 $metro_saos = Manies::model()->findAll(array("condition"=>"(groups='R')and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, pid, groups, title, coords_map, shape_map, style_map, linesort') );                                                                                           
                 $metro_childs = Manies::model()->findAll(array("condition"=>"(groups='P')and((act is null)or(act=1))and((del is null)or(del=0))", 'select'=>'sid, pid, groups, title, coords_map, shape_map, style_map, linesort') );                                                                                           
                 $childs = array();
                 
                 foreach ($metro_saos as $key=>$sao) {                                                                        
                    foreach ( $metro_childs as $cey=>$child ) {
                        if ( $child->pid === $sao->sid ) {
                             $childs[$sao->sid][] =  $child;
                        }
                    }   
                 }
                    
                    //$metro_lines = Manies::model()->findAll("(groups='L')and((shape_map is not null) or (shape_map<>''))and((act is null)or(act=1))and((del is null)or(del=0))", array('select'=>'sid, groups, title, coords_map, shape_map, style_map','sort'=>'sort asc') );
                    //echo "<pre>"; print_r($metro_lines_dok); echo "</pre>";
                    
                    $metros["stations"] = $metro_stantions;
                    $metros["lines_dok"]= $metro_lines_dok;
                    $metros["lines"]    = $metro_lines;
                    $metros["slines"]   = $metro_slines;
                    $metros["saos"]     = $metro_saos;
                    $metros["childs"]   = $childs;
                    $metros["gstations"]= $metro_gstations;
                    
                    $model=new Realestates('search'); 
                    //$model->getDbCriteria()->compare('t.in_stock',1);
                    $model->getDbCriteria()->compare('t.act',1);
                    $model->getDbCriteria()->mergeWith(array( 'order'=>'t.create_date DESC'));
                            
                    if( isset($_POST['Realestates']) ) $_GET=$_POST; 
                    else $_POST=$_GET;
                    //$_POST=$_GET; 

                    //if( isset($_POST['Realestates'])) :                                                    
                                
                           // В случае разьединения параметров
                            if ( isset($_POST['operation_id']) && !empty($_POST['operation_id']) ) {
                                if (is_string($_POST['operation_id'])) $_POST['operation_id']=explode(',', $_POST['operation_id']);
                                $model->getDbCriteria()->addInCondition('operation_id',$_POST['operation_id']);  
                            }                                                         
                           
                            if ( isset($_POST['district_id']) && !empty($_POST['district_id']) ) {
                                if (is_string($_POST['district_id'])) $_POST['district_id']=explode(',', $_POST['district_id']);
                                $model->getDbCriteria()->addInCondition('t.district_id',$_POST['district_id']);  
                            }
                            
                            if ( isset($_POST['unit_id']) && !empty($_POST['unit_id']) ) {
                                if (is_string($_POST['unit_id'])) $_POST['unit_id']=explode(',', $_POST['unit_id']);
                                $model->getDbCriteria()->addInCondition('unit_id',$_POST['unit_id']);  
                            }
                              
                            if ( isset($_POST['realestate_vid_id']) && !empty($_POST['realestate_vid_id']) ) {
                                if (is_string($_POST['realestate_vid_id'])) $_POST['realestate_vid_id']=explode(',', $_POST['realestate_vid_id']);
                                $model->getDbCriteria()->addInCondition('realestate_vid_id',$_POST['realestate_vid_id']);  
                            }
                                                    
                            if ( isset($_POST['realestate_class_id']) && !empty($_POST['realestate_class_id']) ) {
                                if (is_string($_POST['realestate_class_id'])) $_POST['realestate_class_id']=explode(',', $_POST['realestate_class_id']);
                                $model->getDbCriteria()->addInCondition('realestate_class_id',$_POST['realestate_class_id']);  
                            }
                            
                            if ( is_array($_POST['Realestates']['operation_id']) && $_POST['Realestates']['operation_id'][0]==="") {                                                                                                  
                                 $_POST['Realestates']['operation_id']=null;
                            }   

                            if ( is_array($_POST['Realestates']['unit_id']) && $_POST['Realestates']['unit_id'][0]==="") {                                                                                                  
                                 $_POST['Realestates']['unit_id']=null;
                            }                                                                                       
                                                                
                            if ( isset($_POST['metro']) && !empty($_POST['metro']) ) {
                                
                                $criteria_mapid=new CDbCriteria;
                                $criteria_mapid->select= 'id,mapid';                                
                                if (is_string($_POST['metro'])) $_POST['metro']=explode(',', $_POST['metro']);
                                $criteria_mapid->addInCondition('mapid',$_POST['metro']);                                
                                $mets = Metros::model()->findAll($criteria_mapid);
                                $mets_map = array();
                                foreach ( $mets as $met) {                                    
                                    $mets_map[]=$met->id;
                                }                                     
                                $model->getDbCriteria()->addInCondition('metro_id',$mets_map);
                                //$_POST['Realestates']['metro_id']=$mets_map;                                                                 
                            }
                            
                            if (isset($_POST["Realestates"]['realestateDestinations']) && !empty($_POST["Realestates"]['realestateDestinations'])) {
                                    $model->getDbCriteria()->with['realestateDestinations'] = array(
                                                'select' => false,
                                                'together' => true,
                                                'condition' => 'realestateDestinations.id='.$_POST["Realestates"]['realestateDestinations']                                                              
                                                );   
                            }
                            
                            if (isset($_POST["Realestates"]['realestatesProperties']) && !empty($_POST["Realestates"]['realestatesProperties'])) {
                                    $model->getDbCriteria()->with['realestatesProperties'] = array(
                                                'select' => false,
                                                'together' => true,
                                                'condition' => 'realestatesProperties.id='.$_POST["Realestates"]['realestatesProperties']                                                              
                                                );   
                            }
                               
                            //print_r($_POST['Realestates']);
                            
                            $model->attributes=$_POST['Realestates'];                        
                            
                            if ($type && Yii::app()->getController()->getAction()->getId()!='operation') $model->operation_id=1;
                            
                            if ( trim($_POST['remoteness-from'])<>'' && trim($_POST['remoteness-to'])<>'') 
                                $model->getDbCriteria()->addBetweenCondition('remoteness', 
                                    $_POST['remoteness-from'], $_POST['remoteness-to']);                          

                            if ( trim($_POST['area-from'])<>'' && trim($_POST['area-to'])<>'') 
                                 $model->getDbCriteria()->addBetweenCondition('area', 
                                    $_POST['area-from'], $_POST['area-to']);                

                            if ( trim($_POST['valute'][0])<>'') {
                                if ( trim($_POST['price-from'])<>'' && trim($_POST['price-to'])<>'') {
                                    $model->valute_id = $_POST['valute'][0];
                                    Yii::app()->currency->to = $model->valute->title;

                                    $ainfo_curs = $this->__isCurs();
                                    
                                    Yii::app()->currency->from =$ainfo_curs;  
                                    Yii::app()->currency->timeCacheComp = 0;
                                    Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
                                    Yii::app()->currency->init();


                                    if (!empty($ainfo_curs) ) {

                                        $home_sel = "";//IF( v.title='".Yii::app()->currency->to."', t.price,";
                                        $end_sel = "";
                                        foreach ( $ainfo_curs as $key=>$val) {
                                            
                                            if ( trim($_POST['Realestates']['realestate_price_vid'])=='mounth' ) {
                                                $home_sel.= "IF( v.title='".$val["name"]."', t.area*t.price*".Yii::app()->currency->$val["name"]."/12 ,";// t.price)) as `price`';
                                            } else {
                                                $home_sel.= "IF( v.title='".$val["name"]."', t.price*".Yii::app()->currency->$val["name"]." ,";// t.price)) as `price`';
                                            }
                                            $end_sel.= ")";
                                        }
                                        if ( trim($_POST['Realestates']['realestate_price_vid'])=='mounth' ) {
                                            $home_sel.= " t.area*t.price/12";                                    
                                        } else {
                                            $home_sel.= " t.price";                                    
                                        }
                                        $select = $home_sel.$end_sel;
                                        
                                        if ( trim($_POST['Realestates']["valute_id"])<>'') {
                                            $model->valute_id = $_POST['Realestates']["valute_id"];
                                        }else{
                                            $model->valute_id=null;
                                        }
                                        
                                        $condition = $select.' BETWEEN '.$_POST['price-from'].' AND '.$_POST['price-to'];
                                        $model->getDbCriteria()->addCondition($condition);                                                                        
                                        $model->getDbCriteria()->join= $model->getDbCriteria()->join.' '.' LEFT JOIN valutes v on v.id=t.valute_id ';

                                    }else{
                                        
                                        if ( trim($_POST['Realestates']['realestate_price_vid'])=='mounth' ) {
                                            $model->getDbCriteria()->addBetweenCondition('area*price/12', $_POST['price-from'], $_POST['price-to']);               
                                        }else{
                                            $model->getDbCriteria()->addBetweenCondition('price', $_POST['price-from'], $_POST['price-to']);               
                                        }    
                                    }                                                                                                                                                              
                                }

                            }else{
                                 if ( trim($_POST['price-from'])<>'' && trim($_POST['price-to'])<>'') {
                                        if ( trim($_POST['Realestates']['realestate_price_vid'])=='mounth' ) {
                                            $model->getDbCriteria()->addBetweenCondition('area*price/12', $_POST['price-from'], $_POST['price-to']);               
                                        }else{
                                            $model->getDbCriteria()->addBetweenCondition('price', $_POST['price-from'], $_POST['price-to']);               
                                        }    
                                 }   
                            }

                            if ( isset($_POST['polygon']) && !empty($_POST['polygon']) ) {
                                
                                if ( $model->getMinLongCoord($_POST['polygon']) && $model->getMaxLongCoord($_POST['polygon'])) {
                                        $model->getDbCriteria()->addBetweenCondition('map_longitude',
                                        $model->getMinLongCoord($_POST['polygon']),
                                        $model->getMaxLongCoord($_POST['polygon']));              
                                }        
                                if ( $model->getMinLatCoord($_POST['polygon']) && $model->getMaxLatCoord($_POST['polygon'])) {
                                        $model->getDbCriteria()->addBetweenCondition('map_latitude',
                                        $model->getMinLatCoord($_POST['polygon']),
                                        $model->getMaxLatCoord($_POST['polygon']));
                                }
                            }
                            
                            //print_r($_POST);
                            // Search for Realestate Properties
                            /*if ( isset($_POST["Realestates"]["realestateProperties"]) && !empty($_POST["Realestates"]["realestateProperties"])) {

                                if ( !intval($_POST["is_many_properties"]) ) {
                                    $model->getDbCriteria()->with['realestateProperties'] = array(
                                                'select' => false,
                                                'together' => true,
                                                'condition' => 'realestateProperties.property_id IN ('
                                                                .implode(',', $_POST["Realestates"]["realestateProperties"]).')' ,                
                                    );                                

                                }else{
                                    $model->getDbCriteria()->with['realestateProperties'] = array(
                                                'select' => false,
                                                'together' => true,
                                                'condition' => 'realestateProperties.property_id IN ('
                                                              .implode(',', $_POST["Realestates"]["realestateProperties"]).')'
                                                              .' AND ('.'(SELECT COUNT(*) FROM realestate_properties sp '
                                                                        .' WHERE realestateProperties.realestate_id=sp.realestate_id AND sp.property_id IN ('
                                                                            .implode(',', $_POST["Realestates"]["realestateProperties"]).') GROUP BY realestate_id)='
                                                                        .count($_POST["Realestates"]["realestateProperties"]).')',                
                                                );

                                }

                            }*/

                    //endif;               
                            
                    /*/Формируем параметры для разности страниц (нужно еще раз проверить)
                    
                    // Формируем список операций
                       $cr_oper=new CDbCriteria;
                       $cr_oper->compare('id',$_POST['Realestates']['operation_id']);
                       $cr_oper->select='id,title';
                       $model_oper = Operations::model()->findAll($cr_oper);
                       if ($model_oper) $oper_onreq = mb_strtolower(implode(',',CHtml::listData($model_oper,'id','title')),'UTF-8');
                            
                    // Формируем список операций
                       $cr_dist=new CDbCriteria;
                       $cr_dist->compare('id',$_POST['Realestates']['district_id']);
                       $cr_dist->compare('id',$_POST['district_id']);
                       $cr_dist->select='id,abbr';
                       $model_dist = Districts::model()->findAll($cr_dist);
                       if ($model_dist) $dist_onreq = mb_strtolower(implode(',',CHtml::listData($model_dist,'id','abbr')),'UTF-8');
                       
                   // Формируем список добораться пешком
                       $cr_unit=new CDbCriteria;
                       $cr_unit->compare('id',$_POST['Realestates']['unit_id']);
                       $cr_unit->compare('id',$_POST['unit_id']);
                       $cr_unit->select='id,abbr';
                       $model_unit = Units::model()->findAll($cr_unit);
                       if ($model_unit) $unit_onreq = 'от 0 до '.$_POST['remoteness-to'].' '.mb_strtolower(implode(',',CHtml::listData($model_unit,'id','abbr')),'UTF-8');
                   
                   // Формируем список обьектов
                       $cr_vid=new CDbCriteria;
                       $cr_vid->compare('id',$_POST['Realestates']['realestate_vid_id']);
                       $cr_vid->compare('id',$_POST['realestate_vid_id']);
                       $cr_vid->select='id,abbr';
                       $model_vid = RealestateVids::model()->findAll($cr_vid);
                       if ($model_vid) $vid_onreq = mb_strtolower(implode(',',CHtml::listData($model_vid,'id','abbr')),'UTF-8');
                   
                   // Формируем список классов
                       $cr_class=new CDbCriteria;
                       $cr_class->compare('id',$_POST['Realestates']['realestate_class_id']);
                       $cr_class->compare('id',$_POST['realestate_class_id']);
                       $cr_class->select='id,abbr';
                       $model_class = RealestateClasses::model()->findAll($cr_class);
                       if ($model_class) $class_onreq = mb_strtolower(implode(',',CHtml::listData($model_class,'id','abbr')),'UTF-8');
                   
                   // Формируем площадь от и до                         
                       $area_onreq = ($_POST['area-from']<>'' ? ' от '.$_POST['area-from'] : '')
                                    .($_POST['area-to']<>'' ? ' до '.$_POST['area-to'] : '');
                   // Формируем стоимость от и до                  
                       $cr_valute=new CDbCriteria;
                       $cr_valute->compare('id',$_POST['valute']);                       
                       $cr_valute->select='id,abbr';
                       $model_valute = Valutes::model()->findAll($cr_class);
                       if ($model_valute) $valute_onreq = mb_strtolower(implode(',',CHtml::listData($model_valute,'id','abbr')),'UTF-8');

                       $price_onreg = ($_POST['price-from']<>'' ? ' от '.$_POST['price-from'] : '')
                                    .($_POST['price-to']<>'' ? ' до '.$_POST['price-to'] : '')
                                    .($valute_onreq ? $valute_onreq : '');
                   
                   // Внутренний nid 
                      $nid_onreq = ($_POST['Realestates']['nid']<>'' ? $_POST['Realestates']['nid'] : null);
                   
                   // Заголовок недвижимости title
                      $name_onreq = ($_POST['Realestates']['title']<>'' ? $_POST['Realestates']['title'] : null);                     
                   
                   // Формируем метро
                      $cr_metro=new CDbCriteria;
                      $cr_metro->compare('mapid',$_POST['valute']);                       
                      $cr_metro->select='id,title,mapid';
                      $model_metro = Metros::model()->findAll($cr_metro);
                      if ($model_metro) $metro_onreq = mb_strtolower(implode(',',CHtml::listData($model_metro,'id','title')),'UTF-8');                                                               
                   
                   // Добираться от метро 
                      $remoteness_onreq = ($_POST['Realestates']['remoteness']<>'' ? $_POST['Realestates']['remoteness'] : null);
                      if ($remoteness_onreq) {
                         $cr_unit=new CDbCriteria;
                         $cr_unit->compare('id',$_POST['Realestates']['unit_id']);
                         $cr_unit->compare('id',$_POST['unit_id']);
                         $cr_unit->select='id,abbr';
                         $model_unit = Units::model()->findAll($cr_unit);
                         if ($model_unit) $unit_onreq = $remoteness.' '.mb_strtolower(implode(',',CHtml::listData($model_unit,'id','abbr')),'UTF-8');
                      }
                   // Формируем площадь
                      $area_onreq = ($_POST['Realestates']['area']<>'' ? $_POST['Realestates']['area'] : null);
                   
                   // Формируем цену
                      $price_onreq = ($_POST['Realestates']['price']<>'' ? $_POST['Realestates']['price'] : null); 

                   // Формируем цену с валютой                      
                      $cr_valute=new CDbCriteria;
                      $cr_valute->compare('id',$_POST['Realestates']['valute_id']);                       
                      $cr_valute->select='id,abbr';
                      $model_valute = Valutes::model()->findAll($cr_class);
                      if ($model_valute) $valute_onreq = mb_strtolower(implode(',',CHtml::listData($model_valute,'id','abbr')),'UTF-8');
                      $price_onreq = $price_onreq.' '.$valute_onreq; 
                   
                      echo $title_onreq = ' операция - '.$oper_onreq.
                                           ' / '.' район - '.$dist_onreq.
                                           ' / '.' объект - '.$vid_onreq.
                                           ' / '.' добираться - '.$unit_onreq.
                                           ' / '.' класс - '.$class_onreq.
                                           ' / '.' площадь - '.$area_onreq.
                                           ' / '.' оплата - '.$price_onreq.
                                           ' / '.' внутренний ид - '.$nid_onreq.
                                           ' / '.' заголовок - '.$name_onreq.
                                           ' / '.' метро - '.$metro_onreq ;    
                      echo $desc_onreq = ' по запросу:'.$title_onreq;
                      echo $akeywords_onreq = array();
                                                            
                      // @TODO Добавка к заголовку при пагинации                      
                      //$title_onreq = ($title_onreq<>'' ? ( trim($_GET['Realestates_page'])<>'' ? $title_onreq.' стр.'.$_GET['Realestates_page'] : '');                                                      
                      //$title_onreq = ($title_onreq<>'' ? '('.$title_onreq.')' : null);
                    
                      // @TODO Добавка к описанию при пагинации                      
                      //$desc_onreq = ($desc_onreq<>'' ? ( trim($_GET['Realestates_page'])<>'' ? $desc_onreq.' стр.'.$_GET['Realestates_page'] : '');
                      //$desc_onreq = ($desc_onreq<>'' ? '('.$desc_onreq.')' : null);
                    
                      // @TODO Добавка к ключевым словам при пагинации
                      //if (trim($_GET['page'])<>'') $akeywords_onreq[] = 'далее';                    
                    
                      if ($oper_onreq) { array_merge($akeywords_onreq,array('операция'),explode(',',$oper_onreq)); }
                      if ($dist_onreq) { array_merge($akeywords_onreq,array('район'),explode(',',$dist_onreq)); }
                      if ($vid_onreq) { array_merge($akeywords_onreq,array('объект'),explode(',',$vid_onreq)); }
                      if ($unit_onreq) { array_merge($akeywords_onreq,array('добираться'),explode(',',mb_strtolower(implode(',',CHtml::listData($model_unit,'id','abbr')),'UTF-8')); }
                      if ($class_onreq) { array_merge($akeywords_onreq,array('класс'),explode(',',$class_onreq)); }
                      if ($area_onreq) { array_merge($akeywords_onreq,array('площадь')); }
                      if ($price_onreq) { array_merge($akeywords_onreq,array('оплата')); }
                      if ($nid_onreq) { array_merge($akeywords_onreq,array($nid_onreq)); }
                      if ($name_onreq) { array_merge($akeywords_onreq,array($name_onreq)); }
                      if ($metro_onreq) { array_merge($akeywords_onreq,array('метро'),explode(',',mb_strtolower(implode(',',CHtml::listData($model_metro,'id','title')),'UTF-8'))); }
                   */                               
        
                    
                    $map = $this->_show_map_poligon($model);                                    
                                                        
                    $model_claim=new ClaimSendForm;
                    
                    $this->render( (!$type ? Yii::app()->getController()->getAction()->getId() : $type), 
                                   array( 'metros'=>$metros,                                            
                                          'map'=>$map,
                                          'mets'=>$mets,
                      		  	  'model'=>$model,
                                          'model_claim'=>$model_claim,
                                          //'page_onreg'=>$_GET['Realestates_page'], // открываем в новой версии
                                          //'title_onreg'=>$title_onreg, // открываем в новой версии
                                          //'desc_onreg'=>$desc_onreg, // открываем в новой версии
                                          //'akeywords_onreg'=>akeywords_onreg,
                                  ));
                    
                    //$this->redirect(Yii::app()->user->loginUrl);
               //}
	}
                
        private function getProperty($property,$pid, $is_all=true) {            
            switch ($property) {
                case 'areas':   
                    $area = Areas::model()->findByPk($pid);  
                    $action = array('nameid'=>'areas_id',
                                    'id'=>$area->id,
                                    'title'=>'в районе '.$area->title,
                                    'breadcrumbs'=>'в районе '.$area->title,
                                    'seo_title'=>'в районе '.$area->title,
                                    'seo_description'=>'Коммерческая недвижимость находиться в районе '.$area->title,    
                                    'seo_keywords'=>$area->seo_keywords,//'район '.mb_strtolower($area->title,'UTF-8'),
                                    'anons'=>$area->anons,
                                    'detile'=>$area->detile,
                                    'description'=>$area->description,
                                    'is_all'=>$is_all  
                                   );
                    break;
                case 'vid':   
                    $vid = RealestateVids::model()->findByPk($pid);  
                    $action = array('nameid'=>'realestate_vid_id',
                                    'id'=>$vid->id,
                                    'title'=>$vid->title,
                                    'nameov'=>$vid->nameov,
                                    'namewhats'=>$vid->namewhats,
                                    'namewhat'=>$vid->namewhat,
                                    'abbr'=>$vid->abbr,
                                    'breadcrumbs'=>$vid->title,
                                    'seo_title'=>'вида '.$vid->title,
                                    'seo_description'=>'Коммерческая недвижимость относиться к виду '.mb_strtolower($vid->title,'UTF-8'),    
                                    'seo_keywords'=>$vid->seo_keywords,//'вида '.mb_strtolower($vid->title,'UTF-8').', '.mb_strtolower($vid->title,'UTF-8').', '.mb_strtolower($vid->abbr,'UTF-8'),
                                    'anons'=>$vid->anons,
                                    'detile'=>$vid->detile,
                                    'description'=>$vid->description,
                                    'is_ceil'=>$vid->is_ceil,
                                    'is_all'=>$is_all,
                               );
                    break;   
                case 'type':   
                    $type = RealestateTypes::model()->findByPk($pid);  
                    $action = array('nameid'=>'realestate_type_id',
                                    'id'=>$type->id,
                                    'title'=>$type->title,
                                    'nameed'=>$type->nameed,
                                    'nameov'=>$type->nameov,
                                    'namewheres'=>$type->namewhere,
                                    'namewhere'=>$type->namewhere,
                                    'abbr'=>$type->abbr,
                                    'breadcrumbs'=>$type->title,
                                    'seo_title'=>'типа '.$type->title,
                                    'seo_description'=>'Коммерческая недвижимость относиться к типу '.mb_strtolower($type->title,'UTF-8'),    
                                    'seo_keywords'=>$type->seo_keywords,//'вида '.mb_strtolower($vid->title,'UTF-8').', '.mb_strtolower($vid->title,'UTF-8').', '.mb_strtolower($vid->abbr,'UTF-8'),
                                    'anons'=>$type->anons,
                                    'detile'=>$type->detile,
                                    'description'=>$type->description,
                                    'is_all'=>$is_all
                               );
                    break;         
                default:
                    break;
            }             
            return (object)$action;
        }              
        
        /**
	 * This is the realestates vid action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionVid($id=null)
	{      
            
             if (!empty($id) && !Yii::app()->request->isAjaxRequest) {
                $data=Realestates::model()->exists('realestate_vid_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');                                                                       
                if ($data) {
                    $_GET["Realestates"]["realestate_vid_id"]=$id;
                    $this->actionIndex('vid',Yii::app()->createUrl('realestates/vid',array('id'=>$id))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),(object)array('is_all'=>false));
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {                
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["realestate_vid_id"] && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                    $this->actionIndex('vid',Yii::app()->createUrl('/realestates/vid',array('id'=>$params["realestate_vid_id"]),(object)array('is_all'=>false)));
                }else{
                    $this->actionIndex('vid',Yii::app()->createUrl('/realestates/vid'),(object)array('is_all'=>true));
                }    
            }                                   
	}        
        
        /**
	 * This is the realestates class action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionClass($id=null,$property=null,$pid=null)
	{     
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {                                     
                
                if (!empty($property)&&!empty($pid)) {                                                                                                       
                    $data=Realestates::model()->exists('realestate_class_id='.$id.' AND '.$this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $data=Realestates::model()->exists('realestate_class_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');  
                }
                
                if ($data) {            
                    $_GET["Realestates"]['realestate_class_id']=$id;
                    if (!empty($property)&&!empty($pid)) {  
                        $this->actionIndex('_list_class',Yii::app()->createUrl('realestates/class',
                                        array('id'=>$id,'property'=>$property,'pid'=>$pid))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),
                                        $this->getProperty($property,$pid));                                            
                    }else{
                        if (empty($property)) {
                            $this->actionIndex('class',Yii::app()->createUrl('realestates/class',
                                        array('id'=>$id))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),
                                        $this->getProperty($property,$pid,false)/*,(object)array('is_all'=>false)*/);
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/class/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }    
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                      
            }else{
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["realestate_class_id"] && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     if ($params["realestate_vid_id"] && Yii::app()->getRequest()->getParam('ajax')) {                         
                        $this->actionIndex('_list_class',
                                Yii::app()->createUrl('/ru/realestates/class/'.$params["realestate_class_id"].'/vid/'.$params["realestate_vid_id"])
                                ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                     }else{
                        $this->actionIndex('class',Yii::app()->createUrl('/realestates/class',array('id'=>$params["realestate_class_id"])),(object)array('is_all'=>false));
                     }   
                }else{
                    $this->actionIndex('class',Yii::app()->createUrl('/realestates/class'),(object)array('is_all'=>true));
                }    
            } 
             
            //$_POST['Realestates']['operation_id']=1;                                     
	}          
        
        /** NEW !!!
	 * This is the realestates unit action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionUnit($id=null,$remotenes=null,$vid=null)
	{                
            
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {                      
                if (isset($_GET["property"]) && isset($_GET["pid"]) && $_GET["property"]=='vid' ) $vid = $_GET["pid"];
                              
                if (!empty($vid)) {                      
                    if ( !empty($remotenes) ) {
                        $data=Realestates::model()->exists('unit_id='.$id.' AND '.$this->getProperty('vid',$vid)->nameid.'='.$vid.' AND remoteness='.$remotenes.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');                                                                                                                                                  
                    } else {
                        $data=Realestates::model()->exists('unit_id='.$id.' AND '.$this->getProperty('vid',$vid)->nameid.'='.$vid.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');                                                                                                                                                  
                    }                                                                                                                                                  
                    $_GET["Realestates"][$this->getProperty('vid',$vid)->nameid]=$vid; // Страницы четвертого уровня                    
                }else{
                    if ( !empty($remotenes)) {
                        $data=Realestates::model()->exists('unit_id='.$id.' AND remoteness='.$remotenes.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');                                                                                                                                                  
                    } else {
                        $data=Realestates::model()->exists('unit_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');  
                    }
                }                
                
                if ($data) {     
                    $_GET["Realestates"]['unit_id']=$id;
                    if ( !empty($remotenes) ) {
                        $_GET["Realestates"]["remoteness"]= $remotenes; 
                        //$_GET["remoteness-from"]=$remotenes; // @TODO Старое использование двойных параметров !Возможно поможет в использовании старниц ОТ
                        //$_GET["remoteness-to"]=$remotenes; //@TODO Старое использование двойных параметров !Возможно поможет в использовании старниц ДО
                    }    
                    if ( !empty($vid)) {   
                        $this->actionIndex('_list_unit', 
                                Yii::app()->createUrl('realestates/unit',array('id'=>$id,'remotenes'=>$remotenes,'vid'=>$vid))!=='/'.Yii::app()->request->getPathInfo().'?'.Yii::app()->request->getQueryString() 
                                ? Yii::app()->createUrl('realestates/unit',array('id'=>$id,'remotenes'=>$remotenes,'vid'=>$vid)) 
                                : false
                                ,$this->getProperty('vid',$vid));
                    }else{
                        if (empty($vid)) {                            
                            $this->actionIndex('unit',false,$this->getProperty('vid',$vid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/realestates/unit',array('id'=>$id)), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {    
                if ( !empty($remotenes) ) {                       
                    if (!empty($vid)) {                                                                                                       
                       $_GET["Realestates"][$this->getProperty('vid',$vid)->nameid]=$vid; // Страницы четвертого уровня                    
                       $data=Realestates::model()->exists('remoteness='.$remotenes.' AND '.$this->getProperty('vid',$vid)->nameid.'='.$vid.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');                                                                                                                                                  
                    }else{
                       $data=Realestates::model()->exists('remoteness='.$remotenes.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');                                                                                                                                                                          
                    }
                    if ($data) {                          
                       $_GET["Realestates"]["remoteness"]= $remotenes;  
                       //$_GET["remoteness-from"]=$remotenes; //@TODO Старое использование двойных параметров !Возможно поможет в использовании старниц ОТ
                       //$_GET["remoteness-to"]=$remotenes; //@TODO Старое использование двойных параметров  !Возможно поможет в использовании старниц ДО 
                       if (!empty($vid)) {
                         $this->actionIndex('_list_unit',false,$this->getProperty('vid',$vid));
                       }else{
                         if (empty($id)) {                            
                            $this->actionIndex('unit',false,$this->getProperty('vid',$vid,true));
                         }else{
                            $this->actionIndex('unit',false,$this->getProperty('vid',$vid,false)); 
                            //$this->redirect(Yii::app()->createUrl('/realestates/unit'), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                         }    
                       }
                   }else{
                       Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                       throw new CHttpException(404,'The requested page does not exist.');
                   }                  
                } else {                     
                     $params=Yii::app()->getRequest()->getParam('Realestates');                     
                     if ($params["unit_id"] && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {                        
                        if ( Yii::app()->getRequest()->getParam('remoteness-from') && Yii::app()->getRequest()->getParam('remoteness-to') ) { // @TODO в дальнейшем можно избавиться - Когда существуют параметры границ remoteness старое использование !Возможно поможет в использовании старниц ОТ и ДО
                            if ($params["realestate_vid_id"] && Yii::app()->getRequest()->getParam('ajax')) {                          
                               $this->actionIndex('_list_unit', // @TODO remoteness-from не учитывается
                                       Yii::app()->createUrl('/realestates/unit',array('id'=>$params["unit_id"],'remotenes'=>Yii::app()->getRequest()->getParam('remoteness-to'),'vid'=>$params["realestate_vid_id"]))
                                       ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                            }else{                                
                                $this->actionIndex('unit',Yii::app()->createUrl('/realestates/unit',array('id'=>$params["unit_id"],'remotenes'=>Yii::app()->getRequest()->getParam('remoteness-to'))),(object)array('is_all'=>false));
                            }                      
                       } else {     
                           if ($params['remoteness']) { 
                               if ($params["realestate_vid_id"] && Yii::app()->getRequest()->getParam('ajax')) {                          
                                    $this->actionIndex('_list_unit', // @TODO remoteness-from не учитывается
                                            Yii::app()->createUrl('/realestates/unit',array('id'=>$params["unit_id"],'remotenes'=>$params['remoteness'],'vid'=>$params["realestate_vid_id"]))
                                            ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                               }else{                                
                                    $this->actionIndex('unit',Yii::app()->createUrl('/realestates/unit',array('id'=>$params["unit_id"],'remotenes'=>$params['remoteness'])),(object)array('is_all'=>false));
                               }                                 
                           } else {
                               $this->actionIndex('unit',Yii::app()->createUrl('/realestates/unit',array('id'=>$params["unit_id"])),(object)array('is_all'=>false));
                           }
                       }    
                    }else{  
                        if ( Yii::app()->getRequest()->getParam('remoteness-from') && Yii::app()->getRequest()->getParam('remoteness-to') ) { // @TODO в дальнейшем можно избавиться - Когда существуют параметры границ remoteness старое использование !Возможно поможет в использовании старниц ОТ и ДО 
                            if ($params["realestate_vid_id"] && Yii::app()->getRequest()->getParam('ajax')) {                          
                               $this->actionIndex('_list_unit', // @TODO remoteness-from не учитывается
                                       Yii::app()->createUrl('/realestates/unit',array('remotenes'=>Yii::app()->getRequest()->getParam('remoteness-to'),'vid'=>$params["realestate_vid_id"]))
                                       ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                            }else{                                
                                $this->actionIndex('unit',Yii::app()->createUrl('/realestates/unit',array('remotenes'=>Yii::app()->getRequest()->getParam('remoteness-to'))),(object)array('is_all'=>true));
                            }                      
                       } else {     
                            if ($params['remoteness']) {  
                                if ($params["realestate_vid_id"] && Yii::app()->getRequest()->getParam('ajax')) {                          
                                    $this->actionIndex('_list_unit', // @TODO remoteness-from не учитывается
                                            Yii::app()->createUrl('/realestates/unit',array('remotenes'=>$params['remoteness'],'vid'=>$params["realestate_vid_id"]))
                                            ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                                }else{                                
                                    $this->actionIndex('unit',Yii::app()->createUrl('/realestates/unit',array('remotenes'=>$params['remoteness'])),(object)array('is_all'=>true));
                                }                                     
                            } else {
                                $this->actionIndex('unit',Yii::app()->createUrl('/realestates/unit'),(object)array('is_all'=>true));
                            }
                       }                          
                    }
                }                  
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}    
               
        /** New !!!
	 * This is the realestates entrance on/of action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionEntrance($type=null)
	{   
           if (!($type===null) && !Yii::app()->request->isAjaxRequest ) { 
            if (strval($type)==='0' || strval($type)==='1') {   
               if ($type) {
                   $_GET["Realestates"]["is_separate_entrance"]=1;
                   $this->actionIndex('entrance',Yii::app()->createUrl('/realestates/entranceon'),(object)array('is_all'=>false));               
               }else{                   
                   $_GET["Realestates"]["is_separate_entrance"]=0;
                   $this->actionIndex('entrance',Yii::app()->createUrl('/realestates/entranceoff'),(object)array('is_all'=>false));               
               }  
            }else{              
               Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
               throw new CHttpException(404,'The requested page does not exist.');    
            }                   
           }else{
               $params=Yii::app()->getRequest()->getParam('Realestates'); 
               if (isset($params['is_separate_entrance']) && (!empty($type) || Yii::app()->getRequest()->getParam('ajax'))) {
                    if ($params['is_separate_entrance']) {    
                        $this->actionIndex('entrance',Yii::app()->createUrl('/realestates/entranceon'),(object)array('is_all'=>false));               
                    }else{
                        $this->actionIndex('entrance',Yii::app()->createUrl('/realestates/entranceoff'),(object)array('is_all'=>false));               
                    } 
               }else{
                    $this->actionIndex('entrance',Yii::app()->createUrl('/realestates/entrance'),(object)array('is_all'=>true));               
               }    
           }
	}  
               
        /**
	 * This is the realestates property action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionProperty($id=null,$property=null,$pid=null)
	{     
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) { 
                                
                if (!empty($property)&&!empty($pid)) {         
                    $data=Realestates::model()->with('realestatesProperties')->findAll(array('condition'=>'realestatesProperties.id='.$id.' AND t.'.$this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'));                       
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $data=Realestates::model()->with('realestatesProperties')->findAll(array('condition'=>'realestatesProperties.id='.$id.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'));   
                }                    
                
                if ($data) {            
                    $_GET["Realestates"]['realestatesProperties']=$id;
                    if (!empty($property)&&!empty($pid)) {  
                        $this->actionIndex('_list_property',Yii::app()->createUrl('realestates/property',
                                        array('id'=>$id,'property'=>$property,'pid'=>$pid))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),
                                            $this->getProperty($property,$pid));                                            
                    }else{
                        if (empty($property)) {                            
                            $this->actionIndex('property',Yii::app()->createUrl('realestates/property',
                                        array('id'=>$id))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),$this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/property/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }                      
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                      
            }else{
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["realestatesProperties"] && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     if ($params["realestate_vid_id"] && Yii::app()->getRequest()->getParam('ajax')) {                          
                        $this->actionIndex('_list_property',
                                Yii::app()->createUrl('/ru/realestates/property/'.$params["realestatesProperties"].'/vid/'.$params["realestate_vid_id"])
                                ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                     }else{
                        $this->actionIndex('property',Yii::app()->createUrl('/realestates/property',array('id'=>$params["realestatesProperties"])),(object)array('is_all'=>false));
                     }  
                }else{
                    //$_POST["Realestates"]["realestatesProperties"]='all';
                    $this->actionIndex('property',Yii::app()->createUrl('/realestates/property'),(object)array('is_all'=>true));
                }    
            }              
            //$_POST['Realestates']['operation_id']=1;                                     
	}    
        
        /**
	 * This is the realestates parking action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionParking($id=null)
	{     
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {   
                
                $data=Realestates::model()->exists('parking_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');                                                                                                                                                  
                if ($data) {             
                    $_GET["Realestates"]['parking_id']=$id;
                    $this->actionIndex('parking',false,(object)array('is_all'=>false));
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["parking_id"] && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                    $this->actionIndex('parking',Yii::app()->createUrl('/realestates/parking',array('id'=>$params["parking_id"])),(object)array('is_all'=>false));
                }else{
                    $this->actionIndex('parking',Yii::app()->createUrl('/realestates/parking'),(object)array('is_all'=>true));
                }    
            }
            
            //$_POST['Realestates']['operation_id']=1;                                      
	}             

        /**
	 * This is the realestates valute action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionValute($id=null)
	{     
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {   
                
                $data=Realestates::model()->exists('valute_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');                                                                                                                                                  
                if ($data) {            
                    $_GET["Realestates"]['valute_id']=$id;
                    $this->actionIndex('valute',false,(object)array('is_all'=>false));
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }      
            }else{
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["valute_id"]&& (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                    $this->actionIndex('valute',Yii::app()->createUrl('/realestates/valute',array('id'=>$params["valute_id"])),(object)array('is_all'=>false));
                }else{
                    $this->actionIndex('valute',Yii::app()->createUrl('/realestates/valute'),(object)array('is_all'=>true));
                }    
            } 
             
            //$_POST['Realestates']['operation_id']=1;                                     
	}       
        
        /**
	 * This is the realestates vid action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionTax($id=null)
	{     
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {   
                
                $data=Realestates::model()->exists('tax_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');                                                                                                                                                  
                if ($data) {             
                    $_GET["Realestates"]['tax_id']=$id;
                    $this->actionIndex('tax',false,(object)array('is_all'=>false));
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["tax_id"] && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                    $this->actionIndex('tax',Yii::app()->createUrl('/realestates/tax',array('id'=>$params["tax_id"])),(object)array('is_all'=>false));
                }else{
                    $this->actionIndex('tax',Yii::app()->createUrl('/realestates/tax'),(object)array('is_all'=>true));
                }    
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}   
        
        /**
	 * This is the realestates planning action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionPlanning($id=null)
	{     
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {
                
                $data=Realestates::model()->exists('planning_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');                                                                                                                                                  
                if ($data) {             
                    $_GET["Realestates"]['planning_id']=$id;
                    $this->actionIndex('planning',false,(object)array('is_all'=>false));
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["planning_id"] && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                    $this->actionIndex('planning',Yii::app()->createUrl('/realestates/planning',array('id'=>$params["planning_id"])),(object)array('is_all'=>false));
                }else{
                    $this->actionIndex('planning',Yii::app()->createUrl('/realestates/planning'),(object)array('is_all'=>true));
                }    
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}   

        /**
	 * This is the realestates operation action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	protected function actionOperation($id=null)
	{     
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) { 
                
                $data=Realestates::model()->exists('operation_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');                                                                                                                                                  
                if ($data) {             
                    $_GET["Realestates"]['operation_id']=$id;
                    $this->actionIndex('operation',false,(object)array('is_all'=>false));
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
                
            } else {
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["operation_id"] && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                    $this->actionIndex('operation',Yii::app()->createUrl('/realestates/operation',array('id'=>$params["operation_id"])),(object)array('is_all'=>false));
                }else{
                    $this->actionIndex('operation',Yii::app()->createUrl('/realestates/operation'),(object)array('is_all'=>true));
                }    
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}    
        
        /**
	 * This is the realestates type action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionType($id=null,$property=null,$pid=null)
	{     
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) { 
                
                if (!empty($property)&&!empty($pid)) {                    
                    $data=Realestates::model()->exists('realestate_type_id='.$id.' AND '.$this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');                      
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $data=Realestates::model()->exists('realestate_type_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');                                                                                                                                                  
                }  
                                
                if ($data) {             
                    $_GET["Realestates"]['realestate_type_id']=$id;
                    if (!empty($property)&&!empty($pid)) { 
                        $this->actionIndex('_list_type',Yii::app()->createUrl('realestates/type',
                                        array('id'=>$id,'property'=>$property,'pid'=>$pid))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),
                                        $this->getProperty($property,$pid));                                            
                    }else{
                        if (empty($property)) {
                            $this->actionIndex('type',Yii::app()->createUrl('realestates/taxReference',
                                        array('id'=>$id))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),
                                        $this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/type/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }  
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {                
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["realestate_type_id"]&& (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     if ($params["realestate_vid_id"] && Yii::app()->getRequest()->getParam('ajax')) {                         
                        $this->actionIndex('_list_type',
                                Yii::app()->createUrl('/ru/realestates/type/'.$params["realestate_type_id"].'/vid/'.$params["realestate_vid_id"])
                                ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                     }else{
                        $this->actionIndex('type',Yii::app()->createUrl('/realestates/type',array('id'=>$params["realestate_type_id"])),(object)array('is_all'=>false));
                     }   
                }else{
                    $this->actionIndex('type',Yii::app()->createUrl('/realestates/type'),(object)array('is_all'=>true));
                }   
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}   
        
        /**
	 * This is the realestates stavka to action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionStavkaTo($id=null,$property=null,$pid=null, $valute=2)
	{           
            
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) { 
                
                $offer = FstavkaOffers::model()->findByPk($id);                                
                if (!$offer) { 
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');                     
                }
                if ($valute) {
                    $model = Valutes::model()->findByPk($valute);            
                    Yii::app()->currency->to = $model->title;

                    $curr = Yii::app()->currency->from; // Сохраняем курсы
                    
                    $ainfo_curs = $this->__isCurs();                                        
                    Yii::app()->currency->from =$ainfo_curs;  
                    Yii::app()->currency->timeCacheComp = 0;
                    Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
                    Yii::app()->currency->init();
                    
                    Yii::app()->currency->from=$curr; // Востанавливаем курсы
                    
                }else{
                    $ainfo_curs = null;
                }    

                if (!empty($ainfo_curs)) {

                     $home_sel = "";//IF( v.title='".Yii::app()->currency->to."', t.price,";
                     $end_sel = "";
                     foreach ( $ainfo_curs as $key=>$val) {
                          $home_sel.= "IF( v.title='".$val["name"]."', t.price*".Yii::app()->currency->$val["name"]." ,";// t.price)) as `price`';
                          $end_sel.= ")";
                     }     
                     $home_sel.= " t.price"; 
                     $select = $home_sel.$end_sel;
                     $realestates = new Realestates();
                     //$realestates->valute_id = $valute;
                     $condition = $select.' <= '.intval($offer->final_value);
                     $realestates->getDbCriteria()->addCondition($condition);                                                                        
                     $realestates->getDbCriteria()->join= $realestates->getDbCriteria()->join.' '.' LEFT JOIN valutes v on v.id=t.valute_id ';
 
                } else {
                    
                     $realestates->getDbCriteria()->addCondition('price<='.$offer->final_value);           
                }                   
                
                if (!empty($property)&&!empty($pid)) {
                    
                    $realestates->getDbCriteria()->addCondition($this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
                    $data=$realestates->exists();  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $realestates->getDbCriteria()->addCondition('((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
                    $data=$realestates->exists();
                }
                
                if ($data) {                               
                    $_GET['price-to']=$offer->final_value;
                    $_GET['valute']=$offer->valute_id;                     
                    if (!empty($property)&&!empty($pid)) {
                        $this->actionIndex('_list_stavka_to',false,$this->getProperty($property,$pid));
                    }else{
                       if (empty($property)) {                            
                            $this->actionIndex('stavka_to',false,$this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/stavkaTo/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {
                
                if (Yii::app()->getRequest()->getParam('price-to') && Yii::app()->getRequest()->getParam('valute') && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     
                     $offer = FstavkaOffers::model()->find(array('condition'=>'final_value='.Yii::app()->getRequest()->getParam('price-to').' AND valute_id='.Yii::app()->getRequest()->getParam('valute')));                
                     
                     $params=Yii::app()->getRequest()->getParam('Realestates');
   
                     if ($params['realestate_vid_id'] && Yii::app()->getRequest()->getParam('ajax')) {                         
                        $this->actionIndex('_list_stavka_to',
                                Yii::app()->createUrl('/ru/realestates/stavkaTo/'.$offer->id.'/vid/'.$params['realestate_vid_id'])
                                ,$this->getProperty('vid',$params['realestate_vid_id']));                                          
                     }else{
                        $this->actionIndex('stavka_to',Yii::app()->createUrl('/realestates/stavkaTo',array('id'=>$offer->id)),(object)array('is_all'=>false));                    
                     }                                           
                }    else{                    
                    $this->actionIndex('stavka_to',Yii::app()->createUrl('/realestates/stavkaTo'),(object)array('is_all'=>true));                    
                }                
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}        
        
        /**
	 * This is the realestates stavka from action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionStavkaFrom($id=null,$property=null,$pid=null, $valute=2)
	{           
            
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {  
                
                $offer = FstavkaOffers::model()->findByPk($id);                                
                if (!$offer) { 
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');                     
                }
                if ($valute) {
                    $model = Valutes::model()->findByPk($valute);            
                    Yii::app()->currency->to = $model->title;

                    $curr = Yii::app()->currency->from; // Сохраняем курсы
                    
                    $ainfo_curs = $this->__isCurs();                                        
                    Yii::app()->currency->from =$ainfo_curs;  
                    Yii::app()->currency->timeCacheComp = 0;
                    Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
                    Yii::app()->currency->init();
                    
                    Yii::app()->currency->from=$curr; // Востанавливаем курсы
                    
                }else{
                    $ainfo_curs = null;
                }    

                if (!empty($ainfo_curs)) {
                     $home_sel = "";//IF( v.title='".Yii::app()->currency->to."', t.price,";
                     $end_sel = "";
                     foreach ( $ainfo_curs as $key=>$val) {
                          $home_sel.= "IF( v.title='".$val["name"]."', t.price*".Yii::app()->currency->$val["name"]." ,";// t.price)) as `price`';
                          $end_sel.= ")";
                     }     
                     $home_sel.= " t.price"; 
                     $select = $home_sel.$end_sel;
                     $realestates = new Realestates();
                     //$realestates->valute_id = $valute;
                     $condition = $select.'>='.intval($offer->init_value);
                     $realestates->getDbCriteria()->addCondition($condition);                                                                        
                     $realestates->getDbCriteria()->join= $realestates->getDbCriteria()->join.' '.' LEFT JOIN valutes v on v.id=t.valute_id ';

                } else {
                        $realestates->getDbCriteria()->addCondition('price>='.$offer->init_valute);        
                }                   
                
                if (!empty($property)&&!empty($pid)) {      
                    
                    $realestates->getDbCriteria()->addCondition($this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
                    $data=$realestates->exists();  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $realestates->getDbCriteria()->addCondition('((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
                    $data=$realestates->exists();
                }
                
                if ($data) {                               
                    $_GET['price-from']=$offer->init_value;
                    $_GET['valute']=$offer->valute_id;                     
                    if (!empty($property)&&!empty($pid)) { 
                        $this->actionIndex('_list_stavka_from',false,$this->getProperty($property,$pid));
                    }else{
                       if (empty($property)) {                            
                            $this->actionIndex('stavka_from',false,$this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/stavkaFrom/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {
                
                if ( Yii::app()->getRequest()->getParam('price-from')!==null && Yii::app()->getRequest()->getParam('valute') && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     
                     $offer = FstavkaOffers::model()->find(array('condition'=>'init_value='.Yii::app()->getRequest()->getParam('price-from').' AND valute_id='.Yii::app()->getRequest()->getParam('valute')));                
                     
                     $params=Yii::app()->getRequest()->getParam('Realestates');
   
                     if ($params['realestate_vid_id']  && Yii::app()->getRequest()->getParam('ajax')) {                         
                        $this->actionIndex('_list_stavka_from',
                                Yii::app()->createUrl('/ru/realestates/stavkaFrom/'.$offer->id.'/vid/'.$params['realestate_vid_id'])
                                ,$this->getProperty('vid',$params['realestate_vid_id']));                                          
                     }else{
                        $this->actionIndex('stavka_from',Yii::app()->createUrl('/realestates/stavkaFrom',array('id'=>$offer->id)),(object)array('is_all'=>false));                    
                     }                                           
                } else{                    
                    $this->actionIndex('stavka_from',Yii::app()->createUrl('/realestates/stavkaFrom'),(object)array('is_all'=>true));                    
                }                
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}     
        
        /**
	 * This is the realestates stavka action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionStavka($id=null,$property=null,$pid=null, $valute=2)
	{           
            
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {    
                $offer = FstavkaOffers::model()->findByPk($id);                                
                if (!$offer) { 
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');                     
                }
                if ($valute) {
                    $model = Valutes::model()->findByPk($valute);            
                    Yii::app()->currency->to = $model->title;

                    $curr = Yii::app()->currency->from; // Сохраняем курсы
                    
                    $ainfo_curs = $this->__isCurs();                                        
                    Yii::app()->currency->from =$ainfo_curs;  
                    Yii::app()->currency->timeCacheComp = 0;
                    Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
                    Yii::app()->currency->init();
                    
                    Yii::app()->currency->from=$curr; // Востанавливаем курсы
                    
                }else{
                    $ainfo_curs = null;
                }    

                if (!empty($ainfo_curs)) {

                     $home_sel = "";//IF( v.title='".Yii::app()->currency->to."', t.price,";
                     $end_sel = "";
                     foreach ( $ainfo_curs as $key=>$val) {
                          $home_sel.= "IF( v.title='".$val["name"]."', t.price*".Yii::app()->currency->$val["name"]." ,";// t.price)) as `price`';
                          $end_sel.= ")";
                     }     
                     $home_sel.= " t.price"; 
                     $select = $home_sel.$end_sel;
                     $realestates = new Realestates();
                     //$realestates->valute_id = $valute;
                     $condition = $select.' BETWEEN '.intval($offer->init_value).' AND '.intval($offer->final_value);
                     $realestates->getDbCriteria()->addCondition($condition);                                                                        
                     $realestates->getDbCriteria()->join= $realestates->getDbCriteria()->join.' '.' LEFT JOIN valutes v on v.id=t.valute_id ';
 
                } else {
                    
                     $realestates->getDbCriteria()->addBetweenCondition('price', $offer->init_valute, $offer->final_value);           
                }                   
                
                if (!empty($property)&&!empty($pid)) {    
                    
                    $realestates->getDbCriteria()->addCondition($this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
                    $data=$realestates->exists();  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $realestates->getDbCriteria()->addCondition('((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
                    $data=$realestates->exists();
                }
                
                if ($data) {                               
                    $_GET['price-from']=$offer->init_value;
                    $_GET['price-to']=$offer->final_value;
                    $_GET['valute']=$offer->valute_id;                     
                    if (!empty($property)&&!empty($pid)) { 
                        $this->actionIndex('_list_stavka',false,$this->getProperty($property,$pid));
                    }else{
                       if (empty($property)) {                            
                            $this->actionIndex('stavka',false,$this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/stavka/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {
                
                if ( Yii::app()->getRequest()->getParam('price-from')!==null && Yii::app()->getRequest()->getParam('price-to') && Yii::app()->getRequest()->getParam('valute') && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     
                     $offer = FstavkaOffers::model()->find(array('condition'=>'init_value='.Yii::app()->getRequest()->getParam('price-from')
                                                                        .' AND final_value='.Yii::app()->getRequest()->getParam('price-to')
                                                                        .' AND valute_id='.Yii::app()->getRequest()->getParam('valute')));                
                     
                     $params=Yii::app()->getRequest()->getParam('Realestates');
   
                     if ($params['realestate_vid_id'] && Yii::app()->getRequest()->getParam('ajax')) {
                        $this->actionIndex('_list_stavka',
                                Yii::app()->createUrl('/ru/realestates/stavka/'.$offer->id.'/vid/'.$params['realestate_vid_id'])
                                ,$this->getProperty('vid',$params['realestate_vid_id']));                                          
                     }else{
                        $this->actionIndex('stavka',Yii::app()->createUrl('/realestates/stavka',array('id'=>$offer->id)),(object)array('is_all'=>false));                    
                     }                                           
                }    else{                    
                    $this->actionIndex('stavka',Yii::app()->createUrl('/realestates/stavka'),(object)array('is_all'=>true));                    
                }                
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}                
        
        /**
	 * This is the realestates vid action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionDestination($id=null,$property=null,$pid=null)
	{     
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {                                     
                
                if (!empty($property)&&!empty($pid)) { 
                    $data=Realestates::model()->with('realestateDestinations')->findAll(array('condition'=>'realestateDestinations.id='.$id.' AND t.'.$this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))'));  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $data=Realestates::model()->with('realestateDestinations')->findAll(array('condition'=>'realestateDestinations.id='.$id));
                }
 
                if ($data) {            
                    $_GET["Realestates"]['realestateDestinations']=$id;
                    if (!empty($property)&&!empty($pid)) {  
                        $this->actionIndex('_list_destination',false,$this->getProperty($property,$pid));                                            
                    }else{
                        if (empty($property)) {                            
                            $this->actionIndex('destination',false,$this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/destination/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }                       
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                      
            }else{
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["realestateDestinations"]&& (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     if ($params["realestate_vid_id"] && Yii::app()->getRequest()->getParam('ajax')) {                         
                        $this->actionIndex('_list_destination',
                                Yii::app()->createUrl('/ru/realestates/destination/'.$params["realestateDestinations"].'/vid/'.$params["realestate_vid_id"])
                                ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                     }else{
                        $this->actionIndex('destination',Yii::app()->createUrl('/realestates/destination',array('id'=>$params["realestateDestinations"])),(object)array('is_all'=>false));
                     }                       
                }else{
                    $this->actionIndex('destination',Yii::app()->createUrl('/realestates/destination'),(object)array('is_all'=>true));
                }
            } 
             
            //$_POST['Realestates']['operation_id']=1;                                     
	}        
        
        /**
	 * This is the realestates cost to action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionCostTo($id=null,$property=null,$pid=null, $valute=2)
	{           
            
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {  
                
                $offer = FcostOffers::model()->findByPk($id);                                
                if (!$offer) { 
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');                     
                }
                if ($valute) {
                    $model = Valutes::model()->findByPk($valute);            
                    Yii::app()->currency->to = $model->title;

                    $curr = Yii::app()->currency->from; // Сохраняем курсы
                    
                    $ainfo_curs = $this->__isCurs();                                        
                    Yii::app()->currency->from =$ainfo_curs;  
                    Yii::app()->currency->timeCacheComp = 0;
                    Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
                    Yii::app()->currency->init();
                    
                    Yii::app()->currency->from=$curr; // Востанавливаем курсы
                    
                }else{
                    $ainfo_curs = null;
                }    

                if (!empty($ainfo_curs)) {
                     $home_sel = "";//IF( v.title='".Yii::app()->currency->to."', t.price,";
                     $end_sel = "";
                     foreach ( $ainfo_curs as $key=>$val) {
                          $home_sel.= "IF( v.title='".$val["name"]."', t.area*t.price*".Yii::app()->currency->$val["name"]."/12 ,";// t.price)) as `price`';
                          $end_sel.= ")";
                     }     
                     $home_sel.= " t.area*t.price/12"; 
                     $select = $home_sel.$end_sel;
                     $realestates = new Realestates();
                     //$realestates->valute_id = $valute;
                     $condition = $select.'<='.intval($offer->final_value);
                     $realestates->getDbCriteria()->addCondition($condition);                                                                        
                     $realestates->getDbCriteria()->join= $realestates->getDbCriteria()->join.' '.' LEFT JOIN valutes v on v.id=t.valute_id ';
                } else {
                     $realestates->getDbCriteria()->addCondition('(area*price/12)<='.$offer->final_value);   
                }                   
                
                if (!empty($property)&&!empty($pid)) {      
                    
                    $realestates->getDbCriteria()->addCondition($this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
                    $data=$realestates->exists();  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $realestates->getDbCriteria()->addCondition('((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
                    $data=$realestates->exists();
                }
                
                if ($data) {                               
                    $_GET['price-to']=$offer->final_value;
                    $_GET['valute']=$offer->valute_id;     
                    $_GET['Realestates']['realestate_price_vid']='mounth';
                    if (!empty($property)&&!empty($pid)) {  
                        $this->actionIndex('_list_cost_to',false,$this->getProperty($property,$pid));
                    }else{
                       if (empty($property)) {                            
                            $this->actionIndex('cost_to',false,$this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/costTo/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {
                
                if ( Yii::app()->getRequest()->getParam('price-to')>0 && Yii::app()->getRequest()->getParam('valute') && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     
                     $offer = FcostOffers::model()->find(array('condition'=>'final_value='.Yii::app()->getRequest()->getParam('price-to').' AND valute_id='.Yii::app()->getRequest()->getParam('valute')));                
                     
                     $params=Yii::app()->getRequest()->getParam('Realestates');
   
                     if ($params['realestate_vid_id']  && Yii::app()->getRequest()->getParam('ajax')) {                                                  
                        $this->actionIndex('_list_cost_to',
                                Yii::app()->createUrl('/ru/realestates/costTo/'.$offer->id.'/vid/'.$params['realestate_vid_id'])
                                ,$this->getProperty('vid',$params['realestate_vid_id']));                                          
                     }else{
                        $this->actionIndex('cost_to',Yii::app()->createUrl('/realestates/costTo',array('id'=>$offer->id)),(object)array('is_all'=>false));                    
                     }                                           
                }    else{                    
                    $this->actionIndex('cost_to',Yii::app()->createUrl('/realestates/costTo'),(object)array('is_all'=>true));                    
                }                
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}  
        
        /**
	 * This is the realestates vid action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionCostFrom($id=null,$property=null,$pid=null, $valute=2)
	{           
            
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {    
                
                $offer = FcostOffers::model()->findByPk($id);                                
                if (!$offer) { 
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');                     
                }
                if ($valute) {
                    $model = Valutes::model()->findByPk($valute);            
                    Yii::app()->currency->to = $model->title;

                    $curr = Yii::app()->currency->from; // Сохраняем курсы
                    
                    $ainfo_curs = $this->__isCurs();                                        
                    Yii::app()->currency->from =$ainfo_curs;  
                    Yii::app()->currency->timeCacheComp = 0;
                    Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
                    Yii::app()->currency->init();
                    
                    Yii::app()->currency->from=$curr; // Востанавливаем курсы
                    
                }else{
                    $ainfo_curs = null;
                }    

                if (!empty($ainfo_curs)) {
                     $home_sel = "";//IF( v.title='".Yii::app()->currency->to."', t.price,";
                     $end_sel = "";
                     foreach ( $ainfo_curs as $key=>$val) {
                          $home_sel.= "IF( v.title='".$val["name"]."', t.area*t.price*".Yii::app()->currency->$val["name"]."/12 ,";// t.price)) as `price`';
                          $end_sel.= ")";
                     }     
                     $home_sel.= " t.area*t.price/12"; 
                     $select = $home_sel.$end_sel;
                     $realestates = new Realestates();
                     //$realestates->valute_id = $valute;
                     $condition = $select.' >= '.intval($offer->init_value);
                     $realestates->getDbCriteria()->addCondition($condition);                                                                        
                     $realestates->getDbCriteria()->join= $realestates->getDbCriteria()->join.' '.' LEFT JOIN valutes v on v.id=t.valute_id ';
                } else {
                     $realestates->getDbCriteria()->addCondition('(area*price/12) >='.$offer->init_valute);   
                }                   
                
                if (!empty($property)&&!empty($pid)) {      
                    
                    $realestates->getDbCriteria()->addCondition($this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
                    $data=$realestates->exists();  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $realestates->getDbCriteria()->addCondition('((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
                    $data=$realestates->exists();
                }
                
                if ($data) {                               
                    
                    $_GET['price-from']=$offer->init_value;
                    $_GET['valute']=$offer->valute_id;     
                    $_GET['Realestates']['realestate_price_vid']='mounth';
                    
                    if (!empty($property)&&!empty($pid)) {
                        $this->actionIndex('_list_cost_from',false,$this->getProperty($property,$pid));
                    }else{
                       if (empty($property)) {                            
                            $this->actionIndex('cost_from',false,$this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/costFrom/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {
                
                if ( Yii::app()->getRequest()->getParam('price-from')>=0  && Yii::app()->getRequest()->getParam('valute') && (!empty($id) || Yii::app()->getRequest()->getParam('ajax')) ) {
                     
                     $offer = FcostOffers::model()->find(array('condition'=>'init_value='.Yii::app()->getRequest()->getParam('price-from').' AND valute_id='.Yii::app()->getRequest()->getParam('valute')));                
                     
                     $params=Yii::app()->getRequest()->getParam('Realestates');
   
                     if ($params['realestate_vid_id'] && Yii::app()->getRequest()->getParam('ajax')) {                      
                        $this->actionIndex('_list_cost_from',
                                Yii::app()->createUrl('/ru/realestates/costFrom/'.$offer->id.'/vid/'.$params['realestate_vid_id'])
                                ,$this->getProperty('vid',$params['realestate_vid_id']));                                          
                     }else{
                        $this->actionIndex('cost_from',Yii::app()->createUrl('/realestates/costFrom',array('id'=>$offer->id)),(object)array('is_all'=>false));                    
                     }                                           
                }    else{                    
                    $this->actionIndex('cost_from',Yii::app()->createUrl('/realestates/costFrom'),(object)array('is_all'=>true));                    
                }                
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}                  

        
        /**
	 * This is the realestates cost action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionCost($id=null,$property=null,$pid=null, $valute=2)
	{           
            
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {    
                
                $offer = FcostOffers::model()->findByPk($id);                                
                if (!$offer) { 
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');                     
                }
                if ($valute) {
                    $model = Valutes::model()->findByPk($valute);            
                    Yii::app()->currency->to = $model->title;

                    $curr = Yii::app()->currency->from; // Сохраняем курсы
                    
                    $ainfo_curs = $this->__isCurs();                                        
                    Yii::app()->currency->from =$ainfo_curs;  
                    Yii::app()->currency->timeCacheComp = 0;
                    Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
                    Yii::app()->currency->init();
                    
                    Yii::app()->currency->from=$curr; // Востанавливаем курсы
                    
                }else{
                    $ainfo_curs = null;
                }    

                if (!empty($ainfo_curs)) {
                     $home_sel = "";//IF( v.title='".Yii::app()->currency->to."', t.price,";
                     $end_sel = "";
                     foreach ( $ainfo_curs as $key=>$val) {
                          $home_sel.= "IF( v.title='".$val["name"]."', t.area*t.price*".Yii::app()->currency->$val["name"]."/12 ,";// t.price)) as `price`';
                          $end_sel.= ")";
                     }     
                     $home_sel.= " t.area*t.price/12"; 
                     $select = $home_sel.$end_sel;
                     $realestates = new Realestates();
                     //$realestates->valute_id = $valute;
                     $condition = $select.' BETWEEN '.intval($offer->init_value).' AND '.intval($offer->final_value);
                     $realestates->getDbCriteria()->addCondition($condition);                                                                        
                     $realestates->getDbCriteria()->join= $realestates->getDbCriteria()->join.' '.' LEFT JOIN valutes v on v.id=t.valute_id ';
                } else {
                     $realestates->getDbCriteria()->addBetweenCondition('area*price/12', $offer->init_valute, $offer->final_value);   
                }                   
                
                if (!empty($property)&&!empty($pid)) {   
                    
                    $realestates->getDbCriteria()->addCondition($this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
                    $data=$realestates->exists();  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $realestates->getDbCriteria()->addCondition('((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
                    $data=$realestates->exists();
                }
                
                if ($data) {     
                    
                    $_GET['price-from']=$offer->init_value;
                    $_GET['price-to']=$offer->final_value;
                    $_GET['valute']=$offer->valute_id;     
                    $_GET['Realestates']['realestate_price_vid']='mounth';
                    if (!empty($property)&&!empty($pid)) { 
                        $this->actionIndex('_list_cost',false,$this->getProperty($property,$pid));
                    }else{
                       if (empty($property)) {                            
                            $this->actionIndex('cost',false,$this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/cost/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {                                
                
                if ( Yii::app()->getRequest()->getParam('price-from')>=0 && Yii::app()->getRequest()->getParam('price-to') && Yii::app()->getRequest()->getParam('valute') 
                        && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     
                     $offer = FcostOffers::model()->find(array('condition'=>'init_value='.Yii::app()->getRequest()->getParam('price-from').' AND final_value='.Yii::app()->getRequest()->getParam('price-to').' AND valute_id='.Yii::app()->getRequest()->getParam('valute') ));                
                     
                     $params=Yii::app()->getRequest()->getParam('Realestates');
   
                     if ($params['realestate_vid_id'] && Yii::app()->getRequest()->getParam('ajax')) {              
                        $this->actionIndex('_list_cost',
                                Yii::app()->createUrl('/ru/realestates/cost/'.$offer->id.'/vid/'.$params['realestate_vid_id'])
                                ,$this->getProperty('vid',$params['realestate_vid_id']));                                          
                     }else{
                        $this->actionIndex('cost',Yii::app()->createUrl('/realestates/cost',array('id'=>$offer->id)),(object)array('is_all'=>false));                    
                     }                                           
                }    else{                    
                    $this->actionIndex('cost',Yii::app()->createUrl('/realestates/cost'),(object)array('is_all'=>true));                    
                }                
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}              
        
        /**
	 * This is the realestates tax reference action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionTaxReference($id=null,$property=null,$pid=null)
	{        
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {             
                
                if (!empty($property)&&!empty($pid)) {        
                    $data=Realestates::model()->exists('number_tax='.$id.' AND '.$this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $data=Realestates::model()->exists('number_tax='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');    
                }                        
                
                if ($data) {
                    $_GET["Realestates"]["number_tax"]=$id;
                    //echo Yii::app()->createUrl('realestates/area',array('id'=>$id,'property'=>$property,'pid'=>$pid)).'!=='.'/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString();
                    if (!empty($property)&&!empty($pid)) {   
                        $this->actionIndex('_list_tax_reference',
                                Yii::app()->createUrl('realestates/taxReference',
                                        array('id'=>$id,'property'=>$property,'pid'=>$pid))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),
                                $this->getProperty($property,$pid));                                            
                    }else{
                        if (empty($property)) {                            
                            $this->actionIndex('tax_reference',Yii::app()->createUrl('realestates/taxReference',
                                        array('id'=>$id))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),
                                        $this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/taxReference/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }  
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                      
            } else {
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["number_tax"] && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     if ($params["realestate_vid_id"] && Yii::app()->getRequest()->getParam('ajax')) {                                                
                        $this->actionIndex('_list_tax_reference',
                                Yii::app()->createUrl('/ru/realestates/taxReference/'.$params["number_tax"].'/vid/'.$params["realestate_vid_id"])
                                ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                     }else{
                        $this->actionIndex('tax_reference',Yii::app()->createUrl('/realestates/taxReference',array('id'=>$params["number_tax"])),(object)array('is_all'=>false));   
                     }                                                        
                }else{
                    $this->actionIndex('tax_reference',Yii::app()->createUrl('/realestates/taxReference'),(object)array('is_all'=>true));                
                }    
            }            
               
	}
        
        /**
	 * This is the realestates street action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionStreet($id=null,$property=null,$pid=null)
	{         
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {           
                
                if (!empty($property)&&!empty($pid)) {       
                    $data=Realestates::model()->exists('street_id='.$id.' AND '.$this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $data=Realestates::model()->exists('street_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');
                } 

                if ($data) {            
                    $_GET["Realestates"]['street_id']=$id;
                    if (!empty($property)&&!empty($pid)) {  
                        $this->actionIndex('_list_street',false,$this->getProperty($property,$pid));                                            
                    }else{
                        if (empty($property)) {
                            $this->actionIndex('street',false,$this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/street/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }    
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                      
            }else{
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["street_id"] && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     if ($params["realestate_vid_id"] && Yii::app()->getRequest()->getParam('ajax')) {                         
                        $this->actionIndex('_list_street',
                                Yii::app()->createUrl('/ru/realestates/street/'.$params["street_id"].'/vid/'.$params["realestate_vid_id"])
                                /*Yii::app()->createUrl('/realestates/metro',
                                array('id'=>$params["metro_id"],'property'=>'vids', 'pid'=>$params["realestate_vid_id"]))*/
                                ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                     }else{
                        $this->actionIndex('street',Yii::app()->createUrl('/realestates/street',array('id'=>$params["street_id"])),(object)array('is_all'=>false));
                     }   
                }else{
                    $this->actionIndex('street',Yii::app()->createUrl('/realestates/street'),(object)array('is_all'=>true));
                }    
            } 
             
            //$_POST['Realestates']['operation_id']=1;                                     
	}      
        
        /**
	 * This is the realestates metro action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionMetro($id=null,$property=null,$pid=null)
	{     
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {                    
                if (!empty($property)&&!empty($pid)) {                                                                                                       
                    $data=Realestates::model()->with('metros')->exists('metros.metro_id='.$id.' AND '.$this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $data=Realestates::model()->with('metros')->exists('metros.metro_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');   
                }      
                
                if ($data) {
                        $_GET["Realestates"]["metro_id"]=$id;
                        if (!empty($property)&&!empty($pid)) {  
                            // Если вылезит для всех там где нет canonical false устраиваем проверку на совподения урл
                            /*echo  Yii::app()->createUrl('realestates/metro',
                                        array('id'=>$id,'property'=>$property,'pid'=>$pid)).":".'/'.Yii::app()->request->getPathInfo().'?'.Yii::app()->request->getQueryString();*/
                            $this->actionIndex('_list_metro',
                                    Yii::app()->createUrl('realestates/metro',
                                        array('id'=>$id,'property'=>$property,'pid'=>$pid))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),
                                    $this->getProperty($property,$pid));
                        }else{   
                            if (empty($property)) {
                                $this->actionIndex('metro',
                                        Yii::app()->createUrl('realestates/metro',array('id'=>$id))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString()                                        
                                        ,$this->getProperty($property,$pid,false));
                            }else{
                                $this->redirect(Yii::app()->createUrl('/ru/realestates/metro/'.$id), true, 301);        
                                //throw new CHttpException(404,'The requested page does not exist.');
                            }  
                            
                        }    
                }else{
                        Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                        throw new CHttpException(404,'The requested page does not exist.');
                        
                }  
            }else{                
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["metro_id"] && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                    if ($params["realestate_vid_id"] && Yii::app()->getRequest()->getParam('ajax')) {                         
                        $this->actionIndex('_list_metro',
                                Yii::app()->createUrl('/ru/realestates/metro/'.$params["metro_id"].'/vid/'.$params["realestate_vid_id"])
                                /*Yii::app()->createUrl('/realestates/metro',
                                array('id'=>$params["metro_id"],'property'=>'vids', 'pid'=>$params["realestate_vid_id"]))*/
                                ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                     }else{
                        $this->actionIndex('metro',Yii::app()->createUrl('/realestates/metro',array('id'=>$params["metro_id"])),(object)array('is_all'=>false));                
                     }                       
                }else{
                    $this->actionIndex('metro',Yii::app()->createUrl('/realestates/metro'),(object)array('is_all'=>true));
                } 
            } 
	}

        /**
	 * This is the realestates district action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionDistrict($id=null,$property=null,$pid=null)
	{                   
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {                                     
                
                //$data=Realestates::model()->exists('district_id='.$id);       
                
                if (!empty($property)&&!empty($pid)) {                                                                                                        
                    $data=Realestates::model()->exists('district_id='.$id.' AND '.$this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $data=Realestates::model()->exists('district_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');  
                }
                
                if ($data) {
                        $_GET["Realestates"]["district_id"]=$id;
                        if (!empty($property)&&!empty($pid)) {   
                            $this->actionIndex('_list_district',Yii::app()->createUrl('realestates/district',
                                        array('id'=>$id,'property'=>$property,'pid'=>$pid))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),
                                    $this->getProperty($property,$pid));
                        }else{
                            if (empty($property)) {
                                $this->actionIndex('district',Yii::app()->createUrl('realestates/district',
                                        array('id'=>$id))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),
                                        $this->getProperty($property,$pid,false)/*,(object)array('is_all'=>false)*/);
                            }else{
                                $this->redirect(Yii::app()->createUrl('/ru/realestates/district/'.$id), true, 301);        
                                //throw new CHttpException(404,'The requested page does not exist.');
                            }  
                        }    
                }else{
                            Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots');              
                            throw new CHttpException(404,'The requested page does not exist.');  
                }                                      
            } else {
                $params=Yii::app()->getRequest()->getParam('Realestates');               
                if ($params["district_id"] && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     if ($params["areas_id"] && Yii::app()->getRequest()->getParam('ajax')) {                         
                        $this->actionIndex('_list_district',Yii::app()->createUrl('/realestates/district',
                                array('id'=>$params["district_id"],'areas_id'=>$params["areas_id"])),$this->getProperty('areas',$params["areas_id"]));                                          
                     } else if ($params["realestate_vid_id"] && Yii::app()->getRequest()->getParam('ajax')) {                         
                        $this->actionIndex('_list_district',
                                Yii::app()->createUrl('/ru/realestates/district/'.$params["district_id"].'/vid/'.$params["realestate_vid_id"])
                                ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                     } else {
                        $this->actionIndex('district',Yii::app()->createUrl('/realestates/district',array('id'=>$params["district_id"])),(object)array('is_all'=>false));                 
                     }     
                }else{
                    $this->actionIndex('district',Yii::app()->createUrl('/realestates/district'),(object)array('is_all'=>true));                
                }    
            }            
               
	}
        
        public function actionCoefficient($id=null,$property=null,$pid=null)
	{     
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {                 
                                   
                if (!empty($property)&&!empty($pid)) {                                                                                                      
                    $data=Realestates::model()->exists('coefficient_corridor='.$id.' AND '.$this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $data=Realestates::model()->exists('coefficient_corridor='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');  
                }
                 
                if ($data) {                              
                    $_GET["Realestates"]['coefficient_corridor']=$id;                                        
                    if (!empty($property)&&!empty($pid)) {    
                        $this->actionIndex('_list_coefficient',
                                Yii::app()->createUrl('realestates/coefficient',
                                                        array('id'=>$id,'property'=>$property,'pid'=>$pid)
                                                      )!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),
                                $this->getProperty($property,$pid));                                            
                    }else{
                        if (empty($property)) {                            
                            $this->actionIndex('coefficient',
                                    Yii::app()->createUrl('realestates/coefficient',array('id'=>$id))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),
                                    $this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/coefficient/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }                      
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["coefficient_corridor"]&& (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     if ($params["realestate_vid_id"] && Yii::app()->getRequest()->getParam('ajax')) {                                                  
                        $this->actionIndex('_list_areas',
                                Yii::app()->createUrl('/ru/realestates/coefficient/'.$params["coefficient_corridor"].'/vid/'.$params["realestate_vid_id"])
                                ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                     }else{
                        $this->actionIndex('coefficient',Yii::app()->createUrl('/realestates/coefficient',array('id'=>$params["coefficient_corridor"])),(object)array('is_all'=>false));
                     }                       
                }else{
                    $this->actionIndex('coefficient',Yii::app()->createUrl('/realestates/coefficient'),(object)array('is_all'=>true));
                }    
            }            
            //$_POST['Realestates']['operation_id']=1;                                      
	}   
        
        /**
	 * This is the realestates vid action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionArea($id=null,$property=null,$pid=null)
	{     
            
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {  
                
                $offer = FareaOffers::model()->findByPk($id);                                
                if (!$offer) { 
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');                     
                }
                    
                if (!empty($property)&&!empty($pid)) {                                                                                                        
                    $data=Realestates::model()->exists('( t.area between '.$offer->init_value.' AND '.$offer->final_value.') AND '.$this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{                    
                    $data=Realestates::model()->exists('( t.area between '.$offer->init_value.' AND '.$offer->final_value.') AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');  
                }
                
                if ($data) {    
                    //echo Yii::app()->createUrl('realestates/area',array('id'=>$id,'property'=>$property,'pid'=>$pid)).'!=='.'/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString();
                    $_GET['area-from']=$offer->init_value;
                    $_GET['area-to']=$offer->final_value;
                    if (!empty($property)&&!empty($pid)) {  
                        $this->actionIndex('_list_area', Yii::app()->createUrl('realestates/area',array('id'=>$id,'property'=>$property,'pid'=>$pid))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),$this->getProperty($property,$pid));
                    }else{
                       if (empty($property)) {                            
                            $this->actionIndex('area', Yii::app()->createUrl('realestates/area',array('id'=>$id))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),$this->getProperty($property,$pid,false)/*,(object)array('is_all'=>false)*/);
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/area/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }
                }else{      
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');                    
                }                
            } else {
                
                if ( Yii::app()->getRequest()->getParam('area-from')&&Yii::app()->getRequest()->getParam('area-to') 
                     && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {

                     $offer = FareaOffers::model()->find(array('condition'=>'init_value='.Yii::app()->getRequest()->getParam('area-from').' AND final_value='.Yii::app()->getRequest()->getParam('area-to')));                
                     $params=Yii::app()->getRequest()->getParam('Realestates');  
                     if ($params['realestate_vid_id'] && Yii::app()->getRequest()->getParam('ajax')) {                        
                        $this->actionIndex('_list_area',
                                Yii::app()->createUrl('/ru/realestates/area/'.$offer->id.'/vid/'.$params['realestate_vid_id'])
                                ,$this->getProperty('vid',$params['realestate_vid_id']));                                          
                     }else{
                        $this->actionIndex('area',Yii::app()->createUrl('/realestates/area',array('id'=>$offer->id),(object)array('is_all'=>false)));                    
                     }                                           
                }    else{                    
                    $this->actionIndex('area',Yii::app()->createUrl('/realestates/area'),(object)array('is_all'=>true));                    
                }                
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}                  
        
        /**
	 * This is the realestates vid action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionAreaFrom($id=null,$property=null,$pid=null)
	{     
            
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) {  
                $offer = FareaOffers::model()->findByPk($id);                                
                if (!$offer) { 
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');                     
                }
                if (!empty($property)&&!empty($pid)) {                                                                                                    
                    $data=Realestates::model()->exists('( t.area>='.$offer->init_value.' ) AND '.$this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $data=Realestates::model()->exists('( t.area>='.$offer->init_value.' ) AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');  
                }
                
                if ($data) {                               
                    $_GET['area-from']=$offer->init_value;                   
                    if (!empty($property)&&!empty($pid)) {  
                        $this->actionIndex('_list_area_from',false,$this->getProperty($property,$pid));
                    }else{
                       if (empty($property)) {                           
                            $this->actionIndex('area_from',false,$this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/areaFrom/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {
                
                if (Yii::app()->getRequest()->getParam('area-from') && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {

                     $offer = FareaOffers::model()->find(array('condition'=>'init_value='.Yii::app()->getRequest()->getParam('area-from')));                
                    
                     $params=Yii::app()->getRequest()->getParam('Realestates');  
                     if ($params['realestate_vid_id'] && Yii::app()->getRequest()->getParam('ajax')) {                             
                        $this->actionIndex('_list_area_from',
                                Yii::app()->createUrl('/ru/realestates/areaFrom/'.$offer->id.'/vid/'.$params['realestate_vid_id'])
                                ,$this->getProperty('vid',$params['realestate_vid_id']));                                          
                     }else{
                        $this->actionIndex('area_from',Yii::app()->createUrl('/realestates/areaFrom',array('id'=>$offer->id)),(object)array('is_all'=>false));                    
                     }                                           
                }    else{                    
                    $this->actionIndex('area_from',Yii::app()->createUrl('/realestates/areaFrom'),(object)array('is_all'=>true));                    
                }                
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}                  
       
        /**
	 * This is the realestates vid action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionAreaTo($id=null,$property=null,$pid=null)
	{     
            
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) { 
                $offer = FareaOffers::model()->findByPk($id);                                
                if (!$offer) { 
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');                     
                }
                if (!empty($property)&&!empty($pid)) {                                                                                                     
                    $data=Realestates::model()->exists('( t.area<='.$offer->final_value.' ) AND '.$this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $data=Realestates::model()->exists('( t.area<='.$offer->final_value.' ) AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');  
                }
                
                if ($data) {                               
                    $_GET['area-to']=$offer->final_value;                   
                    if (!empty($property)&&!empty($pid)) {  
                        $this->actionIndex('_list_area_to',false,$this->getProperty($property,$pid));
                    }else{
                       if (empty($property)) {                            
                            $this->actionIndex('area_to',false,$this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/areaTo/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.');
                }                
            } else {
                
                if (Yii::app()->getRequest()->getParam('area-to') && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {

                     $offer = FareaOffers::model()->find(array('condition'=>'final_value='.Yii::app()->getRequest()->getParam('area-to')));                
                     
                     $params=Yii::app()->getRequest()->getParam('Realestates');  
                     if ($params['realestate_vid_id']  && Yii::app()->getRequest()->getParam('ajax')) {                        
                        $this->actionIndex('_list_area_to',
                                Yii::app()->createUrl('/ru/realestates/areaTo/'.$offer->id.'/vid/'.$params['realestate_vid_id'])
                                ,$this->getProperty('vid',$params['realestate_vid_id']));                                          
                     }else{
                        $this->actionIndex('area_to',Yii::app()->createUrl('/realestates/areaTo',array('id'=>$offer->id)),(object)array('is_all'=>false));                    
                     }                                           
                }    else{                    
                    $this->actionIndex('area_to',Yii::app()->createUrl('/realestates/areaTo'),(object)array('is_all'=>true));                    
                }                
            }
            
            //$_POST['Realestates']['operation_id']=1;              
                        
	}      
        
        /**
	 * This is the realestates areas action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionAreas($id=null,$property=null,$pid=null)
	{                             
            if ( !empty($id) && !Yii::app()->request->isAjaxRequest ) { 
                $data=Realestates::model()->exists('areas_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');  
                
                if (!empty($property)&&!empty($pid)) {                                                                                                         
                    $data=Realestates::model()->exists('areas_id='.$id.' AND '.$this->getProperty($property,$pid)->nameid.'='.$pid.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');  
                    $_GET["Realestates"][$this->getProperty($property,$pid)->nameid]=$pid; // Страницы четвертого уровня                    
                }else{
                    $data=Realestates::model()->exists('areas_id='.$id.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');  
                }
                
                if ($data) {            
                    $_GET["Realestates"]['areas_id']=$id;
                    if (!empty($property)&&!empty($pid)) { 
                        $this->actionIndex('_list_areas',
                                        Yii::app()->createUrl('realestates/areas',
                                        array('id'=>$id,'property'=>$property,'pid'=>$pid))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString(),
                                        $this->getProperty($property,$pid));                                            
                    }else{
                        if (empty($property)) {                            
                            $this->actionIndex( 'areas'
                                               ,Yii::app()->createUrl('realestates/areas',array('id'=>$id))!=='/'.Yii::app()->request->getPathInfo().Yii::app()->request->getQueryString()
                                               ,$this->getProperty($property,$pid,false));
                        }else{
                            $this->redirect(Yii::app()->createUrl('/ru/realestates/areas/'.$id), true, 301);        
                            //throw new CHttpException(404,'The requested page does not exist.');
                        }    
                    }    
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots');
                    throw new CHttpException(404,'The requested page does not exist.');                    
                }                      
            }else{                
                $params=Yii::app()->getRequest()->getParam('Realestates');
                if ($params["areas_id"] && (!empty($id) || Yii::app()->getRequest()->getParam('ajax'))) {
                     if ($params['realestate_vid_id']  && Yii::app()->getRequest()->getParam('ajax')) {                        
                        $this->actionIndex('_list_areas',
                                Yii::app()->createUrl('/ru/realestates/areas/'.$params["areas_id"].'/vid/'.$params["realestate_vid_id"])
                                ,$this->getProperty('vid',$params["realestate_vid_id"]));                                          
                     }else{
                        $this->actionIndex('areas',Yii::app()->createUrl('/realestates/areas',array('id'=>$params["areas_id"])),(object)array('is_all'=>false));
                     }   
                }else{
                    $this->actionIndex('areas',Yii::app()->createUrl('/realestates/areas'),(object)array('is_all'=>true));
                }    
            } 
             
            //$_POST['Realestates']['operation_id']=1;                                     
	}                                                                                                                                                                                              
        
        /**
	 * This is the realestates vid action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionEntranceOn()
	{   
           return $this->actionEntrance(1); 
	}             

        /**
	 * This is the realestates vid action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionEntranceOff()
	{   
           return $this->actionEntrance(0); 
	}                                         
        
        
        public function __isCurs() {
            
            $ainfo_curs = array();
            foreach (Yii::app()->currency->from as $currency)  {
                if ($currency['name']==strtoupper(Yii::app()->currency->to)) {
                   foreach ($currency['curs'] as $key=>$curs) {
                       $ainfo_curs[]=array("name"=>$key, "amount"=>1, "curs"=>$curs);
                   }
                }                    
            }                  
            /*switch ( strtoupper(Yii::app()->currency->to) ) 
            {
               case 'USD':
                  $ainfo_curs[] = array("name"=>"EUR","amount"=>1);                                 
                  $ainfo_curs[] = array("name"=>"RUB","amount"=>1);
                  break;
              case 'EUR':
                  $ainfo_curs[] = array("name"=>"USD","amount"=>1);   
                  $ainfo_curs[] = array("name"=>"RUB","amount"=>1);                              
                  break;
              case 'RUB':                         
                  $ainfo_curs[] = array("name"=>"USD","amount"=>1);  
                  $ainfo_curs[] = array("name"=>"EUR","amount"=>1);                                                  
                  break;
            }*/
            return $ainfo_curs;
        } 
        
        protected function _show_map_poligon($model) {
                                               
            Yii::import('ext.EGMap.*');
            
            Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/polygon/polygon.core.js');            
            
            $gMap = new EGMap();
            $gMap->setWidth(932);
            $gMap->setHeight(420);            
            /*$gMap->setAPIKey('http://pp.rtvs.net', 'ABQIAAAAuKTQCaAmRIZm8fpzMcomXRSjgd74L9WyZO8Sjj0ClzXDGx3dYxQN2iImmF-UZzmvUG1oogyiwpW3eQ');*/
            $gMap->setAPIKey('pegasrealty.ru', 'AIzaSyDu-9PAa4Wjo64NrGGwjuxdIQhxGV1XTw8'); 
            $gMap->zoom = 14;
            $gMap->minZoom = 14;
            $gMap->mapTypeId = EGMap::TYPE_ROADMAP;
            $gMap->mapTypeControlOptions = array(
                    'position'=> EGMapControlPosition::RIGHT_TOP,
                    'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
            );

            /* Setting up an icon for marker.
            //$icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/car.png");
            $icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/realestate.png");
            //$icon = new EGMapMarkerImage("http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png");                                

            $icon->setSize(32, 37);
            $icon->setAnchor(16, 16.5);
            $icon->setOrigin(0, 0);*/
                
                
            $dragevent = new EGMapEvent('dragend', "function (event) {}", false, EGMapEvent::TYPE_EVENT_DEFAULT);
            
            $gMap->setCenter(55.74779594179455,37.626800537109375);
      
            $gMap->addEvent(new EGMapEvent('click',
                             'function (event) {
                                var title ="'.Yii::t("map","Выделенная Вами область").'";
                                var des ="'.Yii::t("map","Кординаты выбранной области записаны</br>Для изменения области выберите отмену.").'";        
                                var nbut ="'.Yii::t('map','Отмена').'";     
                                var creator = new PolygonCreator("polygon",'.$gMap->getJsName().',title,nbut,des);
                                    
                              } 
                            ', false, EGMapEvent::TYPE_EVENT_DEFAULT_ONCE));             

            /*$gMap->addEvent(new EGMapEvent('rightclick',
                             'function (event) {
                                creator.destroy();
                              } 
                            ', false, EGMapEvent::TYPE_EVENT_DEFAULT_ONCE));*/
                        
            // Preparing InfoWindow with information about our marker.
            //$info_window = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>Это твоя область поиска<br/>недвижемости!</div>");

            /*$coords   = array();            
            $coords[] = new EGMapCoord(55.79958279167743, 37.530670166015625);
            $coords[] = new EGMapCoord(55.80267031855561, 37.728424072265625);
            $coords[] = new EGMapCoord(55.70065260176176, 37.711944580078125);
            $coords[] = new EGMapCoord(55.69600909191166, 37.525177001953125);
            $coords[] = new EGMapCoord(55.79958279167743, 37.530670166015625);            
                        
            $polygon = new EGMapPolygon($coords, 
                                        array('title' => Yii::t('realestates', $model->title), 'draggable'=>true),
                                        'polygon', array('dragevent'=>$dragevent));
            
            $polygon->addHtmlInfoWindow($info_window);  
            $gMap->addPolygon($polygon);  */                    
            $gMap->zoom = 11;            
            $gMap->minZoom = 11;   
            $gMap->minZoom = 13;   
            //$gMap->centerOnPolygons();
            //$gMap->zoomOnPolygons(0.1); 
            //$gMap->enableLatLonControl();            
            
            /*foreach ($model as $item) {
                
                // Preparing InfoWindow with information about our marker.
                $info_window_a = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>".$item->title."</div>");
                $marker = new EGMapMarker($item->map_latitude, $item->map_longitude, array('title' => Yii::t('realestates', $item->title),
                                    'icon'=>$icon, 'draggable'=>true), 'marker', array('dragevent'=>$dragevent));
                $marker->addHtmlInfoWindow($info_window_a);
                $gMap->addMarker($marker);                      
            }*/
            
            // Saving coordinates after polygons.
            $gMap->appendMapTo('#mapsearch');                          
            
            return $gMap;

        }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	/*public function actionView($id)
	{   
                $model = $this->loadModel($id);
                if ( $model->act ) {
                    $model->cnt_view = $model->cnt_view+1;
                    $model->update();
                    $model_claim=new ClaimSendForm;
                
                    $this->render('view',array(
                            'model'=>$model,
                            'map'=>$this->_view_map($model),
                            'model_claim'=>$model_claim,
                    ));
                } else { 
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.'); 
                }             
	}*/

        /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	/*public function actionView($id)
	{   
                $model = $this->loadModel($id);
                if ( $model->act ) {
                    $model->cnt_view = $model->cnt_view+1;
                    $model->update();
                    $model_claim=new ClaimSendForm;
                
                    $this->render('views',array(
                            'model'=>$model,
                            'map'=>(trim(strip_tags($model->detile))<>'' ? $this->_view_map($model,310,150) : $this->_view_map($model)),
                            'model_claim'=>$model_claim,
                    ));
                } else { 
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.'); 
                }             
	}*/
        
        /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{   
                //throw new CHttpException(404,'The requested page does not exist.'); 
                if ( strpos(Yii::app()->request->getUrl(),'.html')===false)
                     if (substr(trim(Yii::app()->request->getUrl()),-1)==='/') :
                         $this->redirect(substr(trim(Yii::app()->request->getUrl()),0,-1).'.html', true, 301);        
                     else :            
                         $this->redirect(Yii::app()->request->getUrl().'.html', true, 301);        
                     endif;
            
                if( Yii::app()->getRequest()->getParam('Realestates_page') 
                   || Yii::app()->getRequest()->getParam('page') 
                   || Yii::app()->getRequest()->getParam('pagerado') 
                   || Yii::app()->getRequest()->getParam('title') ){                         
                         $href = Yii::app()->getBaseUrl(true).'/'.Yii::app()->request->getPathInfo();
                         Yii::app()->clientScript->registerLinkTag('canonical', null, $href);
                         unset($href);
                }
                //if ( ( /*isset($_GET['Realestates_page']) ||*/ isset($_GET['page']) || isset($_GET['pagerado']) || isset($_GET['title'])) && !Yii::app()->request->isAjaxRequest ) // Чтобы не было дубляжа страниц
                //{
                    /*/ In new disange
                    // @TODO Добавка к заголовку при пагинации
                    $title_onreq = ( trim($_GET['page'])<>'' ? 'другая арендуемая площадь стр.'.$_GET['page'] : '');
                    $title_onreq = ($title_onreq<>'' ? ( trim($_GET['pagerado'])<>'' ? $title_onreq.' / предложения рядом с зданием стр.'.$_GET['pagerado'] : '') 
                                                     : ( trim($_GET['pagerado'])<>'' ? 'предложения рядом с зданием стр.'.$_GET['pagerado'] : ''));
                    //$title_onreq = ($title_onreq<>'' ? '('.$title_onreq.')' : null);
                    
                    // @TODO Добавка к описанию при пагинации
                    $desc_onreq = ( trim($_GET['page'])<>'' ? 'другая арендуемая площадь стр.'.$_GET['page'] : '');
                    $desc_onreq = ($desc_onreq<>'' ? ( trim($_GET['pagerado'])<>'' ? $desc_onreq.' / предложения рядом с зданием стр.'.$_GET['pagerado'] : '') 
                                                     : ( trim($_GET['pagerado'])<>'' ? 'предложения рядом с зданием стр.'.$_GET['pagerado'] : ''));
                    //$desc_onreq = ($desc_onreq<>'' ? '('.$desc_onreq.')' : null);
                    
                    // @TODO Добавка к ключевым словам при пагинации
                    if (trim($_GET['page'])<>'') $akeywords_onreq[] = 'арендуемая площадь';
                    if (trim($_GET['pagerado'])<>'') $akeywords_onreq[] = 'площадь рядом';*/                                                           
                                        
                //    $this->redirect(array('view','id'=>$id));  //$this->redirect(Yii::app()->homeUrl);                  
                //}
            
                $model = $this->loadModel($id);
                if ( $model->act ) {
                    $model->cnt_view = $model->cnt_view+1;
                    $model->update();
                    $model_claim=new ClaimSendForm;
                
                    //////
                          
                $realestateFotos=array();
                foreach ($model->realestateFotos as $key=>$realestateFoto) {
                    $realestateFotos[] = $realestateFoto->file_id; 
                }    

                if ($model->picOreginal->id || $model->picDetile->id ) {
                    if ($model->picDetile->id) array_unshift($realestateFotos, $model->picDetile->id);
                    else array_unshift($realestateFotos, $model->picOreginal->id);
                }

                if (!empty($realestateFotos)) {
                          $fotos = Files::model()->findAll('id in ('.implode(",",$realestateFotos).')');                          

                          foreach ($fotos as $key=>$foto) {

                          $pic_width  ="450";
                          $pic_height ="";

                          $thumb_width  ="";
                          $thumb_height ="82";

                          $rel = str_replace('_original'.substr($foto->original_name,-4,4),
                                         '_src'.substr($foto->original_name,-4,4),
                                         $foto->original_name); 
                          $src = str_replace('_original'.substr($foto->original_name,-4,4),
                                         '_big'.substr($foto->original_name,-4,4),
                                         $foto->original_name);               


                          $res = str_replace('_original'.substr($foto->original_name,-4,4),
                                             '_'.$pic_width.'x'.$pic_height.substr($foto->original_name,-4,4),
                                                                                   $foto->original_name); 
                          $thumb = str_replace('_original'.substr($foto->original_name,-4,4),
                                             '_'.$thumb_width.'x'.$thumb_height.substr($foto->original_name,-4,4),
                                                                                   $foto->original_name); 

                          $picRes = '/'.$res; 
                          $picRel = '/'.$rel;                           
                          $picSrc = '/'.$src;                          
                          $picThumb = '/'.$thumb;               
                          if( file_exists($src) ) {                  
                              if( !file_exists($res) ) {
                                  $image = Yii::app()->image->load($src);
                                 /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                                  $image->resize($pic_width,null);
                                  $image->save($res); // or $image->save('images/small.jpg');
                              }

                              if( !file_exists($thumb) ) {
                                  $image = Yii::app()->image->load($src);
                                 /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                                  $image->resize(null,$thumb_height,null);
                                  $image->save($thumb); // or $image->save('images/small.jpg');
                              }
                              $afotos[]=array('image_url'=>$picRes,'thumb_url'=>$picThumb, 
                                  'title'=>'Коммерческая недвижимость | '.( $model->district 
                                      ? 'Аренда '.mb_strtolower($model->realestateVid->namewhat,'UTF-8').' '.(mb_strtolower($model->district->title,'UTF-8')=='центр' ? 'в' : 'на').' '.mb_strtolower($model->district->title, 'UTF-8').'е Москвы'
                                      : 'Аренда в Москве')
                                      .' - '.$model->title/*foto->name*/, 'alt'=>'Коммерческая недвижимость | '.( $model->district 
                                      ? 'Аренда '.mb_strtolower($model->realestateVid->namewhat,'UTF-8').' '.(mb_strtolower($model->district->title,'UTF-8')=='центр' ? 'в' : 'на').' '.mb_strtolower($model->district->title, 'UTF-8').'е Москвы'
                                      : 'Аренда коммерческой недвижимости в Москве').$model->title/*$foto->name*/, 'link'=>$picSrc);                                 
                          }                 
                       } 
                    }
                    //////
                    
                    //Yii::app()->clientScript->registerMetaTag('http://pegasrealty.ru'.$afotos[0]['thumb_url'], null, null, array('property'=>"og:image"));
                    //Yii::app()->clientScript->registerMetaTag('http://pegasrealty.ru'.Yii::app()->getUrlManager()->createUrl('realestates/view', array('id'=>$model->id)), null, null, array('property'=>"og:url"));
                    //Yii::app()->clientScript->registerLinkTag('image_src',null,'http://pegasrealty.ru'.$afotos[0]['thumb_url']);

                    
                    
                    $model_fsimilar = FsimilarOffers::model()->find(array('condition'=>$model->area.' BETWEEN t.init_value AND t.final_value'));
                    
                    //$realestatesOthers=$model->with('realestatesSimilarities')->findAll("realestate_linking_id=1");                        
                    $realestatesOthers=$model->realestatesOthers;                    
                    //$realestatesShogpreds=$model->with('realestatesSimilarities')->findAll("realestate_linking_id=1")
                    /*$realestatesShogpreds=$model->realestatesSimilarities;
                    $cnt_shogpregds = count($model->realestatesSimilarities);
                    if ($cnt_shogpregds) {
                        $listShogpreds = array(); 
                        foreach( $realestatesShogpreds as $realestatesShogpred) $listShogpreds[]=$realestatesShogpred->id;
                    }*/                    
                    
                    /*if ($cnt_shogpregds<10) {*/
                        $model_similaroffers = Realestates::model()->findAll(
                                    array( 'condition'=>'(t.del IS NULL OR t.del=0)AND(t.act IS NULL OR t.act=1) AND t.id<>'.$id.' AND t.area BETWEEN '.strval(/*$model_fsimilar->init_value*/$model->area-$model_fsimilar->approx).' AND '.strval(/*$model_fsimilar->init_value*/$model->area+$model_fsimilar->approx)/*.( $cnt_shogpregds ? ' AND (t.id NOT IN ('.implode(',',$listShogpreds).'))' : '')*/,
                                           'order'=>/*'realestatesSimilarities_realestatesSimilarities.realestate_linking_id DESC,*/'t.update_date DESC',
                                           //'with'=>array('realestatesSimilarities'), 
                                           //'together'=>true,
                                           'limit'=>10/*-$cnt_shogpregds,*/
                                           ));                         
                        $realestatesShogpreds=/*new CMap(array_merge_recursive($realestatesShogpreds,*/ $model_similaroffers/*))*/;
                    /*}*/
                        
                    // Недвижимость находящаяся рядом
                    $criteria_rad = new CDbCriteria;
                    
                    // Определение по прямоугольнику
                    //$mpmeters = $this->_mpmeters($model->map_latitude, $model->map_longitude, 500);
                    //print_r($mpmeters);
                    //$criteria_rad->addBetweenCondition('t.map_longitude', $model->map_longitude-$mpmeters['longdiff'],$model->map_longitude+$mpmeters['longdiff']); 
                    //$criteria_rad->addBetweenCondition('t.map_latitude', $model->map_latitude-$mpmeters['latdiff'], $model->map_latitude+$mpmeters['latdiff']);
                    
                    // Определение по окружности
                    $inrealestatesOthers=implode(',',CHtml::listData($model->realestatesOthers,'id','id'));   
                    
                    $criteria_rad->addCondition('(3956*2*ASIN(SQRT(POWER(SIN(('.$model->map_latitude.'-ABS(map_latitude))*PI()/180/2),2)+COS('.$model->map_latitude.'*PI()/180)*COS(ABS(map_latitude)*PI()/180)*
                                                    POWER(SIN(('.$model->map_longitude.' - map_longitude)*PI()/180/2),2) ))*1.609344)<0.5');
                    
                    $criteria_rad->addCondition('(t.del IS NULL OR t.del=0)AND(t.act IS NULL OR t.act=1)AND(t.id<>'.$id.')');
                    if ($model->realestatesOthers) {
                        $criteria_rad->addCondition('(t.id NOT IN ('.$inrealestatesOthers.'))');
                    }
                    //$criteria_rad->limit = 10;
                    $criteria_rad->order = 't.update_date DESC';
                    
                    $realestatesRadOthers = Realestates::model()->findAll($criteria_rad);
                    //Проверка foreach ($realestatesRadOthers as $realestatesRadOther) echo $realestatesRadOther->id;*/                                           
                        
                    $this->render('view_best',array(
                            'model'=>$model,
                            'map'=>(trim(strip_tags($model->detile))<>'' ? $this->_view_map($model,310,150) : $this->_view_map($model)),
                            'realestatesOthers'=>$realestatesOthers,
                            'realestatesRadOthers'=>$realestatesRadOthers,
                            'realestatesShogpreds'=>$realestatesShogpreds,
                            'title_onreq'=>$title_onreq,
                            'desc_onreq'=>$desc_onreq,
                            'akeywords_onreq'=>$akeywords_onreq,
                            'model_claim'=>$model_claim,
                            'afotos'=>$afotos
                    ));
                } else { 
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
                    throw new CHttpException(404,'The requested page does not exist.'); 
                }             
	}

        protected function _mpmeters ($lat,$long,$meters)
        {
            //$lat = 45.815005; 
            //$long = 15.978501;
            //$meters = 500; //Number of meters to calculate coords for north/south/east/west

            $equator_circumference = 6371000; //meters
            $polar_circumference = 6356800; //meters

            $m_per_deg_long = 360 / $polar_circumference;

            $rad_lat = ($lat * M_PI / 180); //convert to radians, cosine takes a radian argument and not a degree argument
            $m_per_deg_lat = 360 / (cos($rad_lat) * $equator_circumference);

            $deg_diff_long = $meters * $m_per_deg_long;  //Number of degrees latitude as you move north/south along the line of longitude
            $deg_diff_lat = $meters * $m_per_deg_lat; //Number of degrees longitude as you move east/west along the line of latitude

            //changing north/south moves along longitude and alters latitudinal coordinates by $meters * meters per degree longitude, moving east/west moves along latitude and changes longitudinal coordinates in much the same way.

            //$coordinates['north']['lat'] = $lat + $deg_diff_long;
            //$coordinates['north']['long'] = $long;
            //$coordinates['south']['lat'] = $lat - $deg_diff_long;
            //$coordinates['south']['long'] = $long;

            //$coordinates['east']['lat'] = $lat;
            //$coordinates['east']['long'] = $long + $deg_diff_lat;  //Might need to swith the long equations for these two depending on whether coordinates are east or west of the prime meridian
            //$coordinates['west']['lat'] = $lat;
            //$coordinates['west']['long'] = $long - $deg_diff_lat;
            return array('latdiff'=>$deg_diff_lat,'longdiff'=>$deg_diff_long);
        }
        /**
         * Delete of the Fav Realestate 
         */
        public function actionFavDelete($id)
        {            
            /*For cache
             * if ( in_array($id, Yii::app()->cache->get("favs")) ) {               
                
                $favs_new=array();
                $favs_old=Yii::app()->cache->get("favs");
                
                foreach($favs_old as $key=>$fav) {
                    if ($fav!==$id) {
                        $favs_new[]=$fav;
                    }
                }                
                
                Yii::app()->cache->set("favs",$favs_new);
            }*/

            if ( isset(Yii::app()->request->cookies['favs']->value) && in_array($id, unserialize(Yii::app()->request->cookies['favs']->value)) ) {               
                
                $favs_new=array();
                $favs_old= unserialize(Yii::app()->request->cookies['favs']->value);
                
                foreach($favs_old as $key=>$fav) {
                    if ($fav!==$id) {
                        $favs_new[]=$fav;
                    }
                }       
                unset(Yii::app()->request->cookies['favs']);
                $cookie = new CHttpCookie('favs', serialize($favs_new));
                $cookie->expire = time()+60*60*24*180;   
                Yii::app()->request->cookies['favs'] = $cookie;
            }

        }
        
        /**
         * Delete of the Fav Realestate 
         */
        public function actionFavAdd($id)
        {
           if( Yii::app()->request->isAjaxRequest ) 
           {  
                 /*For cache
                  * $favs = Yii::app()->cache->get("favs");
                    if (is_array($favs)) {
                        if ( !in_array($id, $favs) ) {                                               
                           array_push($favs, $id);
                           Yii::app()->cache->set("favs",$favs);                 
                        }
                    }else{
                        $favs = array($id);
                        Yii::app()->cache->set("favs",$favs);                 
                    }*/
               
                 if ( isset(Yii::app()->request->cookies['favs']->value) ) 
                {
                     if ( !in_array($id, unserialize(Yii::app()->request->cookies['favs']->value)) ) {     
                        $favs = unserialize(Yii::app()->request->cookies['favs']->value);
                        array_push($favs, $id);
                        unset(Yii::app()->request->cookies['favs']);
                        $cookie = new CHttpCookie('favs', serialize($favs));
                        $cookie->expire = time()+60*60*24*180;                         
                        Yii::app()->request->cookies['favs'] = $cookie;
                     }
                 }else{
                     $favs = array($id);
                     unset(Yii::app()->request->cookies['favs']);
                     $cookie = new CHttpCookie('favs', serialize($favs));
                     $cookie->expire = time()+60*60*24*180;                         
                     Yii::app()->request->cookies['favs'] = $cookie;
                 }


                 $realestate = Realestates::model()->findByPk($id);
                 echo $realestate->nid;
                 Yii::app()->end();
           }
        }
        
        /**
         * Create From Send of the Fav Realestate
         */
        public function actionCreateFavSend($id)
        {
            if( Yii::app()->request->isAjaxRequest ) {  
               echo $id; 
               Yii::app()->end();
            }
        }
        
        /**
         * Send of the Fav Realestate
         */
        public function actionFavSend()
        {
            if( Yii::app()->request->isAjaxRequest ) {  
                $model=new ClaimSendForm;
		if(isset($_POST['ClaimSendForm']))
		{
                        $nid = $_POST['ClaimSendForm']['nid'];
                        
                        $realestate_claim = Realestates::model()->findByPk($nid);
                        $_POST['ClaimSendForm']['nid'] = $realestate_claim->nid;
                        
			$model->attributes=$_POST['ClaimSendForm'];
                        
			if($model->validate())
			{
                                $body = "Прошу Вас рассмотреть заявку на недвижимость №".$model->nid." \r\n";
                                $body.= "\r\n";
                                $body.= "Мои реквезиты \r\n";
                                if (trim($model->fio)<>"") $body.= "Ф.И.О. : ".$model->fio." ;  \r\n";
                                if (trim($model->phone)<>"") $body.= "Телефон: ".$model->phone."; \r\n";
                                if (trim($model->email)<>"") $body.= "E-mail : ".$model->email."; \r\n";
                                if (trim($model->company)<>"") $body.= "Компания арендатора : \r\n";
                                if (trim($model->company)<>"") $body.= $model->company." \r\n";
                                if (trim($model->info)<>"") $body.= "К сведенью владельца: \r\n";
                                if (trim($model->info)<>"") $body.= $model->info." \r\n";                                
                                
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
                                
                                /*$files = array();
                                $pathtofile=$this->actionPdf($nid, 'present_'.$model->nid);
                                $files[$pathtofile] = 'present_'.$model->nid.'.pdf';
                                $mail = new MailHelper;
                                $mail->SendMail($model->email, $model->subject, $body, $files);*/
                                                               
				mail(Yii::app()->params['adminEmail'],iconv('utf-8', 'cp1251',$model->subject),iconv('utf-8', 'cp1251',$body),$headers);
				//Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				//$this->refresh();                                
                                echo $model->nid;
			}
		}                         
                Yii::app()->end();
            }
        }

        /**
         * View Realestate on pdf of the format
         */
        public function actionPdf($id, $filename=null) {
            
            $model = $this->loadModel($id);
            $model_claim=new ClaimSendForm;
                
             
           /*# mPDF
           $mPDF1 = Yii::app()->ePdf->mpdf();*/

           # Вы можете с легкостью переопределить параметры по умолчанию для конструктора            
           $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4', 0, '', 5, 5, 6, 6, 4, 4, 'P');

           # render (полная страница page)
           /*$mPDF1->WriteHTML( $this->render(
                              'view',
                              array( 'model'=>$model,
                                     'map'=>$this->_view_map($model),
                                     'model_claim'=>$model_claim,
                              ))
                            );*/

           /* Загрузить таблицу стилей в документ*/           

           $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') ."/screen.css" );
           $mPDF1->WriteHTML($stylesheet, 1);     

           $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') ."/print.css" );
           $mPDF1->WriteHTML($stylesheet, 1);    

           $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') ."/frontend/form.css" );
           $mPDF1->WriteHTML($stylesheet, 1);                
           
           $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') ."/main.css" );
           $mPDF1->WriteHTML($stylesheet, 1);     
           
           $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') ."/print_pdf.css" );
           $mPDF1->WriteHTML($stylesheet, 1);     
                                  
           # renderPartial (только представление текущего контроллера)
           //$mPDF1->WriteHTML($this->renderPartial('index', array(), true));
           $html = $this->renderPartial(
                                  'view_print', 
                                  array( 'model'=>$model,
                                         'map'=>$this->_view_map($model),
                                         'model_claim'=>$model_claim), 
                                  true);
           $mPDF1->WriteHTML( $html ); 
           # Отрисовка картинки в документе
           //$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

           # Вывод готового PDF
           if ($filename==null) $mPDF1->Output();
           else {
               $pathtofile = Yii::getPathOfAlias('webroot') . '/tmp/files/' . $filename . '.pdf';
               $mPDF1->Output($pathtofile, EYiiPdf::OUTPUT_TO_FILE);
               return $pathtofile; 
           }
           
        
           /*$html2pdf = Yii::app()->ePdf->HTML2PDF();
           $html2pdf->setDefaultFont('Arial');   
           $html = $this->renderPartial(
                                  'view_print', 
                                  array( 'model'=>$model,
                                         'map'=>$this->_view_map($model),
                                         'model_claim'=>$model_claim), 
                                  true);                                 
           $html2pdf->WriteHTML( $html ); 
           $html2pdf->Output();(*/
        }
        
        /**
         * Displays of the Favs realestates
         */
        public function actionFavs()
        {
                
                //$cache=Yii::app()->cache;
                
                $filtersForm=new FiltersForm;                
                
                if (isset($_GET['FiltersForm'])) {                   
                   $filtersForm->filters=$_GET['FiltersForm'];                    
                }

                //$cache->set('favs',array("45","41"));
                
                /*!TODO Заменить данные избранного из кеша */
                /* For cache 
                 * if ( isset($cache["favs"]) && !empty($cache["favs"])) {                                
                 */
                if ( isset(Yii::app()->request->cookies['favs']->value)) 
                {
                    $model = Realestates::model();
                    // $model->getDbCriteria()->addInCondition('id', $cache->get('favs')); for cache
                    $model->getDbCriteria()->addInCondition('id', unserialize(Yii::app()->request->cookies['favs']->value));
                    $rawData=$model->findAll();
                    
                }else{                    
                    $rawData = array();                                
                }
                
                $dataProvider=new CArrayDataProvider( $rawData, array(
                                    'id'=>'id',
                                    'sort'=>array( 'attributes'=>
                                              array( 'nid','title','realestate_vid_id','realestate_class_id',
                                                     'district_id','metro_id','remoteness',
                                                     'area','price','valute_id','fav','realestate_type_id',
                                                     'operation_id' ),
                                                 ),
                                    'pagination'=>array('pageSize'=>10),
                                ));                      
                
                $model = new ClaimSendForm;
                
                $this->render( 'favs', array( 'filtersForm' => $filtersForm,
                                              'dataProvider'=> $dataProvider,
                                              'model'=>$model
                                            )
                             );                
        }
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Realestates::model()->findByPk($id);
		if($model===null) {                    
                        Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
			throw new CHttpException(404,'The requested page does not exist.');
                }                                
                        
		return $model;
	}
        
        protected function _view_map($model, $width=920, $height=460) {
                Yii::import('ext.EGMap.*');
                
                $gMap = new EGMap();
                $gMap->setWidth($width);
                $gMap->setHeight($height);
                /*$gMap->setAPIKey('http://pp.rtvs.net', 'ABQIAAAAuKTQCaAmRIZm8fpzMcomXRSjgd74L9WyZO8Sjj0ClzXDGx3dYxQN2iImmF-UZzmvUG1oogyiwpW3eQ');*/
                $gMap->setAPIKey('pegasrealty.ru', 'AIzaSyDu-9PAa4Wjo64NrGGwjuxdIQhxGV1XTw8');
                $gMap->zoom = 14;/*6;*/
                $gMap->minZoom = 10;
                $gMap->maxZoom = 14;
                $mapTypeControlOptions = array(
                     'position' => EGMapControlPosition::RIGHT_TOP,
                     'style' => EGMap::MAPTYPECONTROL_STYLE_DEFAULT
                 );

                $gMap->mapTypeId = EGMap::TYPE_ROADMAP;
                $gMap->mapTypeControlOptions = $mapTypeControlOptions;

                // Preparing InfoWindow with information about our marker.
                $info_window_a = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>Это твой маркер<br/>недвижемости!</div>");

                // Setting up an icon for marker.
                //$icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/car.png");
                $icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/realestate.png");
                //$icon = new EGMapMarkerImage("http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png");

                $icon->setSize(32, 37);
                $icon->setAnchor(16, 16.5);
                $icon->setOrigin(0, 0);


                // If we have already created marker - show it
                if ( !empty($model->map_latitude) && !empty($model->map_longitude) ) {
                    $marker = new EGMapMarker($model->map_latitude, $model->map_longitude, array('title' => Yii::t('realestates', $model->title),
                                    'icon'=>$icon), 'marker', array());
                    $marker->addHtmlInfoWindow($info_window_a);
                    $gMap->addMarker($marker);
                    $gMap->setCenter($model->map_latitude, $model->map_longitude);
                    $gMap->zoom = 14;
                    $gMap->minZoom = 10;
                    $gMap->maxZoom = 14;
                    //$gMap->enableLatLonControl();

                    // If we don't have marker in database - make sure user can create one
                } else {
                    
                    $gMap->setCenter(55.74779594179455,37.626800537109375);                    

                }

                ob_start();
                    $gMap->renderMap(array(), Yii::app()->language);
                    $map=ob_get_contents();
                ob_end_clean();
                return $map;
        }
        
        protected function _show_map($model) {
                Yii::import('ext.EGMap.*');
                
                $gMap = new EGMap();                
                $gMap->setWidth(704);
                $gMap->setHeight(420);
                /*$gMap->setAPIKey('http://pp.rtvs.net', 'ABQIAAAAuKTQCaAmRIZm8fpzMcomXRSjgd74L9WyZO8Sjj0ClzXDGx3dYxQN2iImmF-UZzmvUG1oogyiwpW3eQ');*/
                $gMap->setAPIKey('pegasrealty.ru', 'AIzaSyDu-9PAa4Wjo64NrGGwjuxdIQhxGV1XTw8');
                $gMap->zoom = 10;/*6;*/
                $gMap->minZoom = 10;
                $mapTypeControlOptions = array(
                     'position' => EGMapControlPosition::RIGHT_TOP,
                     'style' => EGMap::MAPTYPECONTROL_STYLE_DEFAULT
                 );

                $gMap->mapTypeId = EGMap::TYPE_ROADMAP;
                $gMap->mapTypeControlOptions = $mapTypeControlOptions;

                // Preparing InfoWindow with information about our marker.
                $info_window_a = new EGMapInfoWindow("<div class='gmaps-label' style='color: #000;'>Это твой маркер<br/>недвижемости!</div>");

                // Setting up an icon for marker.
                //$icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/car.png");
                $icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/realestate.png");
                //$icon = new EGMapMarkerImage("http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png");                                

                $icon->setSize(32, 37);
                $icon->setAnchor(16, 16.5);
                $icon->setOrigin(0, 0);

                
                // Saving coordinates after user dragged our marker.
                $dragevent = new EGMapEvent('dragend', "function (event) { /*$.ajax({
                     'type':'POST',
                     'url':'".$this->createUrl('catalog/savecoords').'/'.$items->id."',
                     'data':({'lat': event.latLng.lat(), 'lng': event.latLng.lng()}),
                     'cache':false,
                });*/
                $('#Realestates_map_latitude').val(event.latLng.lat());    
                $('#Realestates_map_longitude').val(event.latLng.lng());
                }", false, EGMapEvent::TYPE_EVENT_DEFAULT);

                // If we have already created marker - show it                
                if ( !empty($model->map_latitude) && !empty($model->map_longitude) ) {
                    $marker = new EGMapMarker($model->map_latitude, $model->map_longitude, array('title' => Yii::t('realestates', $model->title),
                                    'icon'=>$icon, 'draggable'=>true), 'marker', array('dragevent'=>$dragevent));
                    $marker->addHtmlInfoWindow($info_window_a);
                    $gMap->addMarker($marker);                                    
                    $gMap->setCenter($model->map_latitude, $model->map_longitude);
                    $gMap->zoom = 10;
                    $gMap->minZoom = 10;
                    $gMap->enableLatLonControl();

                    // If we don't have marker in database - make sure user can create one
                } else {
                    
                    $gMap->setCenter(55.74779594179455,37.626800537109375);                    

                    // Setting up new event for user click on map, so marker will be created on place and respectful event added.
                    $gMap->addEvent(new EGMapEvent('click',
                                           'function (event) {var marker = new google.maps.Marker({position: event.latLng, map: '.$gMap->getJsName().
                                            ', draggable: true, icon: '.$icon->toJs().'}); '.$gMap->getJsName().
                                            '.setCenter(event.latLng); var dragevent = '.$dragevent->toJs('marker').
                                            '; /*$.ajax({'.
                                            '"type":"POST",'.
                                                    '"url":"'.$this->createUrl('catalog/savecoords')."/".$items->id.'",'.
                                                    '"data":({"lat": event.latLng.lat(), "lng": event.latLng.lng()}),'.
                                                    '"cache":false,'.
                                            '});*/ 
                                            $("#Realestates_map_latitude").val(event.latLng.lat());    
                                            $("#Realestates_map_longitude").val(event.latLng.lng());
                                            }', false, EGMapEvent::TYPE_EVENT_DEFAULT_ONCE));
                }

                ob_start();
                    $gMap->renderMap(array(), Yii::app()->language);
                    $map=ob_get_contents();
                ob_end_clean();
                return $map;
        }
        
}
