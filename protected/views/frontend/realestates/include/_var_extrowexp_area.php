<?php 
$extraRowExpression = '"<div style=\"float:left; padding-right: 10px;\">".CHtml::link(CHtml::image( 
                                   "/".( trim($data->picScr->original_name)<>"" 
                                     && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_small",trim($data->picScr->original_name)))
                                     ? str_replace("_original","_small",trim($data->picScr->original_name))
                                     : ( trim($data->picOreginal->original_name)<>"" 
                                         && file_exists($_SERVER[DOCUMENT_ROOT]."/".str_replace("_original","_small",trim($data->picOreginal->original_name)))
                                         ? str_replace("_original","_small",trim($data->picOreginal->original_name)) 
                                         : "images/no_foto_small.png" )),"Коммерческая недвижимость / Аренда ".$data->realestateVid->namewhat." в Москве - ".$data->title, 
                                         array("title"=>"Коммерческая недвижимость / Аренда ".$data->realestateVid->namewhat." в Москве - ".$data->title)), 
                                         "/".str_replace("_original","_big",trim($data->picOreginal->original_name)), array("class"=>"fancyImage", "title"=>"Коммерческая недвижимость / Аренда ".$data->realestateVid->namewhat." в Москве - ".$data->title ))."
                                 </div>
                                 <div style=\"font-size: 0.95em;font-famely:Thahome;padding:0 5px;margin:0px 0;display:block;\">
                                         <div>
                                            <p class=\"anons m-0 p-b1 fs-11\">".CHtml::encode( str_replace(",","",HRu::cutstr($data->anons,'.($short ? 500 : 750).')))."</p>
                                            <p class=\"m-0 m-b4 m-t6 fs-'.($short ? 11 : 10).'\">".
                                                  ($data->areas_id ? 
                                                    "<b>".CHtml::encode($data->getAttributeLabel("areas_id")).":</b> "
                                                    .CHtml::encode($data->areas->title) : "")." ".
                                                  ($data->district_id ? 
                                                    "<b>".CHtml::encode($data->getAttributeLabel("district_id")).":</b> "
                                                    .CHtml::encode($data->district->title)." (".CHtml::encode($data->district->abbr).")" : "")." ".  
                                                  ($data->street_id ? 
                                                    "<b>".CHtml::encode($data->street->getFullName(null,false,true)).":</b> "
                                                    .CHtml::encode($data->street->name) : "")." ".
                                                  ($data->metro_id ? 
                                                    "<b>".CHtml::encode($data->getAttributeLabel("metro_id")).":</b> "
                                                    .CHtml::encode($data->metro->title/*.":".$data->metro_id*/) : "")." ".                                                         
                                                    $data->getRemoteness()." ".                                                      
                                                  "<b>".CHtml::encode($data->getAttributeLabel("planning_id")).":</b> "
                                                    .CHtml::encode($data->planning->title)." ".
                                                  "<b>".CHtml::encode($data->getAttributeLabel("parking_id")).":</b> "
                                                    ."<span style=\"text-transform:lowercase;\">".CHtml::encode($data->parking->title)."-</span> "
                                                    .CHtml::encode($data->cnt_parking_place)." ".
                                                    "<span class=\"ed\">".Yii::t("all","м/м")."</span> ".                   
                                                  "<b>".Yii::t("all","View").":</b> "
                                                    .CHtml::encode($data->realestateVid->title)." ".
                                                  "<b>".Yii::t("all","класса")."</b> "
                                                    ."<span class=\"ed\" >".CHtml::encode($data->realestateClass->abbr)."</span> ".              
                                                  "<b>".CHtml::encode($data->getAttributeLabel("number_tax")).":</b> "
                                                    .CHtml::encode($data->taxReference->abbr)." ".                                                     
                                                  "<b>".CHtml::encode($data->getAttributeLabel("tax_id")).":</b> "
                                                    .CHtml::encode($data->tax->abbr)." ". 
                                                  "<b>".CHtml::encode($data->getAttributeLabel("is_separate_entrance")).":</b> "
                                                    .CHtml::encode($data->is_separate_entrance ? "есть" : "нет")." ".                                                                                                 
                                                  "<b>".CHtml::encode(Yii::t("label","КК")/*$data->getAttributeLabel("coefficient_corridor")*/).":</b> "
                                                    .CHtml::encode($data->coefficient_corridor ? "включен" : "отсутвует")
                                                    ." ".$data->getProperty()." "                                                     
                                                    //." ".$data->getDestination(true)." </br>"                                                 
                                                  ."<b>".CHtml::encode(Yii::t("label","Арендная ставка")).":</b> ".
                                                    "<span class=\"c-red fs-11\">".round($data->price)."</span> <span class=\"ed\">".$data->valute->abbr."</span>"." ".                                                     
                                                  "<b>".Yii::t("label","Стоимость&nbsp;в&nbsp;месяц").":</b>&nbsp;".
                                                   "<span class=\"c-red fs-11\">".round(($data->price*$data->area)/12)."</span>&nbsp;<span class=\"ed\">".$data->valute->abbr."</span>"                               
                                                  ."&nbsp;".CHtml::link("Подробнее...",Yii::app()->controller->createUrl("/realestates/".$data->primaryKey), array("title"=>"Недвижимость/Аренда/Офиса в Москве - ".$data->title, "class"=>"fs-11" ))."                                                     
                                            </p>        
                                        </div>".//$data->anons.
                                        "</div>"';                       