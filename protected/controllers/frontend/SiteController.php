<?php

class SiteController extends MyController
{       
        public $data;              
        public $layout='//layouts/column1_new';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'MyCCaptchaAction',
                                'backColor'=>0xFFFFFF,
                                'maxLength'=> 4,
                                'minLength'=> 4,
                                'testLimit'=> 2,                                
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),                    
                        'sitemap'=>array(
                                'class'=>'ext.sitemap.ESitemapAction',
                                'importListMethod'=>'getBaseSitePageListMap',
                                'classConfig'=>array(
                                    array('baseModel'=>'Iblocks',
                                          'route'=>'/site/index',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly',
                                          //'priority' => '0.5'
                                         ),                                             
                                    array('baseModel'=>'Realestates',
                                          'route'=>'/realestates/view',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly',
                                          //'priority' => '0.5'
                                    ),
                                    array('baseModel'=>'RealestateClasses',
                                          'route'=>'/realestates/class',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                    
                                    array('baseModel'=>'RealestateVids',
                                          'route'=>'/realestates/vid',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),  
                                    array('baseModel'=>'Districts',
                                          'route'=>'/realestates/district',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ), 
                                    array('baseModel'=>'Areas',
                                          'route'=>'/realestates/areas',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),           
                                    array('baseModel'=>'TaxReference',
                                          'route'=>'/realestates/taxReference',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                     
                                    array('baseModel'=>'Destinations',
                                          'route'=>'/realestates/destination',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),        
                                    array('baseModel'=>'Properties',
                                          'route'=>'/realestates/property',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),         
                                    array('baseModel'=>'RealestateTypes',
                                          'route'=>'/realestates/type',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                       
                                    /*array('baseModel'=>'Operations',
                                          'route'=>'/realestates/operation',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),*/          
                                    array('baseModel'=>'Plannings',
                                          'route'=>'/realestates/planning',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),  
                                    array('baseModel'=>'Taxs',
                                          'route'=>'/realestates/tax',                                        
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),  
                                    /*array('baseModel'=>'Commissions',
                                          'route'=>'/realestates/commission',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),*/  
                                    array('baseModel'=>'Parkings',
                                          'route'=>'/realestates/parking',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                                                      
                                    array('baseModel'=>'Valutes',
                                          'route'=>'/realestates/valute',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),   
                                    array('baseModel'=>'Metros',
                                          'route'=>'/realestates/metro',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),     
                                    array('baseModel'=>'Units',
                                          'route'=>'/realestates/unit',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                      
                                    array('baseModel'=>'Streets',
                                          'route'=>'/realestates/street',
                                          'params'=>array('id'=>'id'),
                                          'link'=>array('text'=>'getLinkMapText','alt'=>'getLinkMapAlt','title'=>'getLinkMapTitle'),
                                          //'link'=>array('text'=>'getLinkMapText'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),  
                                    /*array('baseModel'=>'FareaOffers',
                                          'route'=>'/realestates/area',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),*/                                                                   
                                ),                             
                        ),
                        'sitemapxml'=>array(
                                'class'=>'ext.sitemap.ESitemapXMLAction',
                                //'bypassLogs'=>true, // if using yii debug toolbar enable this line
                                'importListMethod'=>'getBaseSitePageList',
                                'classConfig'=>array(
                                    array('baseModel'=>'Iblocks',
                                          'route'=>'/site/index',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                         ),                                           
                                    array('baseModel'=>'Realestates',
                                          'route'=>'/realestates/view',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),
                                    array('baseModel'=>'RealestateClasses',
                                          'route'=>'/realestates/class',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                    
                                    array('baseModel'=>'RealestateVids',
                                          'route'=>'/realestates/vid',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                      
                                    array('baseModel'=>'Districts',
                                          'route'=>'/realestates/district',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),    
                                    array('baseModel'=>'Areas',
                                          'route'=>'/realestates/areas',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                       
                                    array('baseModel'=>'Destinations',
                                          'route'=>'/realestates/destination',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),          
                                    array('baseModel'=>'Properties',
                                          'route'=>'/realestates/property',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),          
                                    array('baseModel'=>'RealestateTypes',
                                          'route'=>'/realestates/type',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                       
                                    /*array('baseModel'=>'Operations',
                                          'route'=>'/realestates/operation',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),*/          
                                    array('baseModel'=>'Plannings',
                                          'route'=>'/realestates/planning',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                      
                                    array('baseModel'=>'Taxs',
                                          'route'=>'/realestates/tax',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),  
                                    array('baseModel'=>'TaxReference',
                                          'route'=>'/realestates/taxReference',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                      
                                    /*array('baseModel'=>'Commissions',
                                          'route'=>'/realestates/commission',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),*/  
                                    array('baseModel'=>'Parkings',
                                          'route'=>'/realestates/parking',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                      
                                    array('baseModel'=>'Valutes',
                                          'route'=>'/realestates/valute',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),   
                                    array('baseModel'=>'Metros',
                                          'route'=>'/realestates/metro',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),   
                                    array('baseModel'=>'Units',
                                          'route'=>'/realestates/unit',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                      
                                    array('baseModel'=>'Streets',
                                          'route'=>'/realestates/street',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                     
                                    /*array('baseModel'=>'FareaOffers',
                                          'route'=>'/realestates/area',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),*/                                       
                                    /*array('baseModel'=>'Realestates',
                                          'route'=>'/realestates/district',
                                          'params'=>array('id'=>'district_id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                                                                                              
                                    array('baseModel'=>'Realestates',
                                          'route'=>'/realestates/valute',
                                          'params'=>array('id'=>'valute_id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                                                  
                                    array('baseModel'=>'Realestates',
                                          'route'=>'/realestates/street',
                                          'params'=>array('id'=>'street_id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                                                     
                                    array('baseModel'=>'Realestates',
                                          'route'=>'/realestates/metro',
                                          'params'=>array('id'=>'metro_id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),*/                                                                     
                                    array('baseModel'=>'Realestates',
                                          'route'=>'/realestates/pdf',
                                          'params'=>array('id'=>'id'),
                                          'scopeName'=>'sitemap',
                                          'frequency'=>'weekly'
                                    ),                                    
                                ),          
                        )
                 );
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
        
        
        /**
         * Provide the static site pages which are not database generated
         *
         * Each array element represents a page and should be an array of
         * 'loc', 'frequency' and 'priority' keys
         * 
         * @return array[]
         */
        public function getBaseSitePageList() {
            
            /*$list_district_areas = array();            
            
            $districts = Districts::model()->sitemap()->findAll();
            foreach ($districts as $district) {
                $areas = Areas::model()->sitemap()->findAll(array('condition'=>'district_id='.$district->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($areas as $area) {
                    $list_district_areas[] = array(
                        'loc'=> Yii::app()->createUrl('/ru/realestates/district/'.$district->id.'/areas/'.$area->id),//Yii::app()->createUrl('/realestates/district',array('id'=>$district->id, 'property'=>'areas', 'pid'=>$area->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',               
                        'attr'=>array('title'=>Yii::t('menu', $area->title.' район'),'grid'=>intval('17'.str_pad($district->id, '11', '0',STR_PAD_LEFT))),
                        'lid'=>'17'.str_pad($district->id, '11', '0',STR_PAD_LEFT).str_pad($area->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }*/     
            
            /* Виды недвижимости по классам */
            $list_class_vips = array();            
            
            $class = RealestateClasses::model()->sitemap()->findAll();
            foreach ($class as $clas) {                
                $vids = RealestateVids::model()->sitemap_noexrealOv()/*sitemap_noexreal()*/->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.realestate_class_id='.$clas->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.realestate_class_id='.$clas->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($vids as $vid) {
                    $list_class_vips[] = array(
                        'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/class/'.$clas->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/class',array('id'=>$clas->id, 'property'=>'vid', 'pid'=>$vid->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',               
                        'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' класса '.$clas->abbr,
                                      'title'=>$vid->nameov.' класса '.$clas->abbr,
                                      'grid'=>intval('15'.str_pad($clas->id, '11', '0',STR_PAD_LEFT))),
                        'link'=>array('text'  =>$vid->nameov.' класса '.$clas->abbr,
                                      'alt'   =>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' класса '.$clas->abbr,
                                      'title' =>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' класса '.$clas->abbr,
                        ),    
                        'lid'=>'15'.str_pad($clas->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }
            
            /* Виды недвижимости по классам */
            $list_type_vips = array();   
            
            $types = RealestateTypes::model()->sitemap()->findAll();
            foreach ($types as $type) {                
                $vids = RealestateVids::model()->sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.realestate_type_id='.$type->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                                
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.realestate_type_id='.$type->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                                
                foreach($vids as $vid) {
                    if (mb_strtolower(trim($type->title),'UTF-8')!== mb_strtolower(trim($vid->nameov),'UTF-8')) {
                        $list_type_vips[] = array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/type/'.$type->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/type',array('id'=>$type->id, 'property'=>'vid', 'pid'=>$vid->id)),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в '.$type->namewheres.' Москвы',
                                          'title'=>$vid->nameov.' в '.mb_strtolower($type->namewheres,'UTF-8'),
                                          'grid'=>intval('31'.str_pad($type->id, '11', '0',STR_PAD_LEFT))),
                            'link'=>array('text'  =>$vid->nameov.' в '.mb_strtolower($type->namewheres,'UTF-8'),
                                          'alt'   =>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в '.$type->namewheres.' Москвы',   
                                          'title' =>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в '.$type->namewheres.' Москвы',
                            ),                                
                            'lid'=>'31'.str_pad($type->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                        );
                    }
                }
            }
            
            /* Виды недвижимости по районам */
            $list_areas_vips = array();            
            
            $areas = Areas::model()->sitemap()->findAll();
            foreach ($areas as $area) {                
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.areas_id='.$area->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.areas_id='.$area->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($vids as $vid) {
                    $list_areas_vips[] = array(
                        'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/areas/'.$area->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/areas',array('id'=>$area->id, 'property'=>'vid', 'pid'=>$vid->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',               
                        'attr'=>array(//'title'=>"Аренда ".mb_strtolower($vid->namewhats,'UTF-8')." Москвы в районе ".$area->namewhat,
                                      'title'=>$vid->nameov." в районе ".$area->namewhat,
                                        //Yii::t('menu', $vid->title.', район '.$area->title),
                                      'grid'=>intval('38'.str_pad($area->id, '11', '0',STR_PAD_LEFT))),
                        'link'=>array('text' => $vid->nameov." в районе ".$area->namewhat,
                                      'alt' => "Аренда ".mb_strtolower($vid->namewhats,'UTF-8')." Москвы в районе ".$area->namewhat,   
                                      'title' => "Аренда ".mb_strtolower($vid->namewhats,'UTF-8')." Москвы в районе ".$area->namewhat,        
                         ),                               
                        'lid'=>'38'.str_pad($area->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }          
            
            /* Виды недвижимости по районам */
            $list_dests_vips = array();               
            $dests = Destinations::model()->sitemap()->findAll();
            //$dests = Destinations::model()->findAll();
            foreach ($dests as $dest) {    
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.id IN ('.implode(',',CHtml::listData($dest->realestateDestinations, 'realestate_id', 'realestate_id')).')'.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                    
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.id IN ('.implode(',',CHtml::listData($dest->realestateDestinations, 'realestate_id', 'realestate_id')).')'.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                                    
                foreach($vids as $vid) {
                            $list_dests_vips[] = array(
                                'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/destination/'.$dest->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/areas',array('id'=>$dest->id, 'property'=>'vid', 'pid'=>$vid->id)),
                                'frequency'=>'daily',
                                'priority'=>'0.8',               
                                'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' Москвы под '.mb_strtolower($dest->under,'UTF-8'),
                                              'title' => $vid->nameov.' под '.mb_strtolower($dest->under,'UTF-8'),
                                               'grid' =>intval('21'.str_pad($dest->id, '11', '0',STR_PAD_LEFT))),
                                'link'=>array( 'text' => $vid->nameov.' под '.mb_strtolower($dest->under,'UTF-8'),
                                               'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' Москвы под '.mb_strtolower($dest->under,'UTF-8'),   
                                               'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' Москвы под '.mb_strtolower($dest->under,'UTF-8'),        
                                ), 
                                'lid'=>'21'.str_pad($dest->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                            );
                }                                         
            }             
 
            /* Виды недвижимости по налоговым */
            $list_taxrefs_vips = array();            
            
            $taxrefs = TaxReference::model()->sitemap()->findAll();
            //$taxrefs = TaxReference::model()->findAll();
            foreach ($taxrefs as $taxref) {                
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.number_tax='.$taxref->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.number_tax='.$taxref->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($vids as $vid) {
                    $list_taxrefs_vips[] = array(
                        'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/taxReference/'.$taxref->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/taxReference',array('id'=>$taxref->id, 'property'=>'vid', 'pid'=>$vid->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',               
                        'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве, '.$taxref->abbr,
                                      'title'=>$vid->nameov.', '.$taxref->abbr,                                        
                                      'grid'=>intval('39'.str_pad($taxref->id, '11', '0',STR_PAD_LEFT))),
                        'link'=>array( 'text' => $vid->nameov.', '.$taxref->abbr,
                                       'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве, '.$taxref->abbr,
                                       'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве, '.$taxref->abbr,        
                                ),
                        'lid'=>'39'.str_pad($taxref->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }                                                                   
            
            /* Виды недвижимости по метро */
            $list_metro_vips = array();            
            
            $metros = Metros::model()->sitemap()->findAll();
            foreach ($metros as $metro) {                
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.metro_id='.$metro->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.metro_id='.$metro->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($vids as $vid) {
                    $list_metro_vips[] = array(
                        'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/metro/'.$metro->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/metro',array('id'=>$metro->id, 'property'=>'vid', 'pid'=>$vid->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',               
                        'attr'=>array(//'title'=>"Аренда ".mb_strtolower($vid->namewhats,'UTF-8').' рядом с станцией метро '.$metro->title,
                                      'title'=>$vid->nameov.' рядом с станцией метро '.$metro->title,
                                      'grid'=>intval('20'.str_pad($metro->id, '11', '0',STR_PAD_LEFT))),
                        'link'=>array( 'text' => $vid->nameov.' рядом с станцией метро '.$metro->title,
                                        'alt' => "Аренда ".mb_strtolower($vid->namewhats,'UTF-8').' рядом с станцией метро '.$metro->title,
                                      'title' => "Аренда ".mb_strtolower($vid->namewhats,'UTF-8').' рядом с станцией метро '.$metro->title,        
                                ),                        
                        'lid'=>'20'.str_pad($metro->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }
            
            /* Виды недвижимости по улицам */
            $list_street_vips = array();            
            
            $streets = Streets::model()->sitemap()->findAll();
            foreach ($streets as $street) {                
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.street_id='.$street->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.street_id='.$street->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($vids as $vid) {
                    $list_street_vips[] = array(
                        'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/street/'.$street->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/street',array('id'=>$street->id, 'property'=>'vid', 'pid'=>$vid->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',               
                        'attr'=>array( //'title'=>"Аренда ".mb_strtolower($vid->namewhats,'UTF-8')." Москвы, ".$street->getFullName('на')
                                      'title' => $vid->nameov." ".$street->getFullName('на'),
                                       'grid' => intval('19'.str_pad($street->id, '11', '0',STR_PAD_LEFT))),
                        'link'=>array( 'text' => $vid->nameov." ".$street->getFullName('на'),
                                        'alt' => "Аренда ".mb_strtolower($vid->namewhats,'UTF-8')." Москвы, ".$street->getFullName('на'),
                                      'title' => "Аренда ".mb_strtolower($vid->namewhats,'UTF-8')." Москвы, ".$street->getFullName('на'),        
                                ),
                        'lid'=>'19'.str_pad($street->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }       
            
            /* Виды недвижимости по свойствам */
            $list_props_vips = array();            
            
            $props = Properties::model()->sitemap()->findAll();
            foreach ($props as $prop) {    
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.id IN ('.implode(',',CHtml::listData($prop->realestateProperties, 'realestate_id', 'realestate_id')).')'.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                    
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.id IN ('.implode(',',CHtml::listData($prop->realestateProperties, 'realestate_id', 'realestate_id')).')'.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                    
                foreach($vids as $vid) {
                            $list_props_vips[] = array(
                                'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/property/'.$prop->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/property',array('id'=>$dest->id, 'property'=>'vid', 'pid'=>$vid->id)),
                                'frequency'=>'daily',
                                'priority'=>'0.8',               
                                'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве со свойством '.$prop->title,
                                              'title' => $vid->nameov.' со свойством '.$prop->title,  
                                               'grid' => intval('22'.str_pad($prop->id, '11', '0',STR_PAD_LEFT))),
                                'link'=>array( 'text' => $vid->nameov.' со свойством '.$prop->title,
                                               'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве со свойством '.$prop->title,
                                              'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве со свойством '.$prop->title,        
                                ),                                
                                'lid'=>'22'.str_pad($prop->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                            );
                }                                         
            }    
            
            /* Виды недвижимости по улицам */
            $list_district_vips = array();            
            
            $districts = Districts::model()->sitemap()->findAll();
            foreach ($districts as $district) {                
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.district_id='.$district->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.district_id='.$district->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($vids as $vid) {
                    $list_district_vips[] = array(
                        'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/district/'.$district->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/district',array('id'=>$street->id, 'property'=>'vid', 'pid'=>$vid->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',                              
                        'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8')." ".(mb_strtolower($district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($district->title,'UTF-8')."е (".mb_strtolower($district->abbr,'UTF-8').") Москвы",
                                      'title' => $vid->nameov." ".(mb_strtolower($district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($district->title,'UTF-8')."е (".mb_strtolower($district->abbr,'UTF-8').")",
                                       'grid' => intval('17'.str_pad($district->id, '11', '0',STR_PAD_LEFT))),
                        'link'=>array( 'text' => $vid->nameov." ".(mb_strtolower($district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($district->title,'UTF-8')."е (".mb_strtolower($district->abbr,'UTF-8').")",
                                        'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8')." ".(mb_strtolower($district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($district->title,'UTF-8')."е (".mb_strtolower($district->abbr,'UTF-8').") Москвы",
                                      'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8')." ".(mb_strtolower($district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($district->title,'UTF-8')."е (".mb_strtolower($district->abbr,'UTF-8').") Москвы",        
                        ),  
                        'lid'=>'17'.str_pad($district->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }                        
            
            $acoef = array_combine(range(1,26,1),range(5,30,1));//range(5,30,1); 
            
            $list_coefs=array( 
                        // Страница - Каталог недвижимости по корредорным коеффициентам
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/coefficient'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array( 'title'=>Yii::t('menu','Коммерческая недвижимость по коридорным коэффициентам'),'grid'=>null),
                            'link'=>array( 'text' => 'Коммерческая недвижимость по коридорным коэффициентам',
                                           'alt' => 'Аренда коммерческой недвижимости по коридорным коэффициентам в Москве',
                                          'title' => 'Аренда коммерческой недвижимости по коридорным коэффициентам в Москве',        
                            ),   
                            'lid'=>26
                        )
            );        
            foreach ( $acoef as $key=>$coefficient ) {
                $is_corr = Realestates::model()->exists('coefficient_corridor='.$key.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');
                if ($is_corr) {          
                    $list_coefs[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/coefficient',array('id'=>$key)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',               
                                        'attr'=>array(//'title'=> 'Аренда коммерческой недвижимости c коридорным коэффициентом '.$coefficient.'%',                                                            
                                                      'title'=> 'Коммерческая недвижимость с коридорным коэффициентом '.$coefficient.'%',                                                            
                                                      'grid'=>26),
                                        'link'=>array( 'text' => 'Коммерческая недвижимость с коридорным коэффициентом '.$coefficient.'%',
                                                       'alt' => 'Аренда коммерческой недвижимости c коридорным коэффициентом '.$coefficient.'%',
                                                      'title' => 'Аренда коммерческой недвижимости c коридорным коэффициентом '.$coefficient.'%',        
                                        ),                        
                                        'lid'=>'26'.str_pad($key, '11', '0',STR_PAD_LEFT)
                    );
                    $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.coefficient_corridor='.$key));
                    //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.coefficient_corridor='.$coefficient));
                    foreach($vids as $vid) {
                        $list_coefs_vips[] = array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/coefficient/'.$key.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/district',array('id'=>$street->id, 'property'=>'vid', 'pid'=>$vid->id)),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' Москвы c коридорным коэффициентом '.$coefficient.'%',                                                
                                           'title'=> $vid->nameov.' c коридорным коэффициентом '.$coefficient.'%',                                                
                                           'grid' => intval('26'.str_pad($key, '11', '0',STR_PAD_LEFT))),
                            'link'=>array( 'text' => $vid->nameov.' c коридорным коэффициентом '.$coefficient.'%',
                                            'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' Москвы c коридорным коэффициентом '.$coefficient.'%',
                                          'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' Москвы c коридорным коэффициентом '.$coefficient.'%',        
                            ),                            
                            'lid'=>'26'.str_pad($key, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                        );
                   }
                }
            }  
                        
            
            //$fareas = FareaOffers::model()->sitemap()->findAll();
            $fareas = FareaOffers::model()->sitemap_noexreal()->findAll();
            
            /* Виды недвижимости по площади */
            $list_area_vips = array();  
            
            foreach ( $fareas as $key=>$farea ) {                                
               $is_freals = Realestates::model()->exists('((act=1)OR(act is NULL))AND((del=0)OR(del is NULL)) AND (area BETWEEN '.$farea->init_value.' AND '.$farea->final_value.')');
               if ($is_freals) {       
                   // Между
                   $list_fareas[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/area',array('id'=>$farea->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда коммерческой недвижимости'.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',
                                                      'title' => 'Коммерческая недвижимость'.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',                                                        
                                                       'grid' => 35),
                                        'link'=>array( 'text' => 'Коммерческая недвижимость'.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2', 
                                                       'alt' => 'Аренда коммерческой недвижимости'.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',
                                                      'title' => 'Аренда коммерческой недвижимости'.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',        
                                        ),                          
                                        'lid'=>'35'.str_pad($farea->id.'1', '11', '0',STR_PAD_LEFT)
                                    ); 
                    
                    //$vids = RealestateVids::model()->with(array('realestates'=>array('select'=>false)))->findAll(array('select'=>'t.id,t.namewhats','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( realestates.area between '.$farea->init_value.' AND '.$farea->final_value.')'));
                    $vids = RealestateVids::model()->with(array('realestates'=>array('select'=>false)))->findAll(array('select'=>'t.id,t.nameov,t.namewhats','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( realestates.area between '.$farea->init_value.' AND '.$farea->final_value.')'));
                    foreach($vids as $vid) {
                         $list_area_vips[] = array(
                             'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/area/'.$farea->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/areas',array('id'=>$farea->id, 'property'=>'vid', 'pid'=>$vid->id)),
                             'frequency'=>'daily',
                             'priority'=>'0.8',               
                             'attr'=>array( //'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',
                                            'title'=>$vid->nameov.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',
                                            //Yii::t('menu', $vid->title.' с площадью от '.$offer->init_value.' м2 до '.$offer->final_value.' м2'),
                                           'grid'=>intval('35'.str_pad($farea->id.'1', '11', '0',STR_PAD_LEFT))),
                             'link'=>array( 'text' => $vid->nameov.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',
                                             'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',
                                           'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',        
                             ),                             
                             'lid'=>'35'.str_pad($farea->id.'1', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                         );                    
                    }
                    
                    // От               
                    $list_fareas_from[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/areaFrom',array('id'=>$farea->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда коммерческой недвижимости'.' площадью от '.$farea->init_value.' м2',                                                        
                                                      'title'=>'Коммерческая недвижимость'.' площадью от '.$farea->init_value.' м2',                                                        
                                                      'grid'=>35),
                                        'link'=>array(
                                                      'text'=>'Коммерческая недвижимость'.' площадью от '.$farea->init_value.' м2',                                                        
                                                    'title'=>'Аренда коммерческой недвижимости'.' площадью от '.$farea->init_value.' м2',                                                        
                                                    'alt'=>'Аренда коммерческой недвижимости'.' площадью от '.$farea->init_value.' м2',                                                        
                                        ),    
                                        'lid'=>'35'.str_pad($farea->id.'0', '11', '0',STR_PAD_LEFT)); 
                                        
                    //$vidsfrom = RealestateVids::model()->with(array('realestates'=>array('select'=>false)))->findAll(array('select'=>'t.id,t.namewhats','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( realestates.area>='.$farea->init_value.')'));
                    $vidsfrom = RealestateVids::model()->with(array('realestates'=>array('select'=>false)))->findAll(array('select'=>'t.id,t.nameov','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( realestates.area>='.$farea->init_value.')'));
                    foreach($vidsfrom as $vid) {
                        $list_area_fromvips[] = array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/areaFrom/'.$farea->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/areas',array('id'=>$farea->id, 'property'=>'vid', 'pid'=>$vid->id)),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array(//'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью от '.$farea->init_value.' м2',
                                           'title' => $vid->nameov.' площадью от '.$farea->init_value.' м2',
                                            'grid' => intval('35'.str_pad($farea->id.'0', '11', '0',STR_PAD_LEFT))),
                            'link'=>array(  'text' => $vid->nameov.' площадью от '.$farea->init_value.' м2',
                                             'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью от '.$farea->init_value.' м2',
                                           'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью от '.$farea->init_value.' м2',
                            ),                            
                            'lid'=>'35'.str_pad($farea->id.'0', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                        );                    
                    } 
                    //До
                    $list_fareas_to[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/areaTo',array('id'=>$farea->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда коммерческой недвижимости'.' площадью до '.$farea->final_value.' м2',
                                                       'title' => 'Коммерческая недвижимость'.' площадью до '.$farea->final_value.' м2',
                                                        'grid' => 35),
                                        'link'=>array(  'text' => 'Коммерческая недвижимость'.' площадью до '.$farea->final_value.' м2',
                                                         'alt' => 'Аренда коммерческой недвижимости'.' площадью до '.$farea->final_value.' м2',
                                                       'title' => 'Аренда коммерческой недвижимости'.' площадью до '.$farea->final_value.' м2',
                                        ),                         
                                        'lid'=>'35'.str_pad($farea->id.'2', '11', '0',STR_PAD_LEFT));
                    
                    //$vidsto = RealestateVids::model()->with(array('realestates'=>array('select'=>false)))->findAll(array('select'=>'t.id,t.namewhats','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( realestates.area<='.$farea->final_value.')'));
                    $vidsto = RealestateVids::model()->with(array('realestates'=>array('select'=>false)))->findAll(array('select'=>'t.id,t.nameov,t.namewhats','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( realestates.area<='.$farea->final_value.')'));
                    foreach($vidsto as $vid) {
                         $list_area_tovips[] = array(
                             'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/areaTo/'.$farea->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/areas',array('id'=>$farea->id, 'property'=>'vid', 'pid'=>$vid->id)),
                             'frequency'=>'daily',
                             'priority'=>'0.8',               
                             'attr'=>array(//'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью до '.$farea->final_value.' м2',                                               
                                            'title' => $vid->nameov.' площадью до '.$farea->final_value.' м2',                                               
                                             'grid' => intval('35'.str_pad($farea->id.'2', '11', '0',STR_PAD_LEFT))),
                             'link'=>array(  'text' => $vid->nameov.' площадью до '.$farea->final_value.' м2',
                                              'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью до '.$farea->final_value.' м2',
                                            'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью до '.$farea->final_value.' м2',
                             ),                              
                             'lid'=>'35'.str_pad($farea->id.'2', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                         );                    
                    }             
               }                                                
                     
            }      
                                        
            /* Комерческая недвижимость по арендной ставке */
            $list_fstavkas = array();
            
            $fstavkas = FstavkaOffers::model()->sitemap()->findAll(array('condition'=>'t.valute_id=2'));                                          
            //$fstavkas = FstavkaOffers::model()->findAll(array('condition'=>'t.valute_id=2'));                                          
            
            $model = Valutes::model()->findByPk(2);            
            
            Yii::app()->currency->to = $model->title;
            $curr = Yii::app()->currency->from; // Сохраняем курсы
                    
            $ainfo_curs = $this->__isCurs();                                        
            Yii::app()->currency->from =$ainfo_curs;  
            Yii::app()->currency->timeCacheComp = 0;
            Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
            Yii::app()->currency->init();
                    
            Yii::app()->currency->from=$curr; // Востанавливаем курсы                                            
                
            
            /* Виды недвижимости по арендной ставке */
            $list_stavka_vips = array();                                         
            
            foreach ( $fstavkas as $key=>$fstavka ) {                                                           
                
                if (!empty($ainfo_curs)) {
                           //if (stavka) {
                             $home_sel = "";//IF( v.title='".Yii::app()->currency->to."', t.price,";
                             $end_sel = "";
                             foreach ( $ainfo_curs as $akey=>$val) {
                                  $home_sel.= "IF( v.title='".$val["name"]."', t.price*".Yii::app()->currency->$val["name"]." ,";// t.price)) as `price`';
                                  $end_sel.= ")";
                             }     
                             $home_sel.= " t.price"; 
                             $select = $home_sel.$end_sel;                             
                             $realestates = new Realestates();
                             $realestates->valute_id = null;
                             $condition = $select.' BETWEEN '. $fstavka->init_value.' AND '.$fstavka->final_value;
                             $realestates->getDbCriteria()->addCondition($condition);                                                                        
                             $realestates->getDbCriteria()->join= ' LEFT JOIN valutes v on v.id=t.valute_id '; 
               } else {
                             $realestates->getDbCriteria()->addBetweenCondition('price', $fstavka->init_value, $fstavka->final_value);        
               }                  
            
               $is_freals = $realestates->exists('((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
               if ($is_freals) {       
                   // Между
                   $list_fstavkas[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/stavka',array('id'=>$fstavka->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда '.' по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',                                                      
                                                       'title' => 'Комерческая недвижимость по арендной ставка от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',                                                      
                                                        'grid' => 37),
                                        'link'=>array(  'text' => 'Комерческая недвижимость по арендной ставка от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                                                         'alt' => 'Аренда по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                                                       'title' => 'Аренда по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                                        ),
                                        'lid'=>'37'.str_pad($fstavka->id.'1', '11', '0',STR_PAD_LEFT)
                                    );                    
                   //$vids = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false/*,'joinType'=>'LEFT JOIN','condition'=>'v.id=realestates.valute_id'*/,'alias'=>'v')))
                   //       ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).' between '.$fstavka->init_value.' AND '.$fstavka->final_value.')',
                   //                       'select'=>'t.namewhats,t.id'));                        
                   $vids = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false/*,'joinType'=>'LEFT JOIN','condition'=>'v.id=realestates.valute_id'*/,'alias'=>'v')))
                          ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).' between '.$fstavka->init_value.' AND '.$fstavka->final_value.')',
                                          'select'=>'t.nameov,t.namewhats,t.id'));                         
                   foreach($vids as $vid) {
                         $list_stavka_vips[] = array(
                             'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/stavka/'.$fstavka->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/stavka',array('id'=>$fstavka->id, 'property'=>'vid', 'pid'=>$vid->id)),
                             'frequency'=>'daily',
                             'priority'=>'0.8',               
                             'attr'=>array(//'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по './*арендной */'ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                                            'title' => $vid->nameov.' по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',                                                
                                             'grid' => intval('37'.str_pad($fstavka->id.'1', '11', '0',STR_PAD_LEFT))),
                             'link'=>array(  'text' => $vid->nameov.' по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                                              'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                                            'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                             ),                              
                             'lid'=>'37'.str_pad($fstavka->id.'1', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                         );
                   }
                   
                   // От
                   $list_fstavkas_from[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/stavkaFrom',array('id'=>$fstavka->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда '.' по арендной ставке от '.$fstavka->init_value.' руб.',
                                                       'title' => 'Коммерческая недвижимость'.' по арендной ставке от '.$fstavka->init_value.' руб.',
                                                        'grid' => 37),
                                        'link'=>array(  'text' => 'Коммерческая недвижимость'.' по арендной ставке от '.$fstavka->init_value.' руб.',
                                                         'alt' => 'Аренда по арендной ставке от '.$fstavka->init_value.' руб.',
                                                       'title' => 'Аренда по арендной ставке от '.$fstavka->init_value.' руб.',
                                        ),                        
                                        'lid'=>'37'.str_pad($fstavka->id.'0', '11', '0',STR_PAD_LEFT)
                                    );                    
                   //$vidsfrom = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,/*'joinType'=>'LEFT JOIN','condition'=>'v.id=realestates.valute_id',*/'alias'=>'v')))
                   //       ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).' >= '.$fstavka->init_value.')',
                   //                       'select'=>'t.namewhats,t.id'));                        
                   
                   $vidsfrom = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,/*'joinType'=>'LEFT JOIN','condition'=>'v.id=realestates.valute_id',*/'alias'=>'v')))
                          ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).' >= '.$fstavka->init_value.')',
                                          'select'=>'t.nameov,t.namewhats,t.id'));                         
                   foreach($vidsfrom as $vid) {
                         $list_stavka_fromvips[] = array(
                             'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/stavkaFrom/'.$fstavka->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/stavka',array('id'=>$fstavka->id, 'property'=>'vid', 'pid'=>$vid->id)),
                             'frequency'=>'daily',
                             'priority'=>'0.8',               
                             'attr'=>array(//'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по './*арендной */'ставке от '.$fstavka->init_value.' руб.',                                                
                                            'title' => $vid->nameov.' по арендной ставке от '.$fstavka->init_value.' руб.',                                                
                                             'grid' => intval('37'.str_pad($fstavka->id.'0', '11', '0',STR_PAD_LEFT))),
                             'link'=>array(  'text' => $vid->nameov.' по арендной ставке от '.$fstavka->init_value.' руб.',
                                              'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по './*арендной */'ставке от '.$fstavka->init_value.' руб.',
                                            'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по './*арендной */'ставке от '.$fstavka->init_value.' руб.',
                             ),                              
                             'lid'=>'37'.str_pad($fstavka->id.'0', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                         );
                   }
                   // До
                   $list_fstavkas_to[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/stavkaTo',array('id'=>$fstavka->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда '.' по арендной ставке до '.$fstavka->final_value.' руб.',                                                       
                                                       'title' => 'Коммерческая недвижимость'.' по арендной ставке до '.$fstavka->final_value.' руб.',                                                       
                                                        'grid' => 37),
                                        'link'=>array(  'text' => 'Коммерческая недвижимость'.' по арендной ставке до '.$fstavka->final_value.' руб.',
                                                         'alt' => 'Аренда по арендной ставке до '.$fstavka->final_value.' руб.',
                                                       'title' => 'Аренда по арендной ставке до '.$fstavka->final_value.' руб.',
                                        ),                       
                                        'lid'=>'37'.str_pad($fstavka->id.'2', '11', '0',STR_PAD_LEFT)
                                    );                        
                   //$vidsto = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,/*'joinType'=>'LEFT JOIN','condition'=>'v.id=realestates.valute_id',*/'alias'=>'v')))
                   //       ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).'<='.$fstavka->final_value.')',
                   //                       'select'=>'t.namewhats,t.id'));                        
                   $vidsto = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,/*'joinType'=>'LEFT JOIN','condition'=>'v.id=realestates.valute_id',*/'alias'=>'v')))
                          ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).'<='.$fstavka->final_value.')',
                                          'select'=>'t.nameov,t.id'));                         
                   foreach($vidsto as $vid) {
                         $list_stavka_tovips[] = array(
                             'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/stavkaTo/'.$fstavka->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/stavka',array('id'=>$fstavka->id, 'property'=>'vid', 'pid'=>$vid->id)),
                             'frequency'=>'daily',
                             'priority'=>'0.8',               
                             'attr'=>array(//'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по './*арендной */'ставке до '.$fstavka->final_value.' руб.',
                                            'title' => $vid->nameov.' по арендной ставке до '.$fstavka->final_value.' руб.',
                                             'grid' => intval('37'.str_pad($fstavka->id.'2', '11', '0',STR_PAD_LEFT))),
                             'link'=>array(  'text' => $vid->nameov.' по арендной ставке до '.$fstavka->final_value.' руб.',
                                              'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по арендной ставке до '.$fstavka->final_value.' руб.',
                                            'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по арендной ставке до '.$fstavka->final_value.' руб.',
                             ),                              
                             'lid'=>'37'.str_pad($fstavka->id.'2', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                         );
                   }
               }                             
            }  
            
            /* Комерческая недвижимость по стоимости в месяц */
            $list_fcosts = array();
            
            $fcosts = FcostOffers::model()->sitemap()->findAll(array('condition'=>'t.valute_id=2'));                                          
            //$fcosts = FcostOffers::model()->findAll(array('condition'=>'t.valute_id=2'));                                          
            
            //$model = Valutes::model()->findByPk(2);            
            
            Yii::app()->currency->to = $model->title;
            //$curr = Yii::app()->currency->from; // Сохраняем курсы
                    
            //$ainfo_curs = $this->__isCurs();                                        
            Yii::app()->currency->from =$ainfo_curs;  
            Yii::app()->currency->timeCacheComp = 0;
            Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
            Yii::app()->currency->init();
                    
            Yii::app()->currency->from=$curr; // Востанавливаем курсы                                            
                
            
            //* Виды недвижимости по стоимости в месяц
            $list_cost_vips = array();                                         
            
            foreach ( $fcosts as $key=>$fcost ) {                                                           
                
                if (!empty($ainfo_curs)) {
                             $home_sel = "";//IF( v.title='".Yii::app()->currency->to."', t.price,";
                             $end_sel = "";
                             foreach ( $ainfo_curs as $akey=>$val) {
                                  $home_sel.= "IF( v.title='".$val["name"]."', t.area*t.price*".Yii::app()->currency->$val["name"]."/12 ,";// t.price)) as `price`';
                                  $end_sel.= ")";
                             }     
                             $home_sel.= " t.area*t.price/12"; 
                             $select = $home_sel.$end_sel;                             
                             $realestates = new Realestates();
                             $realestates->valute_id = null;
                             $condition = $select.' BETWEEN '. $fcost->init_value.' AND '.$fcost->final_value;
                             $realestates->getDbCriteria()->addCondition($condition);                                                                        
                             $realestates->getDbCriteria()->join= ' LEFT JOIN valutes v on v.id=t.valute_id ';
               } else {
                             $realestates->getDbCriteria()->addBetweenCondition('t.area*t.price/12', $fcost->init_value, $fcost->final_value);   
               }                  
            
               $is_freals = $realestates->exists('((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
               if ($is_freals) {          
                   // Между
                   $list_fcosts[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/cost',array('id'=>$fcost->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда '.'стоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',                                                       
                                                       'title' => 'Коммерческая недвижимость '.'стоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',                                                       
                                                        'grid' => 36),
                                        'link'=>array(  'text' => 'Коммерческая недвижимость '.'стоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                                         'alt' => 'Аренда стоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                                       'title' => 'Аренда стоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                        ),                          
                                        'lid'=>'36'.str_pad($fcost->id.'1', '11', '0',STR_PAD_LEFT)
                                    ); 

                   //$vids = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,/*'condition'=>'v.id=realestates.valute_id',*/'alias'=>'v')))
                   //               ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).' between '.$fcost->init_value.' AND '.$fcost->final_value.')',
                   //                               'select'=>'t.namewhats,t.id'));                                       
                   $vids = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,/*'condition'=>'v.id=realestates.valute_id',*/'alias'=>'v')))
                                  ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).' between '.$fcost->init_value.' AND '.$fcost->final_value.')',
                                                  'select'=>'t.nameov,t.namewhats,t.id'));                                                          
                   foreach($vids as $vid) {
                       $list_cost_vips[] = array(
                           'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/cost/'.$fcost->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/cost',array('id'=>$fcost->id, 'property'=>'vid', 'pid'=>$vid->id)),
                           'frequency'=>'daily',
                           'priority'=>'0.8',               
                           'attr'=>array( //'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                          'title' => $vid->nameov.' cтоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                           'grid' => intval('36'.str_pad($fcost->id.'1', '11', '0',STR_PAD_LEFT))),                           
                           'link'=>array(  'text' => $vid->nameov.' cтоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                            'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                          'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                           ),                            
                           'lid'=>'36'.str_pad($fcost->id.'1', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                     );
                  }
                  // От
                  $list_fcosts_from[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/costFrom',array('id'=>$fcost->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=> 'Аренда '.'стоимостью от '.$fcost->init_value.' руб.',                                         
                                                       'title' => 'Коммерческая недвижимость'.' стоимостью от '.$fcost->init_value.' руб.',                                         
                                                        'grid' => 36),
                                        'link'=>array(  'text' => 'Коммерческая недвижимость'.' стоимостью от '.$fcost->init_value.' руб.',
                                                         'alt' => 'Аренда стоимостью от '.$fcost->init_value.' руб.',
                                                       'title' => 'Аренда стоимостью от '.$fcost->init_value.' руб.',
                                        ),                       
                                        'lid'=>'36'.str_pad($fcost->id.'0', '11', '0',STR_PAD_LEFT)
                                    ); 

                   //$vidsfrom = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,/*'condition'=>'v.id=realestates.valute_id',*/'alias'=>'v')))
                   //               ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).'>='.$fcost->init_value.')',
                   //                               'select'=>'t.namewhats,t.id'));                                       
                   $vidsfrom = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,/*'condition'=>'v.id=realestates.valute_id',*/'alias'=>'v')))
                                  ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).'>='.$fcost->init_value.')',
                                                  'select'=>'t.nameov,t.namewhats,t.id'));                                                          
                   foreach($vidsfrom as $vid) {
                       $list_cost_fromvips[] = array(
                           'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/costFrom/'.$fcost->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/cost',array('id'=>$fcost->id, 'property'=>'vid', 'pid'=>$vid->id)),
                           'frequency'=>'daily',
                           'priority'=>'0.8',               
                           'attr'=>array( //'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью от '.$fcost->init_value.' руб.',
                                          'title' => $vid->nameov.' cтоимостью от '.$fcost->init_value.' руб.',
                                           'grid' => intval('36'.str_pad($fcost->id.'0', '11', '0',STR_PAD_LEFT))),
                           'link'=>array(  'text' => $vid->nameov.' cтоимостью от '.$fcost->init_value.' руб.',
                                            'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью от '.$fcost->init_value.' руб.',
                                          'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью от '.$fcost->init_value.' руб.',
                           ),                            
                           'lid'=>'36'.str_pad($fcost->id.'0', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                     );
                  }
                  // До
                  $list_fcosts_to[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/costTo',array('id'=>$fcost->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array( //'title'=>'Аренда '.'стоимостью до '.$fcost->final_value.' руб.',                                                        
                                                       'title'=>'Коммерческая недвижимость '.'стоимостью до '.$fcost->final_value.' руб.',
                                                       'grid'=>36),
                                        'link'=>array(  'text' => 'Коммерческая недвижимость '.'стоимостью до '.$fcost->final_value.' руб.',
                                                         'alt' => 'Аренда коммерческой недвижимости стоимостью до '.$fcost->final_value.' руб.',
                                                       'title' => 'Аренда коммерческой недвижимости стоимостью до '.$fcost->final_value.' руб.',
                                        ),                        
                                        'lid'=>'36'.str_pad($fcost->id.'2', '11', '0',STR_PAD_LEFT)
                                    ); 

                   //$vidsto = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,/*'condition'=>'v.id=realestates.valute_id',*/'alias'=>'v')))
                   //               ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).'<='.$fcost->final_value.')',
                   //                               'select'=>'t.namewhats,t.id'));                                       
                   $vidsto = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,/*'condition'=>'v.id=realestates.valute_id',*/'alias'=>'v')))
                                  ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).'<='.$fcost->final_value.')',
                                                  'select'=>'t.nameov,t.namewhats,t.id'));                                                          
                   foreach($vidsto as $vid) {
                       $list_cost_tovips[] = array(
                           'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/costTo/'.$fcost->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/cost',array('id'=>$fcost->id, 'property'=>'vid', 'pid'=>$vid->id)),
                           'frequency'=>'daily',
                           'priority'=>'0.8',               
                           'attr'=>array( //'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью до '.$fcost->final_value.' руб.',
                                          'title'=> $vid->nameov.' cтоимостью до '.$fcost->final_value.' руб.',
                                          'grid' => intval('36'.str_pad($fcost->id.'2', '11', '0',STR_PAD_LEFT))),
                           'link'=>array( 'text' => $vid->nameov.' cтоимостью до '.$fcost->final_value.' руб.',
                                           'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью до '.$fcost->final_value.' руб.',
                                         'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью до '.$fcost->final_value.' руб.',
                           ),                            
                           'lid'=>'36'.str_pad($fcost->id.'2', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                     );
                  }
               }               
            }                           
            
            $remoteness = Realestates::model()->findAll(array('condition'=>'t.unit_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))','group'=>'t.unit_id,t.remoteness','order'=>'t.unit_id,t.remoteness asc',
                                                              'select'=>'t.id,t.remoteness,t.unit_id'));
            $remotenessAll = Realestates::model()->findAll(array('condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))','group'=>'t.remoteness','order'=>'t.remoteness asc',
                                                                 'select'=>'t.id,t.remoteness,remoteness'));
         
            $list_remoteness[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/unit'),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array( //'title' => 'Аренда коммерческой недвижимости в минутах, все типы удаленности',
                                                       'title' => 'Коммерческая недвижимость от метро в минутах, по способу',
                                                        'grid' => 30),
                                        'link'=>array( 'text' => 'Коммерческая недвижимость от метро в минутах, по способу',
                                                        'alt' => 'Аренда коммерческой недвижимости от метро в минутах, по способу',
                                                      'title' => 'Аренда коммерческой недвижимости от метро в минутах, по способу',
                                        ),                
                                        'lid'=>'300000000000'.'0'
            ); 
                                    
            foreach ( $remoteness as $key=>$remotenes ) {                                
                 $list_remoteness[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/unit/',($remotenes->unit->id ? array('remotenes'=>round($remotenes->remoteness),'id'=>$remotenes->unit->id) : array('remotenes'=>round($remotenes->remoteness)))),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array( //'title'=>'Аренда от метро в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.")",                                                       
                                                       'title'=>'Коммерческая недвижимость в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.") от метро",
                                                       'grid'=>intval('300000000000'.$remotenes->unit->id)),
                                        'link'=>array( 'text' => 'Коммерческая недвижимость в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.") от метро",
                                                        'alt' => 'Аренда от метро в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.")",
                                                      'title' => 'Аренда от метро в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.")",
                                        ),                     
                                        'lid'=>'300000000000'.$remotenes->unit->id.str_pad(round($remotenes->remoteness), '3', '0',STR_PAD_LEFT)
                 ); 
                 
                 //$vids = RealestateVids::model()->sitemap_noexreal()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.unit_id='.$remotenes->unit->id.' AND realestates.remoteness='.round($remotenes->remoteness)));                 
                 $vids = RealestateVids::model()->sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.unit_id='.$remotenes->unit->id.' AND realestates.remoteness='.round($remotenes->remoteness)));                 
                 foreach($vids as $vid) {
                        $list_rems_vips[] = array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/unit/',($remotenes->unit->id ? array('remotenes'=>round($remotenes->remoteness),'id'=>$remotenes->unit->id, 'vid'=>$vid->id) : array('remotenes'=>round($remotenes->remoteness),'vid'=>$vid->id))),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' от метро '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.")",                                           
                                            'title'=>$vid->nameov.', в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.") от метро",                                           
                                             'grid'=>intval('300000000000'.$remotenes->unit->id.str_pad(round($remotenes->remoteness), '3', '0',STR_PAD_LEFT))),
                            'link'=>array( 'text' => $vid->nameov.', в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.") от метро",
                                            'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' от метро '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.")",
                                          'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' от метро '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.")",
                            ),                               
                            'lid'=>'300000000000'.$remotenes->unit->id.str_pad(round($remotenes->remoteness), '3', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT)                            
                        );
                 }
            }
            
            foreach ( $remotenessAll as $key=>$remotenes ) {                                
                 $list_remoteness[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/unit/', array('remotenes'=>round($remotenes->remoteness))),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array( //'title'=>'Аренда коммерческой недвижимости с удаленностью от метро '.round($remotenes->remoteness).' мин.',                                                               
                                                       'title'=> 'Коммерческая недвижимость в '.round($remotenes->remoteness).' мин. от метро',                                                               
                                                       'grid'=>3000000000000),
                                        'link'=>array( 'text' => 'Коммерческая недвижимость в '.round($remotenes->remoteness).' мин. от метро',
                                                        'alt' => 'Аренда коммерческой недвижимости с удаленностью от метро '.round($remotenes->remoteness).' мин.',
                                                      'title' => 'Аренда коммерческой недвижимости с удаленностью от метро '.round($remotenes->remoteness).' мин.',
                                        ),                     
                                        'lid'=>'300000000000'.'0'.str_pad(round($remotenes->remoteness), '3', '0',STR_PAD_LEFT)
                 );
                 
                 //$vids = RealestateVids::model()->sitemap_noexreal()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.remoteness='.round($remotenes->remoteness)));                         
                 $vids = RealestateVids::model()->sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.remoteness='.round($remotenes->remoteness)));                         
                 foreach($vids as $vid) {
                        $list_remas_vips[] = array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/unit/',array('remotenes'=>round($remotenes->remoteness),'vid'=>$vid->id)),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').", c удаленностью от метро ".round($remotenes->remoteness).' мин.',
                                          'title' => $vid->nameov.", в ".round($remotenes->remoteness).' мин. от метро',
                                           'grid' => intval('300000000000'.'0'.str_pad(round($remotenes->remoteness), '3', '0',STR_PAD_LEFT))),
                            'link'=>array( 'text' => $vid->nameov.", в ".round($remotenes->remoteness).' мин. от метро',
                                            'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').", c удаленностью от метро ".round($remotenes->remoteness).' мин.',
                                          'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').", c удаленностью от метро ".round($remotenes->remoteness).' мин.',
                            ),                            
                            'lid'=>'300000000000'.'0'.str_pad(round($remotenes->remoteness), '3', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT)                            
                        );
                 }
            }
            
            $list = array(
                        // Главная страница
                        array(
                            'loc'=>Yii::app()->createAbsoluteUrl('/'),
                            'frequency'=>'weekly',
                            'priority'=>'1',
                            'attr'=>array('title'=>Yii::t('menu','Главная'),'grid'=>null),
                            'lid'=>'01'
                            ),
                        // Страница - Контакт    
                        array(
                            'loc'=>Yii::app()->createAbsoluteUrl('/site/contact'),
                            'frequency'=>'yearly',
                            'priority'=>'0.8',
                            'attr'=>array('title'=>Yii::t('menu','Контакт'),'grid'=>null),
                            'lid'=>'05'
                            ),
                        // Страница - Избранное    
                        /*array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/favs'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',                            
                            'attr'=>array('title'=>Yii::t('menu','Избранное'),'grid'=>null),
                            'lid'=>'06'
                        ),*/
                        // Страница - Каталог недвижимости все классы
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/class'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости все классы'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по классам'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по классам'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по классам'),
                                          'title' =>Yii::t('menu','Аренда коммерческая недвижимости Москвы, по классам'),         
                                         ),
                            'lid'=>'15'
                        ),       
                        // Страница - Каталог недвижимости все виды
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/vid'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости все виды '),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по видам '),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по видам'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по видам'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по видам'),         
                                         ),
                            'lid'=>'16'
                        ),                 
                        // Страница - Каталог недвижимости все районы
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/district'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',                                           
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости, все административные округа'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость, по административным округам'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по административным округам'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по административным округам'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по административным округам'),         
                                         ),
                            'lid'=>'17'
                        ),  
                        // Страница - Каталог недвижимости все районы
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/areas'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, все районы'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость, по районам'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по районам'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по районам'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по районам'),         
                                         ),
                            'lid'=>'38'
                        ),        
                        // Страница - Каталог недвижимости все районы
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/taxReference'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости все ИФСН'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость, по ИФСН'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость, по ИФСН'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по ИФСН'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по ИФСН'),         
                                         ),                            
                            'lid'=>'39'
                        ),                    
                        // Страница - Каталог недвижимости по назначению
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/destination'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, все назначения'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость, по назначениям'),'grid'=>null),                            
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость, по назначениям'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по назначениям'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по назначениям'),         
                                         ),                                                        
                            'lid'=>'21'
                        ),          
                        // Страница - Каталог недвижимости по свойствам
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/property'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, по свойствам'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческой недвижимость, по свойствам'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческой недвижимость, по свойствам'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по свойствам'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по свойствам'),         
                                         ),                             
                            'lid'=>'22'
                        ),                
                        // Страница - Каталог недвижимости c отдельным входом
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/entranceon'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Аренда коммерческой недвижимости Москвы с отдельным входом'),'grid'=>22),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость с отдельным входом'),'grid'=>22),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость с отдельным входом'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы с отдельным входом'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы с отдельным входом'),         
                                         ),  
                            'lid'=>'22'.str_pad(1,'2', '0',STR_PAD_LEFT)
                        ),           
                        // Страница - Каталог недвижимости без отдельного входа
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/entranceoff'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Аренда коммерческой недвижимости Москвы без отдельного входа'),'grid'=>22),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческой недвижимость без отдельного входа'),'grid'=>22),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость без отдельного входа'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы без отдельного входа'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы без отдельного входа'),         
                                         ),  
                            'lid'=>'22'.str_pad(2,'2', '0',STR_PAD_LEFT)
                        ),                    
                        // Страница - Каталог недвижимости по типу
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/type'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',                                
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости по аренде в зданиях Москвы'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по размещению'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по размещению'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по размещению'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по размещению'),         
                                         ),  
                            'lid'=>'31'
                        ),                       
                        /* Страница - Каталог недвижимости по операциям
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/operation'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array('title'=>Yii::t('menu','Каталог недвижимости по операциям'),'grid'=>null),
                            'lid'=>'23'
                        ),*/   
                        // Страница - Каталог недвижимости по планировке
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/planning'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы по планировке'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по планировке'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по планировке'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по планировке'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по планировке'),         
                                         ),
                            'lid'=>'24'
                        ),          
                        // Страница - Каталог недвижимости по налогооблажению
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/tax'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы по налогооблажению'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по налогооблажению'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по налогооблажению'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по налогооблажению'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по налогооблажению'),         
                                         ),
                            'lid'=>'25'
                        ),    
                        // Страница - Каталог недвижимости по комиссии
                        /*array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/commission'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог недвижимости по комиссии'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Комерческая недвижимость по комиссии'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по комиссии'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по комиссии'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по комиссии'),         
                            ),                         
                            'lid'=>'27'
                        ),*/                 
                        // Страница - Каталог недвижимости по парковке
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/parking'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы по парковке'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по парковке'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по парковке'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по парковке'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по парковке'),         
                                         ),                            
                            'lid'=>'28'
                        ),                                  
                        // Страница - Каталог недвижимости все валюты
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/valute'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, все валюты'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по валюте аренды'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по валюте аренды'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по валюте аренды'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по валюте аренды'),         
                                         ),                            
                            'lid'=>'18'
                        ),  
                        // Страница - Каталог недвижимости все улицы
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/street'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, все улицы'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по улицам'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по улицам'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости по улицам Москвы'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости по улицам Москвы'),         
                                         ),                            
                            'lid'=>'19'
                        ),                       
                        // Страница - Каталог недвижимости все станции метро
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/metro'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, все станции метро'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по станциям метро'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по станциям метро'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости по станциям метро Москвы'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости по станциям метро Москвы'),         
                                         ),                              
                            'lid'=>'20'
                        ),     
                
                        // Страница - Каталог недвижимости все станции метро
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/unit'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, в минутах от метро'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по удаленности в минутах от метро'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по удаленности в минутах от метро'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости по удаленности в минутах от метро Москвы'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости по удаленности в минутах от метро Москвы'),         
                                         ),                              
                            'lid'=>'30'
                        ),               
                        // Страница - Каталог недвижимости вся площадь
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/area'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости по площади'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по площади'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по площади'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по площади'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по площади'),         
                                         ),                                
                            'lid'=>'35'
                        ),                  
                
                        // Страница - Каталог недвижимости все ставки
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/stavka'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости по арендной ставке'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по арендной ставке'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по арендной ставке'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по арендной ставке'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по арендной ставке'),         
                                         ),                                
                            'lid'=>'37'
                        ),    
                
                        // Страница - Каталог недвижимости вся стоимость
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/cost'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости по стоимости в месяц'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по стоимости в месяц'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по стоимости в месяц'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по стоимости в месяц'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по стоимости в месяц'),         
                                         ),                                
                            'lid'=>'36'
                        ),                                    
                
                        // Страница - Каталог недвижимости
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/index'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости'),'grid'=>null),
                            'lid'=>'13'
                        ),                         
                        /*array(
                            'loc'=>Yii::app()->createAbsoluteUrl('/site/page', array('view'=>'about')),
                            'frequency'=>'monthly',
                            'priority'=>'0.8',
                            ),
                        array(
                            'loc'=>Yii::app()->createAbsoluteUrl('/site/page', array('view'=>'privacy')),
                            'frequency'=>'yearly',
                            'priority'=>'0.3',
                            ),*/
                    );
            $list = array_merge($list_coefs,$list,
                                $list_fareas, $list_fareas_from,$list_fareas_to,
                                $list_area_vips, $list_area_fromvips,$list_area_tovips,
                                $list_remoteness/*,$list_district_areas*/,
                                $list_metro_vips,$list_street_vips,$list_district_vips,$list_class_vips, $list_type_vips,
                                $list_areas_vips,
                                $list_taxrefs_vips,$list_dests_vips, 
                                $list_fstavkas, $list_fstavkas_from,$list_fstavkas_to,
                                $list_stavka_vips, $list_stavka_fromvips,$list_stavka_tovips,
                                $list_fcosts, $list_fcosts_from,$list_fcosts_to,
                                $list_cost_vips, $list_cost_fromvips,$list_cost_tovips,
                                $list_props_vips,$list_coefs_vips,$list_rems_vips,$list_remas_vips); 
            //echo "<pre>"; print_r($list); echo "</pre>";
            return $list;
        }    
        
        /**
         * Provide the static site pages which are not database generated
         *
         * Each array element represents a page and should be an array of
         * 'loc', 'frequency' and 'priority' keys
         * 
         * @return array[]
         */
        public function getBaseSitePageListMap() {
            
            /*$list_district_areas = array();            
            
            $districts = Districts::model()->sitemap()->findAll();
            foreach ($districts as $district) {
                $areas = Areas::model()->sitemap()->findAll(array('condition'=>'district_id='.$district->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($areas as $area) {
                    $list_district_areas[] = array(
                        'loc'=> Yii::app()->createUrl('/ru/realestates/district/'.$district->id.'/areas/'.$area->id),//Yii::app()->createUrl('/realestates/district',array('id'=>$district->id, 'property'=>'areas', 'pid'=>$area->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',               
                        'attr'=>array('title'=>Yii::t('menu', $area->title.' район'),'grid'=>intval('17'.str_pad($district->id, '11', '0',STR_PAD_LEFT))),
                        'lid'=>'17'.str_pad($district->id, '11', '0',STR_PAD_LEFT).str_pad($area->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }*/     
            
            /* Виды недвижимости по классам */
            $list_class_vips = array();            
            
            $class = RealestateClasses::model()->sitemap()->findAll();
            foreach ($class as $clas) {                
                $vids = RealestateVids::model()->sitemap_noexrealOv()/*sitemap_noexreal()*/->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.realestate_class_id='.$clas->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.realestate_class_id='.$clas->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($vids as $vid) {
                    $list_class_vips[] = array(
                        'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/class/'.$clas->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/class',array('id'=>$clas->id, 'property'=>'vid', 'pid'=>$vid->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',               
                        'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' класса '.$clas->abbr,
                                      'title'=>$vid->nameov.' класса '.$clas->abbr,
                                      'grid'=>intval('15'.str_pad($clas->id, '11', '0',STR_PAD_LEFT))),
                        'link'=>array('text'  =>$vid->nameov.' класса '.$clas->abbr,
                                      'alt'   =>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' класса '.$clas->abbr,
                                      'title' =>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' класса '.$clas->abbr,
                        ),    
                        'lid'=>'15'.str_pad($clas->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }
            
            /* Виды недвижимости по классам */
            $list_type_vips = array();   
            
            $types = RealestateTypes::model()->sitemap()->findAll();
            foreach ($types as $type) {                
                $vids = RealestateVids::model()->sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.realestate_type_id='.$type->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                                
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.realestate_type_id='.$type->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                                
                foreach($vids as $vid) {
                    if (mb_strtolower(trim($type->title),'UTF-8')!== mb_strtolower(trim($vid->nameov),'UTF-8')) {
                        $list_type_vips[] = array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/type/'.$type->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/type',array('id'=>$type->id, 'property'=>'vid', 'pid'=>$vid->id)),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в '.$type->namewheres.' Москвы',
                                          'title'=>$vid->nameov.' в '.mb_strtolower($type->namewheres,'UTF-8'),
                                          'grid'=>intval('31'.str_pad($type->id, '11', '0',STR_PAD_LEFT))),
                            'link'=>array('text'  =>$vid->nameov.' в '.mb_strtolower($type->namewheres,'UTF-8'),
                                          'alt'   =>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в '.$type->namewheres.' Москвы',   
                                          'title' =>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в '.$type->namewheres.' Москвы',
                            ),                                
                            'lid'=>'31'.str_pad($type->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                        );
                    }
                }
            }
            
            /* Виды недвижимости по районам */
            $list_areas_vips = array();            
            
            $areas = Areas::model()->sitemap()->findAll();
            foreach ($areas as $area) {                
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.areas_id='.$area->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.areas_id='.$area->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($vids as $vid) {
                    $list_areas_vips[] = array(
                        'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/areas/'.$area->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/areas',array('id'=>$area->id, 'property'=>'vid', 'pid'=>$vid->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',               
                        'attr'=>array(//'title'=>"Аренда ".mb_strtolower($vid->namewhats,'UTF-8')." Москвы в районе ".$area->namewhat,
                                      'title'=>$vid->nameov." в районе ".$area->namewhat,
                                        //Yii::t('menu', $vid->title.', район '.$area->title),
                                      'grid'=>intval('38'.str_pad($area->id, '11', '0',STR_PAD_LEFT))),
                        'link'=>array('text' => $vid->nameov." в районе ".$area->namewhat,
                                      'alt' => "Аренда ".mb_strtolower($vid->namewhats,'UTF-8')." Москвы в районе ".$area->namewhat,   
                                      'title' => "Аренда ".mb_strtolower($vid->namewhats,'UTF-8')." Москвы в районе ".$area->namewhat,        
                         ),                               
                        'lid'=>'38'.str_pad($area->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }          
            
            /* Виды недвижимости по районам */
            $list_dests_vips = array();               
            $dests = Destinations::model()->sitemap()->findAll();
            //$dests = Destinations::model()->findAll();
            foreach ($dests as $dest) {    
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.id IN ('.implode(',',CHtml::listData($dest->realestateDestinations, 'realestate_id', 'realestate_id')).')'.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                    
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.id IN ('.implode(',',CHtml::listData($dest->realestateDestinations, 'realestate_id', 'realestate_id')).')'.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                                    
                foreach($vids as $vid) {
                            $list_dests_vips[] = array(
                                'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/destination/'.$dest->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/areas',array('id'=>$dest->id, 'property'=>'vid', 'pid'=>$vid->id)),
                                'frequency'=>'daily',
                                'priority'=>'0.8',               
                                'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' Москвы под '.mb_strtolower($dest->under,'UTF-8'),
                                              'title' => $vid->nameov.' под '.mb_strtolower($dest->under,'UTF-8'),
                                               'grid' =>intval('21'.str_pad($dest->id, '11', '0',STR_PAD_LEFT))),
                                'link'=>array( 'text' => $vid->nameov.' под '.mb_strtolower($dest->under,'UTF-8'),
                                               'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' Москвы под '.mb_strtolower($dest->under,'UTF-8'),   
                                               'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' Москвы под '.mb_strtolower($dest->under,'UTF-8'),        
                                ), 
                                'lid'=>'21'.str_pad($dest->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                            );
                }                                         
            }             
 
            /* Виды недвижимости по налоговым */
            $list_taxrefs_vips = array();            
            
            $taxrefs = TaxReference::model()->sitemap()->findAll();
            //$taxrefs = TaxReference::model()->findAll();
            foreach ($taxrefs as $taxref) {                
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.number_tax='.$taxref->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.number_tax='.$taxref->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($vids as $vid) {
                    $list_taxrefs_vips[] = array(
                        'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/taxReference/'.$taxref->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/taxReference',array('id'=>$taxref->id, 'property'=>'vid', 'pid'=>$vid->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',               
                        'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве, '.$taxref->abbr,
                                      'title'=>$vid->nameov.', '.$taxref->abbr,                                        
                                      'grid'=>intval('39'.str_pad($taxref->id, '11', '0',STR_PAD_LEFT))),
                        'link'=>array( 'text' => $vid->nameov.', '.$taxref->abbr,
                                       'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве, '.$taxref->abbr,
                                       'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве, '.$taxref->abbr,        
                                ),
                        'lid'=>'39'.str_pad($taxref->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }                                                                   
            
            /* Виды недвижимости по метро */
            $list_metro_vips = array();            
            
            $metros = Metros::model()->sitemap()->findAll();
            foreach ($metros as $metro) {                
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.metro_id='.$metro->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.metro_id='.$metro->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($vids as $vid) {
                    $list_metro_vips[] = array(
                        'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/metro/'.$metro->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/metro',array('id'=>$metro->id, 'property'=>'vid', 'pid'=>$vid->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',               
                        'attr'=>array(//'title'=>"Аренда ".mb_strtolower($vid->namewhats,'UTF-8').' рядом с станцией метро '.$metro->title,
                                      'title'=>$vid->nameov.' рядом с станцией метро '.$metro->title,
                                      'grid'=>intval('20'.str_pad($metro->id, '11', '0',STR_PAD_LEFT))),
                        'link'=>array( 'text' => $vid->nameov.' рядом с станцией метро '.$metro->title,
                                        'alt' => "Аренда ".mb_strtolower($vid->namewhats,'UTF-8').' рядом с станцией метро '.$metro->title,
                                      'title' => "Аренда ".mb_strtolower($vid->namewhats,'UTF-8').' рядом с станцией метро '.$metro->title,        
                                ),                        
                        'lid'=>'20'.str_pad($metro->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }
            
            /* Виды недвижимости по улицам */
            $list_street_vips = array();            
            
            $streets = Streets::model()->sitemap()->findAll();
            foreach ($streets as $street) {                
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.street_id='.$street->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.street_id='.$street->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($vids as $vid) {
                    $list_street_vips[] = array(
                        'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/street/'.$street->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/street',array('id'=>$street->id, 'property'=>'vid', 'pid'=>$vid->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',               
                        'attr'=>array( //'title'=>"Аренда ".mb_strtolower($vid->namewhats,'UTF-8')." Москвы, ".$street->getFullName('на')
                                      'title' => $vid->nameov." ".$street->getFullName('на'),
                                       'grid' => intval('19'.str_pad($street->id, '11', '0',STR_PAD_LEFT))),
                        'link'=>array( 'text' => $vid->nameov." ".$street->getFullName('на'),
                                        'alt' => "Аренда ".mb_strtolower($vid->namewhats,'UTF-8')." Москвы, ".$street->getFullName('на'),
                                      'title' => "Аренда ".mb_strtolower($vid->namewhats,'UTF-8')." Москвы, ".$street->getFullName('на'),        
                                ),
                        'lid'=>'19'.str_pad($street->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }       
            
            /* Виды недвижимости по свойствам */
            $list_props_vips = array();            
            
            $props = Properties::model()->sitemap()->findAll();
            foreach ($props as $prop) {    
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.id IN ('.implode(',',CHtml::listData($prop->realestateProperties, 'realestate_id', 'realestate_id')).')'.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                    
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.id IN ('.implode(',',CHtml::listData($prop->realestateProperties, 'realestate_id', 'realestate_id')).')'.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                    
                foreach($vids as $vid) {
                            $list_props_vips[] = array(
                                'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/property/'.$prop->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/property',array('id'=>$dest->id, 'property'=>'vid', 'pid'=>$vid->id)),
                                'frequency'=>'daily',
                                'priority'=>'0.8',               
                                'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве со свойством '.$prop->title,
                                              'title' => $vid->nameov.' со свойством '.$prop->title,  
                                               'grid' => intval('22'.str_pad($prop->id, '11', '0',STR_PAD_LEFT))),
                                'link'=>array( 'text' => $vid->nameov.' со свойством '.$prop->title,
                                               'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве со свойством '.$prop->title,
                                              'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве со свойством '.$prop->title,        
                                ),                                
                                'lid'=>'22'.str_pad($prop->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                            );
                }                                         
            }    
            
            /* Виды недвижимости по улицам */
            $list_district_vips = array();            
            
            $districts = Districts::model()->sitemap()->findAll();
            foreach ($districts as $district) {                
                $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.district_id='.$district->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));                
                //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.district_id='.$district->id.' AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL))'));
                foreach($vids as $vid) {
                    $list_district_vips[] = array(
                        'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/district/'.$district->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/district',array('id'=>$street->id, 'property'=>'vid', 'pid'=>$vid->id)),
                        'frequency'=>'daily',
                        'priority'=>'0.8',                              
                        'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8')." ".(mb_strtolower($district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($district->title,'UTF-8')."е (".mb_strtolower($district->abbr,'UTF-8').") Москвы",
                                      'title' => $vid->nameov." ".(mb_strtolower($district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($district->title,'UTF-8')."е (".mb_strtolower($district->abbr,'UTF-8').")",
                                       'grid' => intval('17'.str_pad($district->id, '11', '0',STR_PAD_LEFT))),
                        'link'=>array( 'text' => $vid->nameov." ".(mb_strtolower($district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($district->title,'UTF-8')."е (".mb_strtolower($district->abbr,'UTF-8').")",
                                        'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8')." ".(mb_strtolower($district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($district->title,'UTF-8')."е (".mb_strtolower($district->abbr,'UTF-8').") Москвы",
                                      'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8')." ".(mb_strtolower($district->title,'UTF-8')=="центр" ? "в" : "на")." ".mb_strtolower($district->title,'UTF-8')."е (".mb_strtolower($district->abbr,'UTF-8').") Москвы",        
                        ),  
                        'lid'=>'17'.str_pad($district->id, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                    );
                }
            }                        
            
            $acoef = array_combine(range(1,26,1),range(5,30,1));//range(5,30,1); 
            
            $list_coefs=array( 
                        // Страница - Каталог недвижимости по корредорным коеффициентам
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/coefficient'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array( 'title'=>Yii::t('menu','Коммерческая недвижимость по коридорным коэффициентам'),'grid'=>null),
                            'link'=>array( 'text' => 'Коммерческая недвижимость по коридорным коэффициентам',
                                           'alt' => 'Аренда коммерческой недвижимости по коридорным коэффициентам в Москве',
                                          'title' => 'Аренда коммерческой недвижимости по коридорным коэффициентам в Москве',        
                            ),   
                            'lid'=>26
                        )
            );        
            foreach ( $acoef as $key=>$coefficient ) {
                $is_corr = Realestates::model()->exists('coefficient_corridor='.$key.' AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))');
                if ($is_corr) {          
                    $list_coefs[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/coefficient',array('id'=>$key)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',               
                                        'attr'=>array(//'title'=> 'Аренда коммерческой недвижимости c коридорным коэффициентом '.$coefficient.'%',                                                            
                                                      'title'=> 'Коммерческая недвижимость с коридорным коэффициентом '.$coefficient.'%',                                                            
                                                      'grid'=>26),
                                        'link'=>array( 'text' => 'Коммерческая недвижимость с коридорным коэффициентом '.$coefficient.'%',
                                                       'alt' => 'Аренда коммерческой недвижимости c коридорным коэффициентом '.$coefficient.'%',
                                                      'title' => 'Аренда коммерческой недвижимости c коридорным коэффициентом '.$coefficient.'%',        
                                        ),                        
                                        'lid'=>'26'.str_pad($key, '11', '0',STR_PAD_LEFT)
                    );
                    $vids = RealestateVids::model()->/*sitemap_noexreal()*/sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.coefficient_corridor='.$key));
                    //$vids = RealestateVids::model()->sitemap()->with('realestates')->findAll(array('condition'=>'realestates.coefficient_corridor='.$coefficient));
                    foreach($vids as $vid) {
                        $list_coefs_vips[] = array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/coefficient/'.$key.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/district',array('id'=>$street->id, 'property'=>'vid', 'pid'=>$vid->id)),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' Москвы c коридорным коэффициентом '.$coefficient.'%',                                                
                                           'title'=> $vid->nameov.' c коридорным коэффициентом '.$coefficient.'%',                                                
                                           'grid' => intval('26'.str_pad($key, '11', '0',STR_PAD_LEFT))),
                            'link'=>array( 'text' => $vid->nameov.' c коридорным коэффициентом '.$coefficient.'%',
                                            'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' Москвы c коридорным коэффициентом '.$coefficient.'%',
                                          'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' Москвы c коридорным коэффициентом '.$coefficient.'%',        
                            ),                            
                            'lid'=>'26'.str_pad($key, '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                        );
                   }
                }
            }  
                        
            
            //$fareas = FareaOffers::model()->sitemap()->findAll();
            $fareas = FareaOffers::model()->sitemap_noexreal()->findAll();
            
            /* Виды недвижимости по площади */
            $list_area_vips = array();  
            
            foreach ( $fareas as $key=>$farea ) {                                
               $is_freals = Realestates::model()->exists('((act=1)OR(act is NULL))AND((del=0)OR(del is NULL)) AND (area BETWEEN '.$farea->init_value.' AND '.$farea->final_value.')');
               if ($is_freals) {       
                   // Между
                   $list_fareas[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/area',array('id'=>$farea->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда коммерческой недвижимости'.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',
                                                      'title' => 'Коммерческая недвижимость'.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',                                                        
                                                       'grid' => 35),
                                        'link'=>array( 'text' => 'Коммерческая недвижимость'.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2', 
                                                       'alt' => 'Аренда коммерческой недвижимости'.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',
                                                      'title' => 'Аренда коммерческой недвижимости'.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',        
                                        ),                          
                                        'lid'=>'35'.str_pad($farea->id.'1', '11', '0',STR_PAD_LEFT)
                                    ); 
                    
                    //$vids = RealestateVids::model()->with(array('realestates'=>array('select'=>false)))->findAll(array('select'=>'t.id,t.namewhats','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( realestates.area between '.$farea->init_value.' AND '.$farea->final_value.')'));
                    $vids = RealestateVids::model()->with(array('realestates'=>array('select'=>false)))->findAll(array('select'=>'t.id,t.nameov,t.namewhats','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( realestates.area between '.$farea->init_value.' AND '.$farea->final_value.')'));
                    foreach($vids as $vid) {
                         $list_area_vips[] = array(
                             'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/area/'.$farea->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/areas',array('id'=>$farea->id, 'property'=>'vid', 'pid'=>$vid->id)),
                             'frequency'=>'daily',
                             'priority'=>'0.8',               
                             'attr'=>array( //'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',
                                            'title'=>$vid->nameov.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',
                                            //Yii::t('menu', $vid->title.' с площадью от '.$offer->init_value.' м2 до '.$offer->final_value.' м2'),
                                           'grid'=>intval('35'.str_pad($farea->id.'1', '11', '0',STR_PAD_LEFT))),
                             'link'=>array( 'text' => $vid->nameov.' площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',
                                             'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',
                                           'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью от '.$farea->init_value.' м2 до '.$farea->final_value.' м2',        
                             ),                             
                             'lid'=>'35'.str_pad($farea->id.'1', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                         );                    
                    }
                    
                    /*/ От               
                    $list_fareas_from[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/areaFrom',array('id'=>$farea->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда коммерческой недвижимости'.' площадью от '.$farea->init_value.' м2',                                                        
                                                      'title'=>'Коммерческая недвижимость'.' площадью от '.$farea->init_value.' м2',                                                        
                                                      'grid'=>35),
                                        'link'=>array(
                                                      'text'=>'Коммерческая недвижимость'.' площадью от '.$farea->init_value.' м2',                                                        
                                                    'title'=>'Аренда коммерческой недвижимости'.' площадью от '.$farea->init_value.' м2',                                                        
                                                    'alt'=>'Аренда коммерческой недвижимости'.' площадью от '.$farea->init_value.' м2',                                                        
                                        ),    
                                        'lid'=>'35'.str_pad($farea->id.'0', '11', '0',STR_PAD_LEFT)); 
                                        
                    //$vidsfrom = RealestateVids::model()->with(array('realestates'=>array('select'=>false)))->findAll(array('select'=>'t.id,t.namewhats','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( realestates.area>='.$farea->init_value.')'));
                    $vidsfrom = RealestateVids::model()->with(array('realestates'=>array('select'=>false)))->findAll(array('select'=>'t.id,t.nameov','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( realestates.area>='.$farea->init_value.')'));
                    foreach($vidsfrom as $vid) {
                        $list_area_fromvips[] = array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/areaFrom/'.$farea->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/areas',array('id'=>$farea->id, 'property'=>'vid', 'pid'=>$vid->id)),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array(//'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью от '.$farea->init_value.' м2',
                                           'title' => $vid->nameov.' площадью от '.$farea->init_value.' м2',
                                            'grid' => intval('35'.str_pad($farea->id.'0', '11', '0',STR_PAD_LEFT))),
                            'link'=>array(  'text' => $vid->nameov.' площадью от '.$farea->init_value.' м2',
                                             'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью от '.$farea->init_value.' м2',
                                           'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью от '.$farea->init_value.' м2',
                            ),                            
                            'lid'=>'35'.str_pad($farea->id.'0', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                        );                    
                    } 
                    //До
                    $list_fareas_to[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/areaTo',array('id'=>$farea->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда коммерческой недвижимости'.' площадью до '.$farea->final_value.' м2',
                                                       'title' => 'Коммерческая недвижимость'.' площадью до '.$farea->final_value.' м2',
                                                        'grid' => 35),
                                        'link'=>array(  'text' => 'Коммерческая недвижимость'.' площадью до '.$farea->final_value.' м2',
                                                         'alt' => 'Аренда коммерческой недвижимости'.' площадью до '.$farea->final_value.' м2',
                                                       'title' => 'Аренда коммерческой недвижимости'.' площадью до '.$farea->final_value.' м2',
                                        ),                         
                                        'lid'=>'35'.str_pad($farea->id.'2', '11', '0',STR_PAD_LEFT));
                    
                    //$vidsto = RealestateVids::model()->with(array('realestates'=>array('select'=>false)))->findAll(array('select'=>'t.id,t.namewhats','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( realestates.area<='.$farea->final_value.')'));
                    $vidsto = RealestateVids::model()->with(array('realestates'=>array('select'=>false)))->findAll(array('select'=>'t.id,t.nameov,t.namewhats','condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL)) AND ((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( realestates.area<='.$farea->final_value.')'));
                    foreach($vidsto as $vid) {
                         $list_area_tovips[] = array(
                             'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/areaTo/'.$farea->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/areas',array('id'=>$farea->id, 'property'=>'vid', 'pid'=>$vid->id)),
                             'frequency'=>'daily',
                             'priority'=>'0.8',               
                             'attr'=>array(//'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью до '.$farea->final_value.' м2',                                               
                                            'title' => $vid->nameov.' площадью до '.$farea->final_value.' м2',                                               
                                             'grid' => intval('35'.str_pad($farea->id.'2', '11', '0',STR_PAD_LEFT))),
                             'link'=>array(  'text' => $vid->nameov.' площадью до '.$farea->final_value.' м2',
                                              'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью до '.$farea->final_value.' м2',
                                            'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' в Москве площадью до '.$farea->final_value.' м2',
                             ),                              
                             'lid'=>'35'.str_pad($farea->id.'2', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                         );                    
                    }*/             
               }                                                
                     
            }      
                                        
            /* Комерческая недвижимость по арендной ставке */
            $list_fstavkas = array();
            
            $fstavkas = FstavkaOffers::model()->sitemap()->findAll(array('condition'=>'t.valute_id=2'));                                          
            //$fstavkas = FstavkaOffers::model()->findAll(array('condition'=>'t.valute_id=2'));                                          
            
            $model = Valutes::model()->findByPk(2);            
            
            Yii::app()->currency->to = $model->title;
            $curr = Yii::app()->currency->from; // Сохраняем курсы
                    
            $ainfo_curs = $this->__isCurs();                                        
            Yii::app()->currency->from =$ainfo_curs;  
            Yii::app()->currency->timeCacheComp = 0;
            Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
            Yii::app()->currency->init();
                    
            Yii::app()->currency->from=$curr; // Востанавливаем курсы                                            
                
            
            /* Виды недвижимости по арендной ставке */
            $list_stavka_vips = array();                                         
            
            foreach ( $fstavkas as $key=>$fstavka ) {                                                           
                
                if (!empty($ainfo_curs)) {
                           //if (stavka) {
                             $home_sel = "";//IF( v.title='".Yii::app()->currency->to."', t.price,";
                             $end_sel = "";
                             foreach ( $ainfo_curs as $akey=>$val) {
                                  $home_sel.= "IF( v.title='".$val["name"]."', t.price*".Yii::app()->currency->$val["name"]." ,";// t.price)) as `price`';
                                  $end_sel.= ")";
                             }     
                             $home_sel.= " t.price"; 
                             $select = $home_sel.$end_sel;                             
                             $realestates = new Realestates();
                             $realestates->valute_id = null;
                             $condition = $select.' BETWEEN '. $fstavka->init_value.' AND '.$fstavka->final_value;
                             $realestates->getDbCriteria()->addCondition($condition);                                                                        
                             $realestates->getDbCriteria()->join= ' LEFT JOIN valutes v on v.id=t.valute_id '; 
               } else {
                             $realestates->getDbCriteria()->addBetweenCondition('price', $fstavka->init_value, $fstavka->final_value);        
               }                  
            
               $is_freals = $realestates->exists('((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
               if ($is_freals) {       
                   // Между
                   $list_fstavkas[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/stavka',array('id'=>$fstavka->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда '.' по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',                                                      
                                                       'title' => 'Комерческая недвижимость по арендной ставка от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',                                                      
                                                        'grid' => 37),
                                        'link'=>array(  'text' => 'Комерческая недвижимость по арендной ставка от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                                                         'alt' => 'Аренда по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                                                       'title' => 'Аренда по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                                        ),
                                        'lid'=>'37'.str_pad($fstavka->id.'1', '11', '0',STR_PAD_LEFT)
                                    );                    
                   //$vids = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false/*,'joinType'=>'LEFT JOIN','condition'=>'v.id=realestates.valute_id'*/,'alias'=>'v')))
                   //       ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).' between '.$fstavka->init_value.' AND '.$fstavka->final_value.')',
                   //                       'select'=>'t.namewhats,t.id'));                        
                   $vids = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false/*,'joinType'=>'LEFT JOIN','condition'=>'v.id=realestates.valute_id'*/,'alias'=>'v')))
                          ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).' between '.$fstavka->init_value.' AND '.$fstavka->final_value.')',
                                          'select'=>'t.nameov,t.namewhats,t.id'));                         
                   foreach($vids as $vid) {
                         $list_stavka_vips[] = array(
                             'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/stavka/'.$fstavka->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/stavka',array('id'=>$fstavka->id, 'property'=>'vid', 'pid'=>$vid->id)),
                             'frequency'=>'daily',
                             'priority'=>'0.8',               
                             'attr'=>array(//'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по './*арендной */'ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                                            'title' => $vid->nameov.' по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',                                                
                                             'grid' => intval('37'.str_pad($fstavka->id.'1', '11', '0',STR_PAD_LEFT))),
                             'link'=>array(  'text' => $vid->nameov.' по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                                              'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                                            'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по арендной ставке от '.$fstavka->init_value.' руб. до '.$fstavka->final_value.' руб.',
                             ),                              
                             'lid'=>'37'.str_pad($fstavka->id.'1', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                         );
                   }
                   
                   /*/ От
                   $list_fstavkas_from[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/stavkaFrom',array('id'=>$fstavka->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда '.' по арендной ставке от '.$fstavka->init_value.' руб.',
                                                       'title' => 'Коммерческая недвижимость'.' по арендной ставке от '.$fstavka->init_value.' руб.',
                                                        'grid' => 37),
                                        'link'=>array(  'text' => 'Коммерческая недвижимость'.' по арендной ставке от '.$fstavka->init_value.' руб.',
                                                         'alt' => 'Аренда по арендной ставке от '.$fstavka->init_value.' руб.',
                                                       'title' => 'Аренда по арендной ставке от '.$fstavka->init_value.' руб.',
                                        ),                        
                                        'lid'=>'37'.str_pad($fstavka->id.'0', '11', '0',STR_PAD_LEFT)
                                    );                    
                   //$vidsfrom = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,
                    //'joinType'=>'LEFT JOIN','condition'=>'v.id=realestates.valute_id',
                    //    'alias'=>'v')))                    
                   //       ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).' >= '.$fstavka->init_value.')',
                   //                       'select'=>'t.namewhats,t.id'));                        
                   
                   $vidsfrom = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,
                    //'joinType'=>'LEFT JOIN','condition'=>'v.id=realestates.valute_id',
                    'alias'=>'v')))                    
                          ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).' >= '.$fstavka->init_value.')',
                                          'select'=>'t.nameov,t.namewhats,t.id'));                         
                   foreach($vidsfrom as $vid) {
                         $list_stavka_fromvips[] = array(
                             'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/stavkaFrom/'.$fstavka->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/stavka',array('id'=>$fstavka->id, 'property'=>'vid', 'pid'=>$vid->id)),
                             'frequency'=>'daily',
                             'priority'=>'0.8',               
                             'attr'=>array(//'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по '
                                            .//арендной 
                                            'ставке от '.$fstavka->init_value.' руб.',                                                                    
                                            'title' => $vid->nameov.' по арендной ставке от '.$fstavka->init_value.' руб.',                                                
                                             'grid' => intval('37'.str_pad($fstavka->id.'0', '11', '0',STR_PAD_LEFT))),
                             'link'=>array(  'text' => $vid->nameov.' по арендной ставке от '.$fstavka->init_value.' руб.',
                                              'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по '
                                                .//арендной 
                                                'ставке от '.$fstavka->init_value.' руб.',                    
                                            'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по '
                                                .//арендной 
                                                'ставке от '.$fstavka->init_value.' руб.',
                    
                             ),                              
                             'lid'=>'37'.str_pad($fstavka->id.'0', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                         );
                   }
                   // До
                   $list_fstavkas_to[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/stavkaTo',array('id'=>$fstavka->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда '.' по арендной ставке до '.$fstavka->final_value.' руб.',                                                       
                                                       'title' => 'Коммерческая недвижимость'.' по арендной ставке до '.$fstavka->final_value.' руб.',                                                       
                                                        'grid' => 37),
                                        'link'=>array(  'text' => 'Коммерческая недвижимость'.' по арендной ставке до '.$fstavka->final_value.' руб.',
                                                         'alt' => 'Аренда по арендной ставке до '.$fstavka->final_value.' руб.',
                                                       'title' => 'Аренда по арендной ставке до '.$fstavka->final_value.' руб.',
                                        ),                       
                                        'lid'=>'37'.str_pad($fstavka->id.'2', '11', '0',STR_PAD_LEFT)
                                    );                        
                   //$vidsto = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,
                    //'joinType'=>'LEFT JOIN','condition'=>'v.id=realestates.valute_id',
                                              'alias'=>'v')))                    
                   //       ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).'<='.$fstavka->final_value.')',
                   //                       'select'=>'t.namewhats,t.id'));                        
                   $vidsto = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,
                    //'joinType'=>'LEFT JOIN','condition'=>'v.id=realestates.valute_id',
                      'alias'=>'v')))                    
                          ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).'<='.$fstavka->final_value.')',
                                          'select'=>'t.nameov,t.id'));                         
                   foreach($vidsto as $vid) {
                         $list_stavka_tovips[] = array(
                             'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/stavkaTo/'.$fstavka->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/stavka',array('id'=>$fstavka->id, 'property'=>'vid', 'pid'=>$vid->id)),
                             'frequency'=>'daily',
                             'priority'=>'0.8',               
                             'attr'=>array(//'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по '
                                          .//арендной 'ставке до '.$fstavka->final_value.' руб.',                    
                                            'title' => $vid->nameov.' по арендной ставке до '.$fstavka->final_value.' руб.',
                                             'grid' => intval('37'.str_pad($fstavka->id.'2', '11', '0',STR_PAD_LEFT))),
                             'link'=>array(  'text' => $vid->nameov.' по арендной ставке до '.$fstavka->final_value.' руб.',
                                              'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по арендной ставке до '.$fstavka->final_value.' руб.',
                                            'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' по арендной ставке до '.$fstavka->final_value.' руб.',
                             ),                              
                             'lid'=>'37'.str_pad($fstavka->id.'2', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                         );
                   }*/
               }                             
            }  
            
            /* Комерческая недвижимость по стоимости в месяц */
            $list_fcosts = array();
            
            $fcosts = FcostOffers::model()->sitemap()->findAll(array('condition'=>'t.valute_id=2'));                                          
            //$fcosts = FcostOffers::model()->findAll(array('condition'=>'t.valute_id=2'));                                          
            
            //$model = Valutes::model()->findByPk(2);            
            
            Yii::app()->currency->to = $model->title;
            //$curr = Yii::app()->currency->from; // Сохраняем курсы
                    
            //$ainfo_curs = $this->__isCurs();                                        
            Yii::app()->currency->from =$ainfo_curs;  
            Yii::app()->currency->timeCacheComp = 0;
            Yii::app()->{Yii::app()->currency->nameCacheComp}->delete('currency');
            Yii::app()->currency->init();
                    
            Yii::app()->currency->from=$curr; // Востанавливаем курсы                                            
                
            
            //* Виды недвижимости по стоимости в месяц
            $list_cost_vips = array();                                         
            
            foreach ( $fcosts as $key=>$fcost ) {                                                           
                
                if (!empty($ainfo_curs)) {
                             $home_sel = "";//IF( v.title='".Yii::app()->currency->to."', t.price,";
                             $end_sel = "";
                             foreach ( $ainfo_curs as $akey=>$val) {
                                  $home_sel.= "IF( v.title='".$val["name"]."', t.area*t.price*".Yii::app()->currency->$val["name"]."/12 ,";// t.price)) as `price`';
                                  $end_sel.= ")";
                             }     
                             $home_sel.= " t.area*t.price/12"; 
                             $select = $home_sel.$end_sel;                             
                             $realestates = new Realestates();
                             $realestates->valute_id = null;
                             $condition = $select.' BETWEEN '. $fcost->init_value.' AND '.$fcost->final_value;
                             $realestates->getDbCriteria()->addCondition($condition);                                                                        
                             $realestates->getDbCriteria()->join= ' LEFT JOIN valutes v on v.id=t.valute_id ';
               } else {
                             $realestates->getDbCriteria()->addBetweenCondition('t.area*t.price/12', $fcost->init_value, $fcost->final_value);   
               }                  
            
               $is_freals = $realestates->exists('((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))');
               if ($is_freals) {          
                   // Между
                   $list_fcosts[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/cost',array('id'=>$fcost->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=>'Аренда '.'стоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',                                                       
                                                       'title' => 'Коммерческая недвижимость '.'стоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',                                                       
                                                        'grid' => 36),
                                        'link'=>array(  'text' => 'Коммерческая недвижимость '.'стоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                                         'alt' => 'Аренда стоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                                       'title' => 'Аренда стоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                        ),                          
                                        'lid'=>'36'.str_pad($fcost->id.'1', '11', '0',STR_PAD_LEFT)
                                    ); 

                   //$vids = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,/*'condition'=>'v.id=realestates.valute_id',*/'alias'=>'v')))
                   //               ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).' between '.$fcost->init_value.' AND '.$fcost->final_value.')',
                   //                               'select'=>'t.namewhats,t.id'));                                       
                   $vids = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,/*'condition'=>'v.id=realestates.valute_id',*/'alias'=>'v')))
                                  ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).' between '.$fcost->init_value.' AND '.$fcost->final_value.')',
                                                  'select'=>'t.nameov,t.namewhats,t.id'));                                                          
                   foreach($vids as $vid) {
                       $list_cost_vips[] = array(
                           'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/cost/'.$fcost->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/cost',array('id'=>$fcost->id, 'property'=>'vid', 'pid'=>$vid->id)),
                           'frequency'=>'daily',
                           'priority'=>'0.8',               
                           'attr'=>array( //'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                          'title' => $vid->nameov.' cтоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                           'grid' => intval('36'.str_pad($fcost->id.'1', '11', '0',STR_PAD_LEFT))),                           
                           'link'=>array(  'text' => $vid->nameov.' cтоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                            'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                                          'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью от '.$fcost->init_value.' руб. до '.$fcost->final_value.' руб.',
                           ),                            
                           'lid'=>'36'.str_pad($fcost->id.'1', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                     );
                  }
                  /* От
                  $list_fcosts_from[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/costFrom',array('id'=>$fcost->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array(//'title'=> 'Аренда '.'стоимостью от '.$fcost->init_value.' руб.',                                         
                                                       'title' => 'Коммерческая недвижимость'.' стоимостью от '.$fcost->init_value.' руб.',                                         
                                                        'grid' => 36),
                                        'link'=>array(  'text' => 'Коммерческая недвижимость'.' стоимостью от '.$fcost->init_value.' руб.',
                                                         'alt' => 'Аренда стоимостью от '.$fcost->init_value.' руб.',
                                                       'title' => 'Аренда стоимостью от '.$fcost->init_value.' руб.',
                                        ),                       
                                        'lid'=>'36'.str_pad($fcost->id.'0', '11', '0',STR_PAD_LEFT)
                                    ); 

                   //$vidsfrom = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,
                   //'condition'=>'v.id=realestates.valute_id',
                   'alias'=>'v')))                   
                   
                   //               ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).'>='.$fcost->init_value.')',
                   //                               'select'=>'t.namewhats,t.id'));                                       
                   $vidsfrom = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,
                   //'condition'=>'v.id=realestates.valute_id',
                   'alias'=>'v')))                   
                                  ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).'>='.$fcost->init_value.')',
                                                  'select'=>'t.nameov,t.namewhats,t.id'));                                                          
                   foreach($vidsfrom as $vid) {
                       $list_cost_fromvips[] = array(
                           'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/costFrom/'.$fcost->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/cost',array('id'=>$fcost->id, 'property'=>'vid', 'pid'=>$vid->id)),
                           'frequency'=>'daily',
                           'priority'=>'0.8',               
                           'attr'=>array( //'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью от '.$fcost->init_value.' руб.',
                                          'title' => $vid->nameov.' cтоимостью от '.$fcost->init_value.' руб.',
                                           'grid' => intval('36'.str_pad($fcost->id.'0', '11', '0',STR_PAD_LEFT))),
                           'link'=>array(  'text' => $vid->nameov.' cтоимостью от '.$fcost->init_value.' руб.',
                                            'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью от '.$fcost->init_value.' руб.',
                                          'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью от '.$fcost->init_value.' руб.',
                           ),                            
                           'lid'=>'36'.str_pad($fcost->id.'0', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                     );
                  }
                  // До
                  $list_fcosts_to[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/costTo',array('id'=>$fcost->id)),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array( //'title'=>'Аренда '.'стоимостью до '.$fcost->final_value.' руб.',                                                        
                                                       'title'=>'Коммерческая недвижимость '.'стоимостью до '.$fcost->final_value.' руб.',
                                                       'grid'=>36),
                                        'link'=>array(  'text' => 'Коммерческая недвижимость '.'стоимостью до '.$fcost->final_value.' руб.',
                                                         'alt' => 'Аренда коммерческой недвижимости стоимостью до '.$fcost->final_value.' руб.',
                                                       'title' => 'Аренда коммерческой недвижимости стоимостью до '.$fcost->final_value.' руб.',
                                        ),                        
                                        'lid'=>'36'.str_pad($fcost->id.'2', '11', '0',STR_PAD_LEFT)
                                    ); 

                   //$vidsto = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,
                   //'condition'=>'v.id=realestates.valute_id',
                   'alias'=>'v')))                                      
                   //               ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).'<='.$fcost->final_value.')',
                   //                               'select'=>'t.namewhats,t.id'));                                       
                   $vidsto = RealestateVids::model()->with(array('realestates'=>array('select'=>false),'realestates.valute'=>array('select'=>false,
                   //'condition'=>'v.id=realestates.valute_id',
                   'alias'=>'v')))                   
                                  ->findAll(array('condition'=>'((realestates.act=1)OR(realestates.act is NULL))AND((realestates.del=0)OR(realestates.del is NULL)) AND ( '.str_replace('t.','realestates.',$select).'<='.$fcost->final_value.')',
                                                  'select'=>'t.nameov,t.namewhats,t.id'));                                                          
                   foreach($vidsto as $vid) {
                       $list_cost_tovips[] = array(
                           'loc'=> Yii::app()->createAbsoluteUrl('/ru/realestates/costTo/'.$fcost->id.'/vid/'.$vid->id),//Yii::app()->createUrl('/realestates/cost',array('id'=>$fcost->id, 'property'=>'vid', 'pid'=>$vid->id)),
                           'frequency'=>'daily',
                           'priority'=>'0.8',               
                           'attr'=>array( //'title'=>' Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью до '.$fcost->final_value.' руб.',
                                          'title'=> $vid->nameov.' cтоимостью до '.$fcost->final_value.' руб.',
                                          'grid' => intval('36'.str_pad($fcost->id.'2', '11', '0',STR_PAD_LEFT))),
                           'link'=>array( 'text' => $vid->nameov.' cтоимостью до '.$fcost->final_value.' руб.',
                                           'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью до '.$fcost->final_value.' руб.',
                                         'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' cтоимостью до '.$fcost->final_value.' руб.',
                           ),                            
                           'lid'=>'36'.str_pad($fcost->id.'2', '11', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT),
                     );
                  }*/
               }               
            }                           
            
            $remoteness = Realestates::model()->findAll(array('condition'=>'t.unit_id IS NOT NULL AND ((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))','group'=>'t.unit_id,t.remoteness','order'=>'t.unit_id,t.remoteness asc',
                                                              'select'=>'t.id,t.remoteness,t.unit_id'));
            $remotenessAll = Realestates::model()->findAll(array('condition'=>'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))','group'=>'t.remoteness','order'=>'t.remoteness asc',
                                                                 'select'=>'t.id,t.remoteness,remoteness'));
         
            $list_remoteness[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/unit'),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array( //'title' => 'Аренда коммерческой недвижимости в минутах, все типы удаленности',
                                                       'title' => 'Коммерческая недвижимость от метро в минутах, по способу',
                                                        'grid' => 30),
                                        'link'=>array( 'text' => 'Коммерческая недвижимость от метро в минутах, по способу',
                                                        'alt' => 'Аренда коммерческой недвижимости от метро в минутах, по способу',
                                                      'title' => 'Аренда коммерческой недвижимости от метро в минутах, по способу',
                                        ),                
                                        'lid'=>'300000000000'.'0'
            ); 
                                    
            foreach ( $remoteness as $key=>$remotenes ) {                                
                 $list_remoteness[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/unit/',($remotenes->unit->id ? array('remotenes'=>round($remotenes->remoteness),'id'=>$remotenes->unit->id) : array('remotenes'=>round($remotenes->remoteness)))),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array( //'title'=>'Аренда от метро в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.")",                                                       
                                                       'title'=>'Коммерческая недвижимость в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.") от метро",
                                                       'grid'=>intval('300000000000'.$remotenes->unit->id)),
                                        'link'=>array( 'text' => 'Коммерческая недвижимость в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.") от метро",
                                                        'alt' => 'Аренда от метро в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.")",
                                                      'title' => 'Аренда от метро в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.")",
                                        ),                     
                                        'lid'=>'300000000000'.$remotenes->unit->id.str_pad(round($remotenes->remoteness), '3', '0',STR_PAD_LEFT)
                 ); 
                 
                 //$vids = RealestateVids::model()->sitemap_noexreal()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.unit_id='.$remotenes->unit->id.' AND realestates.remoteness='.round($remotenes->remoteness)));                 
                 $vids = RealestateVids::model()->sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.unit_id='.$remotenes->unit->id.' AND realestates.remoteness='.round($remotenes->remoteness)));                 
                 foreach($vids as $vid) {
                        $list_rems_vips[] = array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/unit/',($remotenes->unit->id ? array('remotenes'=>round($remotenes->remoteness),'id'=>$remotenes->unit->id, 'vid'=>$vid->id) : array('remotenes'=>round($remotenes->remoteness),'vid'=>$vid->id))),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' от метро '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.")",                                           
                                            'title'=>$vid->nameov.', в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.") от метро",                                           
                                             'grid'=>intval('300000000000'.$remotenes->unit->id.str_pad(round($remotenes->remoteness), '3', '0',STR_PAD_LEFT))),
                            'link'=>array( 'text' => $vid->nameov.', в '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.") от метро",
                                            'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' от метро '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.")",
                                          'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').' от метро '.round($remotenes->remoteness).' минуте(ах) '.$remotenes->unit->abbr." (".$remotenes->unit->short_title.")",
                            ),                               
                            'lid'=>'300000000000'.$remotenes->unit->id.str_pad(round($remotenes->remoteness), '3', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT)                            
                        );
                 }
            }
            
            foreach ( $remotenessAll as $key=>$remotenes ) {                                
                 $list_remoteness[] = array(
                                        'loc'=> Yii::app()->createAbsoluteUrl('/realestates/unit/', array('remotenes'=>round($remotenes->remoteness))),
                                        'frequency'=>'daily',
                                        'priority'=>'0.8',                                                 
                                        'attr'=>array( //'title'=>'Аренда коммерческой недвижимости с удаленностью от метро '.round($remotenes->remoteness).' мин.',                                                               
                                                       'title'=> 'Коммерческая недвижимость в '.round($remotenes->remoteness).' мин. от метро',                                                               
                                                       'grid'=>3000000000000),
                                        'link'=>array( 'text' => 'Коммерческая недвижимость в '.round($remotenes->remoteness).' мин. от метро',
                                                        'alt' => 'Аренда коммерческой недвижимости с удаленностью от метро '.round($remotenes->remoteness).' мин.',
                                                      'title' => 'Аренда коммерческой недвижимости с удаленностью от метро '.round($remotenes->remoteness).' мин.',
                                        ),                     
                                        'lid'=>'300000000000'.'0'.str_pad(round($remotenes->remoteness), '3', '0',STR_PAD_LEFT)
                 );
                 
                 //$vids = RealestateVids::model()->sitemap_noexreal()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.remoteness='.round($remotenes->remoteness)));                         
                 $vids = RealestateVids::model()->sitemap_noexrealOv()->with(array('realestates'=>array('select'=>false)))->findAll(array('condition'=>'realestates.remoteness='.round($remotenes->remoteness)));                         
                 foreach($vids as $vid) {
                        $list_remas_vips[] = array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/unit/',array('remotenes'=>round($remotenes->remoteness),'vid'=>$vid->id)),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array(//'title'=>'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').", c удаленностью от метро ".round($remotenes->remoteness).' мин.',
                                          'title' => $vid->nameov.", в ".round($remotenes->remoteness).' мин. от метро',
                                           'grid' => intval('300000000000'.'0'.str_pad(round($remotenes->remoteness), '3', '0',STR_PAD_LEFT))),
                            'link'=>array( 'text' => $vid->nameov.", в ".round($remotenes->remoteness).' мин. от метро',
                                            'alt' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').", c удаленностью от метро ".round($remotenes->remoteness).' мин.',
                                          'title' => 'Аренда '.mb_strtolower($vid->namewhats,'UTF-8').", c удаленностью от метро ".round($remotenes->remoteness).' мин.',
                            ),                            
                            'lid'=>'300000000000'.'0'.str_pad(round($remotenes->remoteness), '3', '0',STR_PAD_LEFT).str_pad($vid->id, '11', '0',STR_PAD_LEFT)                            
                        );
                 }
            }
            
            $list = array(
                        // Главная страница
                        array(
                            'loc'=>Yii::app()->createAbsoluteUrl('/'),
                            'frequency'=>'weekly',
                            'priority'=>'1',
                            'attr'=>array('title'=>Yii::t('menu','Главная'),'grid'=>null),
                            'lid'=>'01'
                            ),
                        // Страница - Контакт    
                        array(
                            'loc'=>Yii::app()->createAbsoluteUrl('/site/contact'),
                            'frequency'=>'yearly',
                            'priority'=>'0.8',
                            'attr'=>array('title'=>Yii::t('menu','Контакт'),'grid'=>null),
                            'lid'=>'05'
                            ),
                        // Страница - Избранное    
                        /*array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/favs'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',                            
                            'attr'=>array('title'=>Yii::t('menu','Избранное'),'grid'=>null),
                            'lid'=>'06'
                        ),*/
                        // Страница - Каталог недвижимости все классы
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/class'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости все классы'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по классам'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по классам'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по классам'),
                                          'title' =>Yii::t('menu','Аренда коммерческая недвижимости Москвы, по классам'),         
                                         ),
                            'lid'=>'15'
                        ),       
                        // Страница - Каталог недвижимости все виды
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/vid'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости все виды '),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по видам '),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по видам'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по видам'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по видам'),         
                                         ),
                            'lid'=>'16'
                        ),                 
                        // Страница - Каталог недвижимости все районы
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/district'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',                                           
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости, все административные округа'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость, по административным округам'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по административным округам'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по административным округам'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по административным округам'),         
                                         ),
                            'lid'=>'17'
                        ),  
                        // Страница - Каталог недвижимости все районы
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/areas'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, все районы'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость, по районам'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по районам'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по районам'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по районам'),         
                                         ),
                            'lid'=>'38'
                        ),        
                        // Страница - Каталог недвижимости все районы
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/taxReference'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости все ИФСН'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость, по ИФСН'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость, по ИФСН'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по ИФСН'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по ИФСН'),         
                                         ),                            
                            'lid'=>'39'
                        ),                    
                        // Страница - Каталог недвижимости по назначению
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/destination'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, все назначения'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость, по назначениям'),'grid'=>null),                            
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость, по назначениям'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по назначениям'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по назначениям'),         
                                         ),                                                        
                            'lid'=>'21'
                        ),          
                        // Страница - Каталог недвижимости по свойствам
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/property'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, по свойствам'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческой недвижимость, по свойствам'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческой недвижимость, по свойствам'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по свойствам'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы, по свойствам'),         
                                         ),                             
                            'lid'=>'22'
                        ),                
                        // Страница - Каталог недвижимости c отдельным входом
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/entranceon'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Аренда коммерческой недвижимости Москвы с отдельным входом'),'grid'=>22),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость с отдельным входом'),'grid'=>22),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость с отдельным входом'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы с отдельным входом'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы с отдельным входом'),         
                                         ),  
                            'lid'=>'22'.str_pad(1,'2', '0',STR_PAD_LEFT)
                        ),           
                        // Страница - Каталог недвижимости без отдельного входа
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/entranceoff'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Аренда коммерческой недвижимости Москвы без отдельного входа'),'grid'=>22),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческой недвижимость без отдельного входа'),'grid'=>22),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость без отдельного входа'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы без отдельного входа'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы без отдельного входа'),         
                                         ),  
                            'lid'=>'22'.str_pad(2,'2', '0',STR_PAD_LEFT)
                        ),                    
                        // Страница - Каталог недвижимости по типу
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/type'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',                                
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости по аренде в зданиях Москвы'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по размещению'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по размещению'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по размещению'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по размещению'),         
                                         ),  
                            'lid'=>'31'
                        ),                       
                        /* Страница - Каталог недвижимости по операциям
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/operation'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array('title'=>Yii::t('menu','Каталог недвижимости по операциям'),'grid'=>null),
                            'lid'=>'23'
                        ),*/   
                        // Страница - Каталог недвижимости по планировке
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/planning'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы по планировке'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по планировке'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по планировке'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по планировке'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по планировке'),         
                                         ),
                            'lid'=>'24'
                        ),          
                        // Страница - Каталог недвижимости по налогооблажению
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/tax'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы по налогооблажению'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по налогооблажению'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по налогооблажению'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по налогооблажению'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по налогооблажению'),         
                                         ),
                            'lid'=>'25'
                        ),    
                        // Страница - Каталог недвижимости по комиссии
                        /*array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/commission'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог недвижимости по комиссии'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Комерческая недвижимость по комиссии'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по комиссии'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по комиссии'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по комиссии'),         
                            ),                         
                            'lid'=>'27'
                        ),*/                 
                        // Страница - Каталог недвижимости по парковке
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/parking'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы по парковке'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по парковке'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по парковке'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по парковке'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по парковке'),         
                                         ),                            
                            'lid'=>'28'
                        ),                                  
                        // Страница - Каталог недвижимости все валюты
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/valute'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, все валюты'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по валюте аренды'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по валюте аренды'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по валюте аренды'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по валюте аренды'),         
                                         ),                            
                            'lid'=>'18'
                        ),  
                        // Страница - Каталог недвижимости все улицы
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/street'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, все улицы'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по улицам'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по улицам'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости по улицам Москвы'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости по улицам Москвы'),         
                                         ),                            
                            'lid'=>'19'
                        ),                       
                        // Страница - Каталог недвижимости все станции метро
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/metro'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, все станции метро'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по станциям метро'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по станциям метро'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости по станциям метро Москвы'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости по станциям метро Москвы'),         
                                         ),                              
                            'lid'=>'20'
                        ),     
                
                        // Страница - Каталог недвижимости все станции метро
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/unit'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости Москвы, в минутах от метро'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по удаленности в минутах от метро'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по удаленности в минутах от метро'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости по удаленности в минутах от метро Москвы'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости по удаленности в минутах от метро Москвы'),         
                                         ),                              
                            'lid'=>'30'
                        ),               
                        // Страница - Каталог недвижимости вся площадь
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/area'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости по площади'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по площади'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по площади'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по площади'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по площади'),         
                                         ),                                
                            'lid'=>'35'
                        ),                  
                
                        // Страница - Каталог недвижимости все ставки
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/stavka'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости по арендной ставке'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по арендной ставке'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по арендной ставке'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по арендной ставке'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по арендной ставке'),         
                                         ),                                
                            'lid'=>'37'
                        ),    
                
                        // Страница - Каталог недвижимости вся стоимость
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/cost'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            //'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости по стоимости в месяц'),'grid'=>null),
                            'attr'=>array('title'=>Yii::t('menu','Коммерческая недвижимость по стоимости в месяц'),'grid'=>null),
                            'link'=>array('text'  =>Yii::t('menu','Коммерческая недвижимость по стоимости в месяц'),
                                          'alt'   =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по стоимости в месяц'),
                                          'title' =>Yii::t('menu','Аренда коммерческой недвижимости Москвы по стоимости в месяц'),         
                                         ),                                
                            'lid'=>'36'
                        ),                                    
                
                        // Страница - Каталог недвижимости
                        array(
                            'loc'=> Yii::app()->createAbsoluteUrl('/realestates/index'),
                            'frequency'=>'daily',
                            'priority'=>'0.8',               
                            'attr'=>array('title'=>Yii::t('menu','Каталог коммерческой недвижимости'),'grid'=>null),
                            'lid'=>'13'
                        ),                         
                        /*array(
                            'loc'=>Yii::app()->createAbsoluteUrl('/site/page', array('view'=>'about')),
                            'frequency'=>'monthly',
                            'priority'=>'0.8',
                            ),
                        array(
                            'loc'=>Yii::app()->createAbsoluteUrl('/site/page', array('view'=>'privacy')),
                            'frequency'=>'yearly',
                            'priority'=>'0.3',
                            ),*/
                    );
            $list = array_merge($list_coefs,$list,
                                $list_fareas, /*$list_fareas_from,$list_fareas_to,*/
                                $list_area_vips, /*$list_area_fromvips,$list_area_tovips,*/
                                $list_remoteness/*,$list_district_areas*/,
                                $list_metro_vips,$list_street_vips,$list_district_vips,$list_class_vips, $list_type_vips,
                                $list_areas_vips,
                                $list_taxrefs_vips,$list_dests_vips, 
                                $list_fstavkas, /*$list_fstavkas_from,$list_fstavkas_to,*/
                                $list_stavka_vips, /*$list_stavka_fromvips,$list_stavka_tovips,*/
                                $list_fcosts, /*$list_fcosts_from,$list_fcosts_to,*/
                                $list_cost_vips, /*$list_cost_fromvips,$list_cost_tovips,*/
                                $list_props_vips,$list_coefs_vips,$list_rems_vips,$list_remas_vips); 
            //echo "<pre>"; print_r($list); echo "</pre>";
            return $list;
        }    
        
        /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndexOld($id=null)
	{     
            $short = true;
            
            //throw new CHttpException(404,'The requested page does not exist.');
            $this->layout='//layouts/column1_thenew';
            
            if(    Yii::app()->getRequest()->getParam('Realestates_page') 
                   || Yii::app()->getRequest()->getParam('page')                 
                   || Yii::app()->getRequest()->getParam('pagerents')                  
            )
            {                         
               $href = Yii::app()->getBaseUrl(true).'/'.Yii::app()->request->getPathInfo();
               Yii::app()->clientScript->registerLinkTag('canonical', null, $href);
               unset($href);
            }   
            
            /*if ( (isset($_GET['Realestates_page']) || isset($_GET['page']) || isset($_GET['pagerents'])) && !Yii::app()->request->isAjaxRequest )
            {*/
                
                /*/ In new disange
                // @TODO Добавка к заголовку при пагинации
                $title_onreq = ( trim($_GET['Realestates_page'])<>'' ? 'рекомендуемая площадь стр.'.$_GET['page'] : '');
                $title_onreq = ($title_onreq<>'' ? ( trim($_GET['page'])<>'' ? $title_onreq.' / популярная площадь стр.'.$_GET['page'] : '') 
                                                     : ( trim($_GET['page'])<>'' ? 'популярная площадь стр.'.$_GET['page'] : ''));                
                $title_onreq = ($title_onreq<>'' ? ( trim($_GET['pagerents'])<>'' ? $title_onreq.' / сданная площадь стр.'.$_GET['pagerents'] : '') 
                                                     : ( trim($_GET['pagerents'])<>'' ? 'сданная площадь стр.'.$_GET['pagerents'] : '')); 
                //$title_onreq = ($title_onreq<>'' ? '('.$title_onreq.')' : null);
                    
                // @TODO Добавка к описанию при пагинации
                $desc_onreq = ( trim($_GET['Realestates_page'])<>'' ? 'рекомендуемая площадь стр.'.$_GET['page'] : '');
                $desc_onreq = ($desc_onreq<>'' ? ( trim($_GET['page'])<>'' ? $desc_onreq.' / популярная площадь стр.'.$_GET['page'] : '') 
                                                     : ( trim($_GET['page'])<>'' ? 'популярная площадь стр.'.$_GET['page'] : ''));                
                $desc_onreq = ($desc_onreq<>'' ? ( trim($_GET['pagerents'])<>'' ? $desc_onreq.' / сданная площадь стр.'.$_GET['pagerents'] : '') 
                                                     : ( trim($_GET['pagerents'])<>'' ? 'сданная площадь стр.'.$_GET['pagerents'] : '')); 
                //$desc_onreq = ($desc_onreq<>'' ? '('.$desc_onreq.')' : null);                    
                 
                // @TODO Добавка к ключевым словам при пагинации
                if (trim($_GET['Realestates_page'])<>'') $akeywords_onreq[] = 'рекомендуемая площадь'; 
                if (trim($_GET['page'])<>'') $akeywords_onreq[] = 'популярная площадь';
                if (trim($_GET['pagerents'])<>'') $akeywords_onreq[] = 'сданная площадь';*/                   
                
            /*    $this->redirect(Yii::app()->homeUrl);
            } */   
            
            if ($id===null) 
            {
            
               // renders the view file 'protected/views/site/index.php'
	       // using the default layout 'protected/views/layouts/main.php'               
               //if ( /*Yii::app()->user->isGuest*/ !Yii::app()->user->checkAccess('superadmin')) { 
               //     $this->layout='//layouts/default';
               //     $this->render('index');
               //}else{
                    
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
                    
                    $map = $this->_show_map_poligon($model,650,975);                
                                    
                    $fav_cnt_col = 3;
                    $fav_cnt_row = 3;
                    $recom_cnt_col = 1;
                    $recom_cnt_row = !$short ? 1 : 3;
                    $popul_cnt_col = 1;
                    $popul_cnt_row = !$short ? 1 : 3;
                    $rent_cnt_col=1;
                    $rent_cnt_row=!$short ? 1 : 3; 
                            
                    // Лучшая площадь
                    $favs = Realestates::model()->findAll( array( "condition"=>"(fav=1)  AND (t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1)", "order"=>"t.create_date desc", "limit"=>$fav_cnt_col*$fav_cnt_row));                                        
                    // Новая площадь
                    $newrealts = Realestates::model()->findAll( array( "condition"=>"(t.del IS NULL OR t.del=0)AND(t.act IS NULL OR t.act=1)", 
                                                                       //"with"=>array('picOreginal','valute','realestateVid','realestateType','district'),
                                                                       //"select"=>'t.id,t.area,t.price,t.title,t.pic_oreginal_id,picOreginal.id,picOreginal.original_name,valute.abbr,realestateVid.namewhat,realestateVid.nameed,realestateVid.nameov,district.title,realestateVid.seo_title,realestateType.nameed,realestateType.namewhere,*/   
                                                                       "order"=>"t.create_date desc", "limit"=>18));  
                    
                    // Рекламируемая площадь
                    $advrealts = Realestates:: model()->findAll( array( "condition"=>"(t.advertised=1)AND(t.del IS NULL OR t.del=0)AND(t.act IS NULL OR t.act=1)", "order"=>"t.create_date desc", "limit"=>4));  
                    
                    $arealts = array();             
                    $pic_width  ="202";
                    $pic_height ="132";
                    
                    foreach( $advrealts as $realt) {

                        if ( trim($realt->pic_oreginal_id)<>"" ) 
                        {   
                            $pathfrompic = str_replace('_original'.substr($realt->picOreginal->original_name,-4,4),
                                            '_big'.substr($realt->picOreginal->original_name,-4,4),
                                            $realt->picOreginal->original_name); 

                            $pathtopic = str_replace('_original'.substr($realt->picOreginal->original_name,-4,4),
                                              '_'.$pic_width.'x'.$pic_height.substr($realt->picOreginal->original_name,-4,4),
                                              $realt->picOreginal->original_name); 

                            $pic = '/'.$pathtopic; 

                            if( !file_exists($pic) ) {
                                $image = Yii::app()->image->load($pathfrompic);
                                /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                                $image->resize($pic_width,$pic_height,4);
                                $image->save($pathtopic); // or $image->save('images/small.jpg');
                            }
                        } else { 
                           $pic = '/images/no_foto.png';
                        }

                        $arealts[] =  array(
                                'title' => $realt->title,
                                'url' =>  Yii::app()->createUrl('realestates/view', array('id'=>$realt->id)), 
                                'image' => $pic
                        );
                    }
                    
                    /*$recoms = Realestates:: model()->findAll( array( "condition"=>"(t.recommend=1 AND fav<>1 AND (t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1))", "order"=>"t.create_date DESC", "limit"=>$recom_cnt_col*$recom_cnt_row));
                    $dataRecoms = new CArrayDataProvider($recoms, array(
                            'pagination'=>/*falsearray(
                                'pageSize'=>$recom_cnt_col*$recom_cnt_row,
                            ),)
                    );*/
                    
                    // Популярная площадь
                    $populars= Realestates:: model()->findAll( array(
                            "condition"=>"( t.cnt_view>1 
                                            AND ((t.recommend IS NULL) OR (t.recommend=0)) 
                                            AND ((t.fav IS NULL) OR (t.fav=0)) 
                                            AND ((t.rented IS NULL) OR (t.rented=0)) 
                                            AND ((t.advertised IS NULL) OR (t.advertised=0)) 
                                            AND (t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1))",
                                "order"=>"t.cnt_view DESC, t.update_date DESC", 
                                "limit"=>10/*$popul_cnt_col*$popul_cnt_row*/,
                            ));
                    $dataPopulars = new CArrayDataProvider($populars, array(
                            'pagination'=>/*false*/array(
                                'pageSize'=>$popul_cnt_col*$popul_cnt_row,
                                'pageVar' => 'page'
                            ),)
                    );
                    
                    /*$dataPopulars=new CActiveDataProvider('Realestates',array(
                            'criteria'=>array( "condition"=>"( t.cnt_view>1 AND ((t.recommend IS NULL) OR (t.recommend=0)) AND ((t.fav IS NULL) OR (t.fav=0)) AND (t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1))",
                                "order"=>"t.cnt_view DESC, t.update_date DESC", 
                                "limit"=>10/*$popul_cnt_col*$popul_cnt_row,
                            ),
                            'pagination'=>array(
                                'pageSize'=>$popul_cnt_col*$popul_cnt_row,
                            ),
                            ));*/
                    // Рекомендуемая площадь   
                    $dataRecoms=new CActiveDataProvider('Realestates',array(
                            'criteria'=>array(
                                'condition'=>'(t.recommend=1 AND t.fav<>1 AND (t.rented IS NULL OR t.rented=0) AND (t.advertised IS NULL OR t.advertised=0) AND (t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1))',
                                'order'=>/*'t.cnt_view DESC*/'t.order_rec ASC, t.create_date DESC',
                                'limit' => $recom_cnt_col*$recom_cnt_row,
                            ),
                            'pagination'=>/*false*/array(
                                'pageSize'=>$recom_cnt_col*$recom_cnt_row,
                                'pageVar' => 'Realestates_page'
                            ),
                            ));                    
                    // Проплаченная площадь
                    if ($short) {
                        $dataRents=new CActiveDataProvider('Realestates',array(
                                'criteria'=>array(
                                'condition'=>'((t.rented=1) AND (t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1))',
                                'order'=>/*'t.cnt_view DESC*/'t.order_rec ASC, t.create_date DESC',
                                'limit' => $rent_cnt_col*$rent_cnt_row,
                                ),
                               'pagination'=>/*false*/array(
                               'pageSize'=>$rent_cnt_col*$rent_cnt_row,
                               'pageVar' => 'pagerents'
                            ),
                        ));
                    }
                    
                    $this->render( 'main_thenew_old', /*'main',*/ 
                                    array( 'metros'=>$metros, 
                                           'map'=>$map,
                                           'favs'=>$favs,
                                           'fav_cnt_row'=>$fav_cnt_row,
                                           'fav_cnt_col'=>$fav_cnt_col,
                                           'dataRecoms'=>$dataRecoms,
                                           'dataPopulars'=>$dataPopulars,
                                           'dataRents'=>$dataRents,
                                           'title_onreq'=>$title_onreq, 
                                           'desc_onreq'=>$desc_onreq,
                                           'akeywords_onreq'=>$akeywords_onreq,
					   'model'=>$model,
                                           'newrealts'=>$arealts,
                                           'cascadrealts'=>$newrealts,
                                           'short'=>$short,
                                          )
                    );                    
                    //$this->redirect(Yii::app()->user->loginUrl);
              // }
            }else{
                   $this->actionShow($id); 
            }
	}               
        
        /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex($id=null)
	{     
            $short = true;
            
            //throw new CHttpException(404,'The requested page does not exist.');
            $this->layout='//layouts/column1_thenew';
            
            if(    Yii::app()->getRequest()->getParam('Realestates_page') 
                   || Yii::app()->getRequest()->getParam('page')                 
                   || Yii::app()->getRequest()->getParam('pagerents')                  
            )
            {                         
               $href = Yii::app()->getBaseUrl(true).'/'.Yii::app()->request->getPathInfo();
               Yii::app()->clientScript->registerLinkTag('canonical', null, $href);
               unset($href);
            }   
            
            /*if ( (isset($_GET['Realestates_page']) || isset($_GET['page']) || isset($_GET['pagerents'])) && !Yii::app()->request->isAjaxRequest )
            {*/
                
                /*/ In new disange
                // @TODO Добавка к заголовку при пагинации
                $title_onreq = ( trim($_GET['Realestates_page'])<>'' ? 'рекомендуемая площадь стр.'.$_GET['page'] : '');
                $title_onreq = ($title_onreq<>'' ? ( trim($_GET['page'])<>'' ? $title_onreq.' / популярная площадь стр.'.$_GET['page'] : '') 
                                                     : ( trim($_GET['page'])<>'' ? 'популярная площадь стр.'.$_GET['page'] : ''));                
                $title_onreq = ($title_onreq<>'' ? ( trim($_GET['pagerents'])<>'' ? $title_onreq.' / сданная площадь стр.'.$_GET['pagerents'] : '') 
                                                     : ( trim($_GET['pagerents'])<>'' ? 'сданная площадь стр.'.$_GET['pagerents'] : '')); 
                //$title_onreq = ($title_onreq<>'' ? '('.$title_onreq.')' : null);
                    
                // @TODO Добавка к описанию при пагинации
                $desc_onreq = ( trim($_GET['Realestates_page'])<>'' ? 'рекомендуемая площадь стр.'.$_GET['page'] : '');
                $desc_onreq = ($desc_onreq<>'' ? ( trim($_GET['page'])<>'' ? $desc_onreq.' / популярная площадь стр.'.$_GET['page'] : '') 
                                                     : ( trim($_GET['page'])<>'' ? 'популярная площадь стр.'.$_GET['page'] : ''));                
                $desc_onreq = ($desc_onreq<>'' ? ( trim($_GET['pagerents'])<>'' ? $desc_onreq.' / сданная площадь стр.'.$_GET['pagerents'] : '') 
                                                     : ( trim($_GET['pagerents'])<>'' ? 'сданная площадь стр.'.$_GET['pagerents'] : '')); 
                //$desc_onreq = ($desc_onreq<>'' ? '('.$desc_onreq.')' : null);                    
                 
                // @TODO Добавка к ключевым словам при пагинации
                if (trim($_GET['Realestates_page'])<>'') $akeywords_onreq[] = 'рекомендуемая площадь'; 
                if (trim($_GET['page'])<>'') $akeywords_onreq[] = 'популярная площадь';
                if (trim($_GET['pagerents'])<>'') $akeywords_onreq[] = 'сданная площадь';*/                   
                
            /*    $this->redirect(Yii::app()->homeUrl);
            } */   
            
            if ($id===null) 
            {
            
               // renders the view file 'protected/views/site/index.php'
	       // using the default layout 'protected/views/layouts/main.php'               
               //if ( /*Yii::app()->user->isGuest*/ !Yii::app()->user->checkAccess('superadmin')) { 
               //     $this->layout='//layouts/default';
               //     $this->render('index');
               //}else{
                    
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
                    
                    $map = $this->_show_map_poligon($model,650,975);                
                                    
                    $fav_cnt_col = 3;
                    $fav_cnt_row = 3;
                    $recom_cnt_col = 1;
                    $recom_cnt_row = !$short ? 1 : 3;
                    $popul_cnt_col = 1;
                    $popul_cnt_row = !$short ? 1 : 3;
                    $rent_cnt_col=1;
                    $rent_cnt_row=!$short ? 1 : 3; 
                            
                    // Лучшая площадь
                    $favs = Realestates::model()->realexvid(12)->findAll( array( "condition"=>"(t.fav=1)  AND (t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1)", 
                                                                  "order"=>"t.create_date desc", 
                                                                  "limit"=>$fav_cnt_col*$fav_cnt_row));                                        
                    // Новая площадь
                    $newrealts = Realestates::model()->realexvid(12)->findAll( array( "condition"=>"(t.del IS NULL OR t.del=0)AND(t.act IS NULL OR t.act=1)", 
                                                                       //"with"=>array('picOreginal','valute','realestateVid','realestateType','district'),
                                                                       //"select"=>'t.id,t.area,t.price,t.title,t.pic_oreginal_id,picOreginal.id,picOreginal.original_name,valute.abbr,realestateVid.namewhat,realestateVid.nameed,realestateVid.nameov,district.title,realestateVid.seo_title,realestateType.nameed,realestateType.namewhere,*/   
                                                                       "order"=>"t.create_date desc", "limit"=>18));  
                    
                    // Рекламируемая площадь
                    $advrealts = Realestates::model()->realexvid(12)->findAll( array( "condition"=>"(t.advertised=1)AND(t.del IS NULL OR t.del=0)AND(t.act IS NULL OR t.act=1)", "order"=>"t.create_date desc", "limit"=>4));  
                    
                    $arealts = array();             
                    $pic_width  ="202";
                    $pic_height ="132";
                    
                    foreach( $advrealts as $realt) {

                        if ( trim($realt->pic_oreginal_id)<>"" ) 
                        {   
                            $pathfrompic = str_replace('_original'.substr($realt->picOreginal->original_name,-4,4),
                                            '_big'.substr($realt->picOreginal->original_name,-4,4),
                                            $realt->picOreginal->original_name); 

                            $pathtopic = str_replace('_original'.substr($realt->picOreginal->original_name,-4,4),
                                              '_'.$pic_width.'x'.$pic_height.substr($realt->picOreginal->original_name,-4,4),
                                              $realt->picOreginal->original_name); 

                            $pic = '/'.$pathtopic; 

                            if( !file_exists($pic) ) {
                                $image = Yii::app()->image->load($pathfrompic);
                                /*$image->resize(280,100)->rotate(-45)->quality(75)->sharpen(20);*/
                                $image->resize($pic_width,$pic_height,4);
                                $image->save($pathtopic); // or $image->save('images/small.jpg');
                            }
                        } else { 
                           $pic = '/images/no_foto.png';
                        }

                        $arealts[] =  array(
                                'title' => $realt->title,
                                'url' =>  Yii::app()->createUrl('realestates/view', array('id'=>$realt->id)), 
                                'image' => $pic
                        );
                    }
                    
                    /*$recoms = Realestates:: model()->realexvid(12)->findAll( array( "condition"=>"(t.recommend=1 AND fav<>1 AND (t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1))", "order"=>"t.create_date DESC", "limit"=>$recom_cnt_col*$recom_cnt_row));
                    $dataRecoms = new CArrayDataProvider($recoms, array(
                            'pagination'=>/*falsearray(
                                'pageSize'=>$recom_cnt_col*$recom_cnt_row,
                            ),)
                    );*/
                    
                    // Популярная площадь
                    $populars= Realestates:: model()->realexvid(12)->findAll( array(
                            "condition"=>"( t.cnt_view>1 
                                            AND ((t.recommend IS NULL) OR (t.recommend=0)) 
                                            AND ((t.fav IS NULL) OR (t.fav=0)) 
                                            AND ((t.rented IS NULL) OR (t.rented=0)) 
                                            AND ((t.advertised IS NULL) OR (t.advertised=0)) 
                                            AND (t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1))",
                                "order"=>"t.cnt_view DESC, t.update_date DESC", 
                                "limit"=>10/*$popul_cnt_col*$popul_cnt_row*/,
                            ));
                    $dataPopulars = new CArrayDataProvider($populars, array(
                            'pagination'=>/*false*/array(
                                'pageSize'=>$popul_cnt_col*$popul_cnt_row,
                                'pageVar' => 'page'
                            ),)
                    );
                    
                    /*$dataPopulars=new CActiveDataProvider('Realestates',array(
                            'criteria'=>array( "condition"=>"(t.realestate_vid_id=12 AND t.cnt_view>1 AND ((t.recommend IS NULL) OR (t.recommend=0)) AND ((t.fav IS NULL) OR (t.fav=0)) AND (t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1))",
                                "order"=>"t.cnt_view DESC, t.update_date DESC", 
                                "limit"=>10/*$popul_cnt_col*$popul_cnt_row,
                            ),
                            'pagination'=>array(
                                'pageSize'=>$popul_cnt_col*$popul_cnt_row,
                            ),
                            ));*/
                    // Рекомендуемая площадь   
                    $dataRecoms=new CActiveDataProvider('Realestates',array(
                            'criteria'=>array(
                                'condition'=>'(t.realestate_vid_id=12 AND t.recommend=1 AND t.fav<>1 AND (t.rented IS NULL OR t.rented=0) AND (t.advertised IS NULL OR t.advertised=0) AND (t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1))',
                                'order'=>/*'t.cnt_view DESC*/'t.order_rec ASC, t.create_date DESC',
                                'limit' => $recom_cnt_col*$recom_cnt_row,
                            ),
                            'pagination'=>/*false*/array(
                                'pageSize'=>$recom_cnt_col*$recom_cnt_row,
                                'pageVar' => 'Realestates_page'
                            ),
                            ));                    
                    // Проплаченная площадь
                    if ($short) {
                        $dataRents=new CActiveDataProvider('Realestates',array(
                                'criteria'=>array(
                                'condition'=>'(t.realestate_vid_id=12 AND (t.rented=1) AND (t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1))',
                                'order'=>/*'t.cnt_view DESC*/'t.order_rec ASC, t.create_date DESC',
                                'limit' => $rent_cnt_col*$rent_cnt_row,
                                ),
                               'pagination'=>/*false*/array(
                               'pageSize'=>$rent_cnt_col*$rent_cnt_row,
                               'pageVar' => 'pagerents'
                            ),
                        ));
                    }
                    $model_claim=new ClaimSendForm;
                    $this->render( 'main_thenew', /*'main',*/ 
                                    array( 'metros'=>$metros, 
                                           'map'=>$map,
                                           'favs'=>$favs,
                                           'fav_cnt_row'=>$fav_cnt_row,
                                           'fav_cnt_col'=>$fav_cnt_col,
                                           'dataRecoms'=>$dataRecoms,
                                           'dataPopulars'=>$dataPopulars,
                                           'dataRents'=>$dataRents,
                                           'title_onreq'=>$title_onreq, 
                                           'desc_onreq'=>$desc_onreq,
                                           'akeywords_onreq'=>$akeywords_onreq,
					   'model'=>$model,
                                           'model_claim'=>$model_claim, 
                                           'newrealts'=>$arealts,
                                           'cascadrealts'=>$newrealts,
                                           'short'=>$short,
                                          )
                    );                    
                    //$this->redirect(Yii::app()->user->loginUrl);
              // }
            }else{
                   $this->actionShow($id); 
            }
	}        
        
        /**
	 * This is the 'Owners' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionOwners()
	{
            $this->render( 'owners');
        }
               
        protected function _show_map_poligon($model, $width=null, $height=null) {
                                               
            Yii::import('ext.EGMap.*');
            
            Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/polygon/polygon.core.js');            
            
            $gMap = new EGMap();
            
            if ($width==null) :
                $gMap->setWidth(932);
            else: 
                $gMap->setWidth($width);
            endif;
            
            if ($height==null) :
                $gMap->setHeight(420);            
            else:
                $gMap->setHeight($height);            
            endif;
            /*$gMap->setAPIKey('http://pp.rtvs.net', 'ABQIAAAAuKTQCaAmRIZm8fpzMcomXRSjgd74L9WyZO8Sjj0ClzXDGx3dYxQN2iImmF-UZzmvUG1oogyiwpW3eQ');*/
            $gMap->setAPIKey('pegasrealty.ru', 'AIzaSyDu-9PAa4Wjo64NrGGwjuxdIQhxGV1XTw8'); 
            $gMap->zoom = 14;
            $gMap->minZoom = 14;
            $gMap->mapTypeId = EGMap::TYPE_ROADMAP;
            $gMap->mapTypeControlOptions = array(
                    'position'=> EGMapControlPosition::RIGHT_TOP,
                    'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
            );
            
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
            
            // Saving coordinates after polygons.
            $gMap->appendMapTo('#mapsearch');                          
            
            return $gMap;

        }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	                $this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
         */	
	public function actionContact()
	{                
		$model=new ContactForm;
                
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
                                $body ='';
                                if (trim($model->phone)<>"") $body.= "Телефон: ".$model->phone."; \r\n";
                                if (trim($model->email)<>"") $body.= "E-mail : ".$model->email."; \r\n";
                                $model->body = $body.$model->body;
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact',Yii::t('all', 'Cпасибо за обращение. Мы в ближайшее время свяжимся с Вами!'));//,'Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

        
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
         * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        /**
	 * Show element info block's.
         * @params $rid - ID element info block's
         * @params $tid - ID type element info block's
	 */
	public function actionShowRid( $rid=null, $is_uid=false )
	{            
            
            if ( $rid<>null ) 
            {
                /* If ID element not unique in word && User as SuperAdmin */
                if ( $is_uid ) : /* If ID element unique in word */                   
                    $item = Iblocks::model()->find("uid='".$rid."' and ((act=1)OR(act IS NULL))");                                                
                else : 
                    $item = Iblocks::model()->find("id=".$rid." and ((act=1)OR(act IS NULL))");        
                endif;
                    
                if ( Yii::app()->user->checkAccess('superadmin') ) :
                    if ( !$item ) {
                        //$this->redirect(Yii::app()->homeUrl);
                        Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots');
                        throw new CHttpException(404,'The requested page does not exist.'); 
                    }
                    
                    if ( Yii::app()->theme<>'' ) :
                        $pathToIcons = Yii::app()->theme->baseUrl;
                    else :
                        $pathToIcons = Yii::app()->request->baseUrl;
                    endif;
                    
                    $linkViewItem    = CHtml::link( 
                                        CHtml::image($pathToIcons.'/images/view_item.png', 'Просмотр елемента'),
                                         array('iblocks/view','id'=>$rid)
                                      );
                    
                    $linkAddItem    = CHtml::link( 
                                        CHtml::image($pathToIcons.'/images/add_item.png', 'Добавление елемента'),
                                         array('iblocks/create')
                                      );
                    $linkEditItem   = CHtml::link( 
                                        CHtml::image($pathToIcons.'/images/edit_item.png', 'Редактирование елемента'),
                                        array('iblocks/update','id'=>$rid)
                                      );
                    /*$linkDelItem    = CHtml::link( 
                                        CHtml::image($pathToIcons.'/images/del_item.png', 'Удаление елемента'),
                                        array('iblocks/delete','id'=>$rid)
                                      );*/
                            
                    $icons = $linkViewItem.$linkAddItem.$linkEditItem.$linkDelItem;  
                    $icons = '<div class="app-icons">'.$icons.'</div>';
                    
                endif;
                
		/* Show without of the layout
                 * $this->renderPartial('showrid',array('item'=>$item, 'icons'=>$icons));
                 */
                if ( $item ) {
                     $this->data=(object)array('item'=>$item);
                                
                     $this->render('show',array('item'=>$item, 'icons'=>$icons));
                }else{
                    Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots');
                    throw new CHttpException(404,'The requested page does not exist.'); 
                }     
                
            } else
            {                
                //$this->redirect(Yii::app()->homeUrl);
                Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots');
                throw new CHttpException(404,'The requested page does not exist.'); 
            }
	}
        
        /**
	 * Building Rss News.
         * @params $uid - UID info block's
	 *
        public function actionSitemap ($types=null, $change='daily') { //weekly
            
            Yii::import('ext.extsitemap.*');
            
            $sitemap = new ExtSitemap();
            $sitemap->dateFormater = 'Y-m-d H:i:s';
            
            // Главная страница
            $urlItem = $sitemap->createUrlItem();
            $urlItem->loc = Yii::app()->createUrl('/');
            $urlItem->lastmod = time();
            $urlItem->priority = '1.0';
            $urlItem->changefreq = 'daily';
            $sitemap->addUrlItem($urlItem);
            
            // Cтраница контакт
            $urlItem = $sitemap->createUrlItem();
            $urlItem->loc = Yii::app()->createUrl('/index.php/ru/site/contact.html');
            $urlItem->lastmod = time();
            $urlItem->priority = '1.0';
            $urlItem->changefreq = 'daily';
            $sitemap->addUrlItem($urlItem);
            
            // Cтраница избранное
            $urlItem = $sitemap->createUrlItem();
            $urlItem->loc = Yii::app()->createUrl('/index.php/ru/realestates/favs.html');
            $urlItem->lastmod = time();
            $urlItem->priority = '1.0';
            $urlItem->changefreq = 'daily';
            $sitemap->addUrlItem($urlItem);

            // Каталог недвижимости
            $urlItem = $sitemap->createUrlItem();
            $urlItem->loc = Yii::app()->createUrl('/index.php/ru/realestates/index.html');
            $urlItem->lastmod = time();
            $urlItem->priority = '1.0';
            $urlItem->changefreq = 'daily';
            $sitemap->addUrlItem($urlItem);                        
            
            // Инфоблоки
            $iblocks = Iblocks::model()->findAll('act=1 and del=0');
            foreach ( $iblocks as $key=>$iblock) {
                $urlItem = $sitemap->createUrlItem();
                $urlItem->loc = Yii::app()->createUrl('/ru/site/index/'.$iblock->id.'html');
                $urlItem->lastmod = time();
                $urlItem->priority = '1.0';
                $urlItem->changefreq = 'daily';
                $sitemap->addUrlItem($urlItem);
            }

            // Недвижимость
            $realestates = Realestates::model()->findAll('act=1 and del=0');            
            foreach ( $realestates as $key=>$realestate) {
                $urlItem = $sitemap->createUrlItem();
                $urlItem->loc = Yii::app()->createUrl('/ru/realestates/'.$realestate->id.'html');
                $urlItem->lastmod = time();
                $urlItem->priority = '1.0';
                $urlItem->changefreq = 'daily';
                $sitemap->addUrlItem($urlItem);
            }

            $sitemap->render();  
        }       
        */
        
        /**
	 * Building Rss News.
         * @params $uid - UID info block's
	 */
        public function actionRss($id=null,$type=null,$vid='ATOM') {
            
            Yii::import('ext.feed.*');
            
            if ($id<>null) {
                
            }else{
                // RSS 2.0 is the default type
                if ($vid=="RSS1") :
                    $feed = new EFeed(EFeed::RSS1);                    
                    $feed->link = 'http://pegasrealty.ru';                    
                    $feed->RSS1ChannelAbout = 'http://pegasrealty.ru/site/rss';
                elseif ($vid=="ATOM") :
                    $feed = new EFeed(EFeed::ATOM);
                    $feed->addChannelTag('updated', date(DATE_ATOM, time()));
                    $feed->addChannelTag('author', array('name'=>Yii::app()->params['infoEmail'].'(Vlad Ladogsky)'));
                    //$feed->addChannelTag('author', array('name'=>Yii::app()->params['adminEmail'].'(Vlad Ladogsky)'));
                else :
                    $feed = new EFeed();
                    $feed->setImage('Новости и предложения от Агентства Коммерческой Недвижимости "Pegas Realty"','http://pegasrealty.ru/ru/site/rss',
                    'http://pegasrealty.ru/images/logo.png');
                    $feed->addChannelTag('language', 'ru-ru');
                    $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
                    $feed->addChannelTag('link', 'http://pegasrealty.ru/ru/site/rss' );
                    // * self reference
                    $feed->addChannelTag('atom:link','http://pegasrealty.ru/ru/site/rss');
                endif;

                $feed->title= 'Новости и предложения от Агентства Коммерческой Недвижимости "Pegas Realty"';
                $feed->description = 'Лучшые предложения коммерческой недвижимости | Аренде офисов, зданий и прочих нежелых помещений в Москве';
                
                if (is_array($type) && in_array('news',$type)) {
                    $news = Iblocks::model()->findAll(array('condition'=>'types_iblocks_id=2','sort'=>'updatedate DESC, createdate DESC','limit'=>'10'));
                    foreach ($news as $key=>$new) {
                        $item = $feed->createNewItem();
                        $item->title = $new->title;
                        $item->link = "http://pegasrealty.ru/ru/site/index/".$new->id.".html";                        
                        $item->description = $new->anons;
                        if ($vid=="RSS1") :
                            $item->date = strtotime($new->updatedate);
                            $item->addTag('dc:subject', $new->title);
                        elseif ($vid=="ATOM") :
                            $item->date = strtotime($new->updatedate==null ? $new->createdate : $new->updatedate);
                        else :
                            $item->date = strtotime($new->updatedate);
                            $item->setEncloser('http://pegasrealty.ru', 'n'.$new->id, 'audio/mpeg');
                            //$item->addTag('author', Yii::app()->params['adminEmail'].'(Vlad Ladogsky)');
                            $item->addTag('author', Yii::app()->params['infoEmail'].'(Vlad Ladogsky)');
                            $item->addTag('guid', 'http://pegasrealty.ru/',array('isPermaLink'=>'true'));                            
                        endif;
                        $feed->addItem($item);                        
                    }
                }  
                
                if ( $type===null || (is_array($type) and in_array('releastate',$type))) 
                {
                        $realestates = Realestates::model()->findAll( array('condition'=>/*'(create_date <= NOW())and'.'(in_stock=1)'*/'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', 'order'=>'update_date DESC, create_date DESC', 'limit'=>'10'));
                        foreach ($realestates as $key=>$realestate) 
                        {                            
                            $item = $feed->createNewItem();
                            $item->title = ' Пегас Недвижимость | '.$realestate->seo_title;
                            $item->link = "http://pegasrealty.ru/ru/realestates/".$realestate->id.".html";
                            $item->description = $realestate->anons;//$realestate->anons;                            
                            if ($vid=="RSS1") :
                                $item->date = strtotime($realestate->update_date);                            
                                //$item->addTag('dc:subject', ' Пегас Недвижимость | Аренда '.mb_strtolower($realestate->realestateVid->namewhat,'UTF-8').' в Москве - '.$realestate->seo_title);
                                $item->addTag('dc:subject', ' Пегас Недвижимость | '.$realestate->seo_title);
                            elseif ($vid=="ATOM") :
                                $item->date = strtotime(($realestate->update_date) ? $realestate->update_date : $realestate->create_date); 
                            else :
                                $item->date = strtotime($realestate->update_date);
                                $item->setEncloser('http://pegasrealty.ru', 'n'.$new->id, 'audio/mpeg');
                                //$item->addTag('author', Yii::app()->params['adminEmail'].'(Vlad Ladogsky)');
                                $item->addTag('author', Yii::app()->params['infoEmail'].'(Vlad Ladogsky)');
                                $item->addTag('guid', 'http://pegasrealty.ru/',array('isPermaLink'=>'true'));                            
                            endif;                                                        
                            $feed->addItem($item);
                        }
                }                

                $feed->generateFeed();
                Yii::app()->end();
            }            
        }
        
        /**
	 * Detile InfoBlock.
         * @params $uid - UID info block's
	 */
	public function actionDetile( $id=null )
	{
            if ( $id<>null ) 
            {
                $iblocks = Iblocks::model();
                $item = $iblocks->findByFk($id);
                $childs = $iblocks->findAll(array("condition"=>"grid=".$id));
		$this->render('list',array('childs'=>$childs, 'item'=>$item));
            } else
            {
                Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots');
                throw new CHttpException(404,'The requested page does not exist.'); 
                //$this->redirect(Yii::app()->homeUrl);
            }
	}

                /**
	 * Show InfoBlock.
         * @params $uid - UID info block's
	 */
	public function actionShow( $id=null )
	{
            $this->actionShowRid( $id);
	}
        
        /**
	 * List Item Group InfoBlock.
         * @params $id - ID group info block's
	 */
	public function actionList( $id=null )
	{
            if ( $id<>null ) 
            {
                $iblocks = Iblocks::model();
                $group = $iblocks->findByPk($id);
                $items = $iblocks->findAll(array("condition"=>"grid=".$id." AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))", 'order'=>'id desc')); 
		$this->render('list',array('group'=>$group, 'items'=>$items));
            } else
            {
                Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots');
                throw new CHttpException(404,'The requested page does not exist.'); 
                //$this->redirect(Yii::app()->homeUrl);
            }
	}
        
        /**
	 * Show Item Group InfoBlock.
         * @params $id - ID group info block's
	 */
	private function actionListGroup( $id=null, $type=null )
	{            
             if ( $id<>null ) 
             {                
                $iblocks = Iblocks::model();
                $group = $iblocks->findByPk($id);
                $dataProvider=new CActiveDataProvider('Iblocks',
                          array(
                                'criteria'=>array(
                                'condition'=>"types_iblocks_id=".$type." AND grid=".$id." AND ((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))",
                                'order'=>'id desc, t.createdate DESC',                                
                                'limit' => 10,
                                ),
                                'pagination'=>/*false*/array(
                                'pageSize'=>10,
                                'pageVar' => 'pagenews'
                                ),                         
               ));
             
	       $this->render('news',array(
                        'group'=>$group,
			'dataProvider'=>$dataProvider,
	       ));
            } else {
                Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots');
                throw new CHttpException(404,'The requested page does not exist.'); 
                //$this->redirect(Yii::app()->homeUrl);
            }  
	}
        
        /**
	 * List News InfoBlock.
         * @params $id - ID group info block's
	 */
	public function actionNews()
	{   
            /* News Rent */
            
            $types_iblocks_id = 5;
            $grid = 70;
            $date = date('Y-m-d H:i:s',time());
            $secper = 360000;
            $last_iblock = Iblocks::model()->find(array('condition'=>'grid='.$grid.' and types_iblocks_id='.$types_iblocks_id.' and ((t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1))',
                                                        'order'=>'t.createdate DESC'));
            //echo $last_iblock->createdate;
            $rentnews = Realestates::model()->findAll(array('condition'=>'t.in_stock=1 AND TIMESTAMP(t.date_rang) between '
                                                    .($last_iblock->createdate ? '"'.$last_iblock->createdate.'"' : '"'.$date.'"-INTERVAL '.$secper.' SECOND').' AND "'.$date.'" AND ((t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1))',
                                'order'=>'t.create_date desc'));      
            if ($rentnews ) {
                $anons = '<div class="row w-100p">';
                foreach ($rentnews as $rentnew) {
                    $anons.=CHtml::tag( 'div',array('style'=>'font-size:0.9em;padding: 4px 5px 0 4px; width: 100%;'),
                                //'<div class="pic fl">'.CHtml::image('').'</div><div >'.
                                CHtml::link( $rentnew->seo_title,
                                             Yii::app()->createUrl('realestates/view',
                                                     array('id'=>$rentnew->id)),
                                             array('title'=>$rentnew->seo_title)
                                            )
                                //.'</div><div class="clear"></div>'
                                );
                }    
                $anons.='</div>';
                $info = array('grid' => $grid,
                              //'name' => 'Освободная площадь на '.$date,
                              'name' => 'Освободились следующие площади',
                           //'title' => 'Освободная площадь на '.$date,                                              
                     //'description' => 'Освободившая площадь по аренде коммерческой недвижимости в агентстве "Pegas Realty" на '.$date,
                             'anons' => $anons,
                               'act' => 1,
			       'del' => 0,
		       'createusers' => 1,
			'createdate' => $date,
		       'updateusers' => 1,
			'updatedate' => $date, 
                              'sort' => 500,
                  'types_iblocks_id' => $types_iblocks_id,
                            'action' => 'news',
			       'url' => Yii::app()->createUrl('realestates/daterang',array('date'=>$date)),
                        'url_detile' => Yii::app()->createUrl('realestates/daterang',array('date'=>$date)),
                          'url_list' => Yii::app()->createUrl('realestates/daterang'),                    
                             //'uid' => null,
                             //'sid' => null,
                             //'nid' => null,
                        //'keywords' => null,	
                            /*
                            'detile' => null,
                         'is_resize' => null,
                   'pic_oreginal_id' => null,
			'pic_scr_id' => null,
		      'pic_anons_id' => null,
		     'pic_detile_id' => null,
			    'detile' => null,			      
			       'cid' => null,
			   'is_main' => null,
			    'is_pay' => null,
			  'is_arhiv' => null,
			    'is_use' => null,
			   'maps_id' => null,
                           'visible' => null,
			   'city_id' => null,                           
                       'picOreginal' => null, // Картинка группы с мозаикой по дате
                            'picScr' => null, // Скриншот картинки группы с мозаикой по дате,
                          'picAnons' => null, // Анонс картинки группы с мозаикой по дате,
                         'picDetile' => null, // Картинка детально группы с мозаикой по дате,*/     
                );
                $iblock = new Iblocks();            
                $iblock->attributes = $info; 
                $iblock->title = $iblock->createTitle();                                              
                $iblock->anons = $iblock->createDescription(); 
                $iblock->keywords = $iblock->createKeywords(); 
                $Ri = new Ri;
                $iblock->uid = $Ri->genid(); 
                $iblock->sid = HRu::translit($iblock->title);
                $iblock->nid = rand(1,99999).strtoupper(HCommon::genRandomString(2,'',array('num'=>false)));

                //$is_iblock = Iblocks::model()->exists(array('condition'=>'t.anons="'.$anons.'" AND (t.del IS NULL OR t.del=0) AND (t.act IS NULL OR t.act=1)))'));
                //if( !$is_iblock ) {
                    $iblock->save();                
                //}
            }    
            $this->actionListGroup(70,5);   
            /* End News Rent */
	}
        
        public function actionPartners() {
            
            Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots');
            
    	    $dataProvider=new CActiveDataProvider('Partners',
                          array(
                                'criteria'=>array(
                                'condition'=>"((act=1)OR(act is NULL))AND((del=0)OR(del is NULL))",
                                'order'=>'id desc, t.create_date DESC',                                
                                'limit' => 10,
                                ),
                                'pagination'=>/*false*/array(
                                'pageSize'=>10,
                                'pageVar' => 'page_partners'
                                ),                         
            ));                              
            
            Yii::app()->clientScript->registerMetaTag("noindex, nofollow", 'robots'); 
            
            $this->render('partners',array(
			'dataProvider'=>$dataProvider,
		));             
        }
        /**
	 * Show Group InfoBlock.
         * @params $id - ID group info block's
	 */
	protected function actionArticles( $id=null )
	{   
            $this->actionList($id,'articles');            
	}

}