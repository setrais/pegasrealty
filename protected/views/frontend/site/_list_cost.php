<?php

    $valute = 2;
    if ($valute) {
        $modval = Valutes::model()->findByPk($valute);            
        Yii::app()->currency->to = $modval->title;

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
           $home_sel.= "IF( v.title='".$val["name"]."', r.area*r.price*".Yii::app()->currency->$val["name"]."/12 ,";// t.price)) as `price`';
           $end_sel.= ")";
       }     
       $home_sel.= " r.area*r.price/12"; 
       $select = $home_sel.$end_sel;
       $select = $select.' between t.init_value AND t.final_value ';
       $join   = ' LEFT JOIN valutes v on v.id=r.valute_id ';
   } else {       
       $select = '(r.area*r.price/12) between t.init_value AND t.final_value';   
       $join = null;
   }      
?>        

<?php if ($model) {
        
        $criteria = $model->criteria();   
        
        $criteria->select = 't.id';          
        //$criteria->params = $model->dbCriteria->params;
        
        if ( $model->realestateDestinations ) {
            $criteria->addCondition('realestateDestinations.id='. $model->realestateDestinations);
            $criteria->with = 'realestateDestinations';
        }
        if ( $model->realestatesProperties ) {
            $criteria->addCondition('realestatesProperties.id='. $model->realestatesProperties);
            $criteria->with = 'realestatesProperties';
        }
        
        if (Yii::app()->getRequest()->getParam('area-from')&&Yii::app()->getRequest()->getParam('area-to')) {
            $criteria->addBetweenCondition('t.area', Yii::app()->getRequest()->getParam('area-from'), Yii::app()->getRequest()->getParam('area-to'));                   
        } 
        /*if (Yii::app()->getRequest()->getParam('price-from')&&Yii::app()->getRequest()->getParam('price-to')) {
            $criteria->addBetweenCondition('t.price', Yii::app()->getRequest()->getParam('price-from'), Yii::app()->getRequest()->getParam('price-to'));                   
        }*/ 
        
        // Объединение скритериев     
        $newmodel = new Realestates();   
        $newmodel->getDbCriteria()->mergeWith( $criteria );
         $inexsel = $newmodel->getSqlText();
           $exsel = $select;
          $exjoin = $join;
          
        //$reals = CHtml::listData($model->findAll($criteria), 'id', 'id');        
       
        
        $records = FcostOffers::model()->active()
                                       ->mapfields()
                                       ->firstcreate()
                                       ->rubinval()
                                       //->realexin( implode( ',', $reals) ) 
                                       ->realexsel( $inexsel, $exsel, $exjoin )
                                       ->findAll();
        
        //$model = $oldmodel;
   }else{
       
        $exsel = $select;
        $exjoin = $join;
        $inexsel = null;
        
        $records = FcostOffers::model()->active()
                                       ->mapfields()
                                       ->firstcreate()
                                       ->rubinval()
                                       ->realexsel( $inexsel, $exsel, $exjoin)
                                       //->realex()
                                       ->findAll();        
   }
   
   $cntcol=( (!empty($extvid->from) ? 1 : 0)
            +(!empty($extvid->between) ? 1 : 0)
            +(!empty($extvid->to) ? 1 : 0) <3 
                ? ( count(explode(' ',$extvid->namewhats))>1 || empty($extvid)
                    ? 3 : 4 ) 
                : 3 
           ); 
   
   $cntrow = ceil(count($records)*( (!empty($extvid->from) ? 1 : 0)+
                                    (!empty($extvid->between) ? 1 : 0)+
                                    (!empty($extvid->to) ? 1 : 0)
                                    ? (!empty($extvid->from) ? 1 : 0)+
                                      (!empty($extvid->between) ? 1 : 0)+
                                      (!empty($extvid->to) ? 1 : 0)
                                    : 3 )/$cntcol);
   $li_record = array();
   if ($records) {
       foreach ($records as $record) {
              if (!isset($extvid)) {       
                  if ( !empty($extvid->from) ) {
                      $li_record[]= Chtml::tag('li', array(), Chtml::link( 'Аренда коммерческой недвижимости от '.trim($record->init_value)." руб.", 
                                                                      Yii::app()->createUrl( 'realestates/costFrom', array( 'id' => $record->id )), 
                                                                      array( 'title' => 'Аренда коммерческой недвижимости со стоимостью аренды в месяц от '.trim($record->init_value)." руб.".', в Москве',
                                                                             'alt' => 'Аренда коммерческой недвижимости со стоимостью аренды в месяц от '.trim($record->init_value)." руб.".', в Москве'
                                                                           )));
                  }
                  if ( !empty($extvid->between) ) {
                      $li_record[]= Chtml::tag('li', array(), Chtml::link( 'Аренда коммерческой недвижимости от '.trim($record->init_value)." до ".trim($record->final_value).' руб.', 
                                                                      Yii::app()->createUrl( 'realestates/cost', array( 'id' => $record->id )), 
                                                                      array( 'title' => 'Аренда коммерческой недвижимости со стоимостью аренды в месяц от '.trim($record->init_value)." руб. до ".trim($record->final_value).' руб., в Москве',
                                                                             'alt' => 'Аренда коммерческой недвижимости со стоимостью аренды в месяц от '.trim($record->init_value)." руб. до ".trim($record->final_value).' руб., в Москве'
                                                                           )));
                  }
                  if ( !empty($extvid->to) ) {
                      $li_record[]= Chtml::tag('li', array(), Chtml::link( 'Аренда коммерческой недвижимости до '.trim($record->final_value).' руб.', 
                                                                      Yii::app()->createUrl( 'realestates/costTo', array( 'id' => $record->id )), 
                                                                      array( 'title' => 'Аренда коммерческой недвижимости со стоимостью аренды в месяц до '.trim($record->final_value).' руб., в Москве',
                                                                             'alt' => 'Аренда коммерческой недвижимости со стоимостью аренды в месяц до '.trim($record->final_value).' руб., в Москве'
                                                                           )));
                  }
              }else{
                  if ( !empty($extvid->from) ) {
                      $li_record[]= Chtml::tag('li', array(),Chtml::link( 'Аренда '.$extvid->namewhats.' от '.trim($record->init_value)." руб.", 
                                                                     Yii::app()->createUrl( 'realestates/costFrom', 
                                                                             array( 'id' => $record->id, 
                                                                              'property' => $extvid->type, 
                                                                                   'pid' => $extvid->id)),                        
                                                                     array('title'=>'Аренда '.$extvid->namewhats.' со стоимостью аренды в месяц от '.trim($record->init_value).' руб., в Москве',
                                                                             'alt' => 'Аренда '.$extvid->namewhats.' со стоимостью аренды в месяц от '.trim($record->init_value).' руб., в Москве'
                                                                            )));
                  }
                  if ( !empty($extvid->between) ) {
                     $li_record[]= Chtml::tag('li', array(),Chtml::link( 'Аренда '.$extvid->namewhats.' от '.trim($record->init_value)." до ".trim($record->final_value).' руб.', 
                                                                     Yii::app()->createUrl( 'realestates/cost', 
                                                                             array( 'id' => $record->id, 
                                                                              'property' => $extvid->type, 
                                                                                   'pid' => $extvid->id)),                        
                                                                     array('title'=>'Аренда '.$extvid->namewhats.' со стоимостью аренды в месяц от '.trim($record->init_value)." руб. до ".trim($record->final_value).' руб., в Москве',
                                                                             'alt' => 'Аренда '.$extvid->namewhats.' со стоимостью аренды в месяц от '.trim($record->init_value)." руб. до ".trim($record->final_value).' руб., в Москве'
                                                                            )));
                  }
                  if ( !empty($extvid->to) ) {
                     $li_record[]= Chtml::tag('li', array(),Chtml::link( 'Аренда '.$extvid->namewhats.' до '.trim($record->final_value).' руб.', 
                                                                     Yii::app()->createUrl( 'realestates/costTo', 
                                                                             array( 'id' => $record->id, 
                                                                              'property' => $extvid->type, 
                                                                                   'pid' => $extvid->id)),                        
                                                                     array('title'=>'Аренда '.$extvid->namewhats.' со стоимостью аренды в месяц до '.trim($record->final_value).' руб., в Москве',
                                                                             'alt' => 'Аренда '.$extvid->namewhats.' со стоимостью аренды в месяц до '.trim($record->final_value).' руб., в Москве'
                                                                            )));
                  }
              }                           
       }              

       $arli_record=array_chunk($li_record, $cntrow, false);
?>

    
    <h2 class="list <?/*fs-11 m-0 p-0 c-black inline-valn ff-tahoma m-b5 bold*/?>">   
        <?php if ($extvid->head) { 
            echo $extvid->head;
        ?>        
        <?php } else { ?>
        Снять в аренду <?=isset($extvid) ? $extvid->namewhat 
                                         : 'коммерческую недвижимость'/*офис, нежилое помещение или здание'*/;?> в Москве со стоимостью аренды в месяц от и до руб.:
        <?php } ?>                                 
    </h2>     
                                         
    <table>
       <tr>
         <?     
            foreach ( $arli_record as $record ) {
         ?>
         <td width="<?=100/$cntcol;?>%" class="valign-t fs-9 ff-Arial"><?=CHtml::tag('ul', array("style"=>"margin: 0 0em 1.2em 0;padding-left: 1.3em;list-style-type: circle;"),implode('',$record));?></td> 
         <?    
            }
         ?>        
      </tr>        
    </table>    
<? } ?>